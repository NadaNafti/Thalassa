<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\VoyageOrganise;
use Back\VoyageOrganiseBundle\Form\VoyageOrganiseType;

class VoyageOrganiseController extends Controller
{

    public function listeAction($page)
    {
	$em = $this->getDoctrine()->getManager();
	$voyageOrgainses = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findAll();
	$paginator = $this->get('knp_paginator');
	$voyageOrgainses = $paginator->paginate($voyageOrgainses, $page, 20);
	return $this->render('BackVoyageOrganiseBundle:voyageOrganise:liste.html.twig', array(
		    'voyages' => $voyageOrgainses
	));
    }

    public function supprimerAction(VoyageOrganise $voyageOrganise)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$em->remove($voyageOrganise);
	$session->getFlashBag()->add('success', " Votre Voyage organisé a été supprimé avec succées ");
	return $this->redirect($this->generateUrl('back_vo_liste'));
    }

    public function ajouterAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	if (is_null($id))
	    $voyageOrganise = new VoyageOrganise ();
	else
	    $voyageOrganise = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->find(1);
	$form = $this->createForm(new VoyageOrganiseType(), $voyageOrganise);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$voyageOrganise = $form->getData();
		$em->persist($voyageOrganise);
		$em->flush();
		$session->getFlashBag()->add('success', " Votre Voyage organisé a été ajoutée avec succées ");
		return $this->redirect($this->generateUrl('back_vo_ajouter'));
	    }
	}
	return $this->render('BackVoyageOrganiseBundle:voyageOrganise:ajouter.html.twig', array(
		    'form' => $form->createView()
	));
    }

}
