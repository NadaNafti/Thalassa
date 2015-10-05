<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\UserBundle\Form\ClientType;
use Back\BienEtreBundle\Entity\Produit;
use Back\BienEtreBundle\Entity\Tarif;
use Back\BienEtreBundle\Entity\Reservation;
use Back\BienEtreBundle\Form\ReservationType;
use Doctrine\ORM\EntityRepository;

class BienEtreController extends Controller {

    public function listeAction($page, $name, $produits, $sort, $direction) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $produitsArray = array();
            $arrays = array();
            for ($i = 1; $i <= 3; $i++) {
                if ($request->get('produits_' . $i))
                    $produitsArray[] = $i;
            }
            if (count($produitsArray) == 0)
                $arrays['produits'] = 'all';
            else
                $arrays['produits'] = implode(',', $produitsArray);
            $arrays['name'] = urlencode($request->get('motclesSearch'));
            return $this->redirect($this->generateUrl('front_bienetre_liste', $arrays));
        }
        $produits = $em->getRepository('BackBienEtreBundle:Produit')->filtre($produits, $name, $sort, $direction);
        $paginator = $this->get('knp_paginator');
        $produits = $paginator->paginate($produits, $page, 9);
        return $this->render('FrontGeneralBundle:bienetre\liste:liste.html.twig', array(
                    'produits' => $produits,
                    'motcle' => urldecode($name),
        ));
    }

    public function sortAction($produits, $name) {
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $arrays = array();
            $arrays['produits'] = $produits;
            $arrays['name'] = $name;
            if ($request->get('direction') != '') {
                $arrays['direction'] = $request->get('direction');
                $arrays['sort'] = $request->get('sort');
            }
            return $this->redirect($this->generateUrl('front_bienetre_liste', $arrays));
        }
    }

    public function detailsAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $produit = $em->getRepository('BackBienEtreBundle:Produit')->findOneBy(array('slug' => $slug));
        $request = $this->getRequest();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
            $client = $user->getClient();
        else
            $client = $this->container->get('users')->getPassager();
        $reservation = new Reservation();
        $reservation->setClient($client)
                ->setNomPrenom($client->getNomPrenom())
                ->setTel($client->getTel1());
        if (!is_null($client->getUser()))
            $reservation->setEmail($client->getUser()->getEmail());
        $form = $this->createForm(new ReservationType(), $reservation);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            $reservation = $form->getData();
            $tarif = $produit->getTarifByDate($reservation->getDateDebut()->format('Y-m-d'));
            if (is_null($tarif)) {
                $session->getFlashBag()->add('Info', " Pas de tarif pour cette date " . $reservation->getDateDebut()->format('d/m/Y'));
            } else {
                $em->persist($reservation->setEtat(1)
                                ->setFrontOffice(1)
                                ->setTarif($tarif)
                                ->setProduit($produit));
                $em->flush();
                return $this->redirect($this->generateUrl('front_bienetre_success', array('id' => $reservation->getId())));
            }
        }
        $csrf_token = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
        return $this->render('FrontGeneralBundle:bienetre/details:details.html.twig', array(
                    'produit' => $produit,
                    'form' => $form->createView(),
                    'csrf_token' => $csrf_token,
        ));
    }

    public function successAction(Reservation $reservation) {
        return $this->render("FrontGeneralBundle:bienetre/details:success.html.twig", array(
                    'reservation' => $reservation
        ));
    }

}
