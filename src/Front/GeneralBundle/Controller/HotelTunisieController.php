<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HotelTunisieController extends Controller
{

    public function accueilAction()
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	$pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findOneBy(array('code' => 'tn'));
	$villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array('pays' => $pays), array('libelle' => 'asc'));
	$chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
	$categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
	if ($request->isMethod('POST'))
	{
	    $session->set('nuitees', $request->get('nuitees'));
	    $session->set('dateDebut', $request->get('dateDebut'));
	    return $this->redirect($this->generateUrl('front_hoteltunisie_list', array(
				'ville' => $request->get('ville'),
				'categorie' => $request->get('categorie'),
				'name' => urlencode($request->get('motcles')),
	    )));
	}
	return $this->render('FrontGeneralBundle:hoteltunisie:accueil.html.twig', array(
		    'villes' => $villes,
		    'chaines' => $chaines,
		    'categories' => $categories,
	));
    }

    public function listeAction($page, $categorie, $chaine, $ville, $name)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	$pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findOneBy(array('code' => 'tn'));
	$villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array('pays' => $pays), array('libelle' => 'asc'));
	$chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
	$categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
	$hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->filtreFrontOfficePlus($categorie, $chaine, $ville, $name);
	$hotels = $this->removeInvalideHotel($hotels);
	$paginator = $this->get('knp_paginator');
	$hotels = $paginator->paginate($hotels, $page, 20);
	return $this->render('FrontGeneralBundle:hoteltunisie/liste:liste.html.twig', array(
		    'hotels' => $hotels,
		    'villes' => $villes,
		    'chaines' => $chaines,
		    'categories' => $categories,
	));
    }

    public function detailsAction($slug)
    {
	$em = $this->getDoctrine()->getManager();
	$hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->findOneBy(array('slug' => $slug));
	$hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->findBy(array('ville' => $hotel->getVille()), array(), 5);
	$hotels = $this->removeInvalideHotel($hotels);
	return $this->render('FrontGeneralBundle:hoteltunisie/details:details.html.twig', array(
		    'hotel' => $hotel,
		    'hotels' => $hotels
	));
    }

    public function removeInvalideHotel($hotels)
    {
	$newHotels = array();
	foreach ($hotels as $hotel)
	{
	    if (!is_null($hotel->getSaisonBase()) && $hotel->getSaisonBase()->isValidSaisonBase() && !$hotel->isInStopSales())
		$newHotels[] = $hotel;
	}
	return $newHotels;
    }

}