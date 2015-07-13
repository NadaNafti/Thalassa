<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HotelTunisieController extends Controller
{

    public function accueilAction()
    {
	return $this->render('FrontGeneralBundle:hoteltunisie:accueil.html.twig');
    }

    public function listeAction($page, $categorie, $chaine, $ville, $name)
    {
	$em = $this->getDoctrine()->getManager();
	$request = $this->getRequest();
	$villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array(), array('libelle' => 'asc'));
	$chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
	$categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
	$hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->filtreFrontOffice($categorie, $chaine, $ville, $name);
	$hotels=  $this->removeInvalideHotel($hotels);
	$paginator = $this->get('knp_paginator');
	$hotels = $paginator->paginate($newHotels, $page, 20);
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
	$hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->findBy(array('ville' => $hotel->getVille()));
	$hotels=  $this->removeInvalideHotel($hotels);
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
	    if (!is_null($hotel->getSaisonBase()) && $hotel->getSaisonBase()->isValidSaisonBase())
		$newHotels[] = $hotel;
	}
	return $newHotels;
    }

}
