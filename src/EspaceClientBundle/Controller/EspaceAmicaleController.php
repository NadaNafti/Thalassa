<?php

namespace EspaceClientBundle\Controller;

use Back\AdministrationBundle\Form\AmicaleType;
use Back\HotelTunisieBundle\Entity\Reservation;
use Back\UserBundle\Form\ClientType;
use Back\UserBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;

class EspaceAmicaleController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->container->get('security.context')->getToken()->getUser();
        $form = $this
            ->createForm(new AmicaleType(), $currentUser->getClient()->getAmicale())
            ->remove("produits")
            ->remove('plafond');
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $em->persist($data);
                $em->flush();
                return $this->redirect($this->generateUrl('espace_amicale_homepage'));
            }
        }
        $amicale=$currentUser->getClient()->getAmicale();
        $hotels= $em->getRepository('BackHotelTunisieBundle:Reservation')->findBy(array('amicale'=>$amicale),array('id'=>'desc'));
        return $this->render('EspaceClientBundle:espace_amicale:dashboard.html.twig', array(
            'form' => $form->createView(),
            'countReservationSHT'=>count($hotels)
        ));
    }

    public function personnelleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $CurrentUser = $this->container->get('security.context')->getToken()->getUser();
        $form = $this
            ->createForm(new ClientType(), new Client())
            ->remove('matriculeFiscale')->remove('registreCommercie')->remove('commentaire')
            ->add('user', new \Back\UserBundle\Form\RegistrationFormType());
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->submit($request);
            $client = $form->getData();
            $user = $client->getUser();
            $verif1 = $em->getRepository("BackUserBundle:User")->findBy(array('username' => $user->getUsername()));
            $verif2 = $em->getRepository("BackUserBundle:User")->findBy(array('email' => $user->getEmail()));
            if (count($verif2) > 0)
                $form->get('user')->get('email')->addError(new FormError("E-mail  " . $user->getEmail() . " existe dejà dans la base "));
            elseif (count($verif1) > 0)
                $form->get('user')->get('username')->addError(new FormError("Nom d'utilisateur  " . $user->getUsername() . " existe dejà dans la base "));
            else
            {
                $em->persist($client->setUser(null)->setAmicale($CurrentUser->getClient()->getAmicale()));
                $em->persist($user->setClient($client)->setEnabled(1));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Client a été traité avec succées ");
                return $this->redirect($this->generateUrl("espace_amicale_personnelles"));
            }
        }
        return $this->render('EspaceClientBundle:espace_amicale:personnelles.html.twig', array('form' => $form->createView()));
    }

    public function reservationSHTAction($page)
    {
        $em=$this->getDoctrine()->getManager();
        $currentUser = $this->container->get('security.context')->getToken()->getUser();
        $amicale=$currentUser->getClient()->getAmicale();
        $hotels= $em->getRepository('BackHotelTunisieBundle:Reservation')->findBy(array('amicale'=>$amicale),array('id'=>'desc'));
        $paginator = $this->get('knp_paginator');
        $hotels = $paginator->paginate($hotels,$page,10);
        return $this->render('EspaceClientBundle:espace_amicale:reservationSHT.html.twig', array('reservations' => $hotels));
    }

    public function reservationSHTDetailsAction(Reservation $reservation)
    {
        return $this->render('EspaceClientBundle:espace_amicale:hotel_tunisie_details.html.twig',array('reservation' => $reservation));
    }

    public function reservationSHTValiderAction(Reservation $reservation)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $CurrentUser = $this->container->get('security.context')->getToken()->getUser();
        $em->persist($reservation->setValidatedAmicale(new \DateTime())->setResponsableAmicale($CurrentUser->getClient()));
        $em->flush();
        return $this->redirect($this->generateUrl('espace_amicale_reservation_sht'));

    }
}
