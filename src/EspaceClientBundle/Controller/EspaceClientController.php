<?php

namespace EspaceClientBundle\Controller;

use Back\HotelTunisieBundle\Entity\Reservation;
use Back\UserBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EspaceClientController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        if(is_null($user->getClient()))
        {
            $this->getRequest()->getSession()->getFlashBag()->add('info',"Vous devez avoir un compte client pour acceder au espace client ");
            return $this->redirect($this->generateUrl('tableaubord'));
        }
        $client=$user->getClient();
        $form=$this->createForm(new ClientType(),$client);
        $form->remove('responsable')->remove('registreCommercie')->remove('matriculeFiscale')->remove('commentaire');
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $client=$form->getData();
                $em->persist($client);
                $em->flush();
                return $this->redirect($this->generateUrl('espace_client_homepage'));
            }
        }
        return $this->render('EspaceClientBundle:espace_client:dashboard.html.twig',array('form'=>$form->createView()));
    }

    public function hotelTunisieAction($page)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($user->getClient()->getReservationsSHT(),$page,10);
        return $this->render('EspaceClientBundle:espace_client:hotel_tunisie.html.twig',array('reservations' => $reservations));
    }

    public function hotelTunisieDetailsAction(Reservation $reservation)
    {
        return $this->render('EspaceClientBundle:espace_client:hotel_tunisie_details.html.twig',array('reservation' => $reservation));
    }

    public function voyagesDetailsAction(\Back\VoyageOrganiseBundle\Entity\Reservation $reservation)
    {
        return $this->render('EspaceClientBundle:espace_client:voyages_organisees_details.html.twig',array('reservation' => $reservation));
    }

    public function programmesDetailsAction(\Back\ProgrammeBundle\Entity\Reservation $reservation)
    {
        return $this->render('EspaceClientBundle:espace_client:programmes_details.html.twig',array('reservation' => $reservation));
    }

    public function voyagesAction($page)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($user->getClient()->getReservationsVO(),$page,10);
        return $this->render('EspaceClientBundle:espace_client:voyages_organisees.html.twig',array('reservations' => $reservations));
    }

    public function programmesAction($page)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($user->getClient()->getReservationsPR(),$page,10);
        return $this->render('EspaceClientBundle:espace_client:programmes.html.twig',array('reservations' => $reservations));
    }
}
