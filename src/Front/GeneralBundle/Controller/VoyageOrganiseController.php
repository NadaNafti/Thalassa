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
	$hotels = $paginator->paginate($voyages, $page, 20);
	return $this->render('FrontGeneralBundle:voyageorganise/liste:liste.html.twig');
    }
}
