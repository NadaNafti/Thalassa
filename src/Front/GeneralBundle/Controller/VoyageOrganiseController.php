<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
	$voyage = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $slug));
	return $this->render('FrontGeneralBundle:voyageorganise/details:details.html.twig', array(
		    'voyage' => $voyage
	));
    }

}
