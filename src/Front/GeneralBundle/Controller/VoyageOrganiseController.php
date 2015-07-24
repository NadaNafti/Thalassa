<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\UserBundle\Form\ClientType;
use Back\VoyageOrganiseBundle\Form\ReservationType;
use Back\VoyageOrganiseBundle\Entity\Reservation;

class VoyageOrganiseController extends Controller
{

    public function accueilAction()
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	return $this->render('FrontGeneralBundle:voyageorganise:accueil.html.twig');
    }

    public function listeAction($page)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	$voyages = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->filtre();
	$paginator = $this->get('knp_paginator');
	$voyages = $paginator->paginate($voyages, $page, 20);
	return $this->render('FrontGeneralBundle:voyageorganise/liste:liste.html.twig', array(
		    'voyages' => $voyages
	));
    }

    public function detailsAction($slug)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$voyage = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $slug));
	$user = $this->get('security.context')->getToken()->getUser();
	if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
	    $client = $user->getClient();
	else
	    $client = $this->container->get('users')->getPassager();
	$reservation = new Reservation();
	$reservation->setVoyage($voyage);
	$form = $this->createForm(new ReservationType(), $reservation)
		->remove('commentaire')
		->remove('voyage')
		->add("client", new ClientType(), array('data' => $client));
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    $reservation = $form->getData();
	    if (count($reservation->getAdultes()) == 0 && count($reservation->getEnfants()) == 0)
	    {
		$session->getFlashBag()->add('warning', "Vous devez  choisir au moin un adulte ");
		return $this->redirect($this->generateUrl('front_voyageorganise_details',array('slug'=>$slug)));
	    }
	    $reservation->setCoordonnees(array($reservation->getClient()->getNomPrenom(), $reservation->getClient()->getTel1(), $reservation->getClient()->getTel2(), $reservation->getClient()->getAdresse()));
	    $em->persist($reservation->setFrontOffice(TRUE));
	    foreach ($reservation->getAdultes() as $adulte)
		$em->persist($adulte->setReservationA($reservation)->setAge(null));
	    foreach ($reservation->getEnfants() as $enfant)
		$em->persist($enfant->setReservationE($reservation));
	    $em->flush();
	    $this->container->get('users')->getPassager();
	    return $this->redirect($this->generateUrl('front_voyageorganise_thankyou',array('slug'=>$slug,'reservation'=>$reservation->getId())));
	}
	return $this->render('FrontGeneralBundle:voyageorganise/details:details.html.twig', array(
		    'voyage' => $voyage,
		    'form' => $form->createView()
	));
    }
    
    public function successAction($slug, Reservation $reservation )
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$voyage = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $slug));
	return $this->render('FrontGeneralBundle:voyageorganise:success.html.twig', array(
		    'reservation' => $reservation,
	));
    }

}
