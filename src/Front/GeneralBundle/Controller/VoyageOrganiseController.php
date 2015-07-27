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
	$pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findBy(array(), array('libelle' => 'asc'));
	$destinations = $em->getRepository('BackVoyageOrganiseBundle:Destination')->findBy(array(), array('libelle' => 'asc'));
	$themes = $em->getRepository('BackVoyageOrganiseBundle:Theme')->findBy(array(), array('libelle' => 'asc'));
	if ($request->isMethod('POST'))
	{
	    return $this->redirect($this->generateUrl('front_voyageorganise_liste', array(
				'destinations' => $request->get('destinations'),
				'pays' => $request->get('pays'),
				'themes' => $request->get('themes'),
				'name' => urlencode($request->get('motcles')),
	    )));
	}
	return $this->render('FrontGeneralBundle:voyageorganise:accueil.html.twig', array(
		    'destinations' => $destinations,
		    'themes' => $themes,
		    'pays' => $pays
	));
    }

    public function listeAction($page,$themes, $destinations, $pays, $name)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	$listePays = $em->getRepository('BackHotelTunisieBundle:Pays')->findBy(array(), array('libelle' => 'asc'));
	$listeDestinations = $em->getRepository('BackVoyageOrganiseBundle:Destination')->findBy(array(), array('libelle' => 'asc'));
	$listeThemes = $em->getRepository('BackVoyageOrganiseBundle:Theme')->findBy(array(), array('libelle' => 'asc'));
	if ($request->isMethod('POST'))
	{
	    $destinationArray = array();
	    $paysArray = array();
	    $themesArray = array();
	    $arrays = array();
	    foreach ($listeDestinations as $dest)
	    {
		if ($request->get('destinations_' . $dest->getId()))
		    $destinationArray[] = $dest->getId();
	    }
	    foreach ($listeThemes as $th)
	    {
		if ($request->get('themes_' . $th->getId()))
		    $themesArray[] = $th->getId();
	    }
	    foreach ($listePays as $pay)
	    {
		if ($request->get('pays_' . $pay->getId()))
		    $paysArray[] = $pay->getId();
	    }
	    if (count($themesArray) == 0)
		$arrays['themes'] = 'all';
	    else
		$arrays['themes'] = implode(',', $themesArray);
	    if (count($destinationArray) == 0)
		$arrays['destinations'] = 'all';
	    else
		$arrays['destinations'] = implode(',', $destinationArray);
	    if (count($paysArray) == 0)
		$arrays['pays'] = 'all';
	    else
		$arrays['pays'] = implode(',', $paysArray);
	    $arrays['name'] = urlencode($request->get('motclesSearch'));
	    return $this->redirect($this->generateUrl('front_voyageorganise_liste', $arrays));
	}
	$voyages = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->filtre($themes,$destinations, $pays, $name);
	$paginator = $this->get('knp_paginator');
	$voyages = $paginator->paginate($voyages, $page, 20);
	return $this->render('FrontGeneralBundle:voyageorganise/liste:liste.html.twig', array(
		    'voyages' => $voyages,
		    'destinations' => $listeDestinations,
		    'themes' => $listeThemes,
		    'pays' => $listePays,
		    'motcle' => urldecode($name)
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
		return $this->redirect($this->generateUrl('front_voyageorganise_details', array('slug' => $slug)));
	    }
	    $reservation->setCoordonnees(array($reservation->getClient()->getNomPrenom(), $reservation->getClient()->getTel1(), $reservation->getClient()->getTel2(), $reservation->getClient()->getAdresse()));
	    $em->persist($reservation->setFrontOffice(TRUE));
	    foreach ($reservation->getAdultes() as $adulte)
		$em->persist($adulte->setReservationA($reservation)->setAge(null));
	    foreach ($reservation->getEnfants() as $enfant)
		$em->persist($enfant->setReservationE($reservation));
	    $em->flush();
	    $this->container->get('users')->getPassager();
	    return $this->redirect($this->generateUrl('front_voyageorganise_thankyou', array('slug' => $slug, 'reservation' => $reservation->getId())));
	}
	return $this->render('FrontGeneralBundle:voyageorganise/details:details.html.twig', array(
		    'voyage' => $voyage,
		    'form' => $form->createView(),
		    'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
	));
    }

    public function successAction($slug, Reservation $reservation)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$voyage = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $slug));
	return $this->render('FrontGeneralBundle:voyageorganise:success.html.twig', array(
		    'reservation' => $reservation,
	));
    }

}
