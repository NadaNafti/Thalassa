<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\VoyageOrganise;
use Back\VoyageOrganiseBundle\Form\VoyageOrganiseType;
use Back\VoyageOrganiseBundle\Entity\Description;
use Back\VoyageOrganiseBundle\Form\DescriptionType;
use Back\VoyageOrganiseBundle\Entity\Photo;
use Back\VoyageOrganiseBundle\Form\PhotoType;

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
	$em->flush();
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
	    $voyageOrganise = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->find($id);
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
		return $this->redirect($this->generateUrl('back_vo_liste'));
	    }
	}
	return $this->render('BackVoyageOrganiseBundle:voyageOrganise:ajouter.html.twig', array(
		    'form' => $form->createView(),
		    'voyage' => $voyageOrganise
	));
    }

    public function descriptionAction(VoyageOrganise $voyage, $id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	if (is_null($id))
	    $description = new Description ();
	else
	    $description = $em->getRepository('BackVoyageOrganiseBundle:Description')->find($id);
	$descriptions = $em->getRepository('BackVoyageOrganiseBundle:Description')->findAll();
	$form = $this->createForm(new DescriptionType(), $description);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$description = $form->getData();
		$em->persist($description->setVoyage($voyage));
		$em->flush();
		$session->getFlashBag()->add('success', " Votre déscription a été traité avec succées ");
		return $this->redirect($this->generateUrl('back_vo_descriptions', array(
				    'voyage' => $voyage->getId()
		)));
	    }
	}
	return $this->render('BackVoyageOrganiseBundle:voyageOrganise:description.html.twig', array(
		    'form' => $form->createView(),
		    'voyage' => $voyage,
		    'descriptions' => $descriptions
	));
    }

    public function SupprimerDescriptionAction(Description $description)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$em->remove($description);
	$em->flush();
	$session->getFlashBag()->add('success', " Votre déscription organisé a été supprimé avec succées ");
	return $this->redirect($this->generateUrl('back_vo_descriptions', array(
			    'voyage' => $description->getVoyage()->getId()
	)));
    }

    public function photoAction(VoyageOrganise $voyage)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$photo = new Photo();
	$form = $this->createForm(new PhotoType(), $photo);
	$photos = $em->getRepository('BackVoyageOrganiseBundle:Photo')->findAll();
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    $photo = $form->getData();
	    $em->persist($photo->setVoyage($voyage));
	    $em->flush();
	    $session->getFlashBag()->add('success', " Votre photo a été traité avec succées ");
	    return $this->redirect($this->generateUrl('back_vo_photos', array(
				'voyage' => $voyage->getId()
	    )));
	}
	return $this->render('BackVoyageOrganiseBundle:voyageOrganise:photo.html.twig', array(
		    'form' => $form->createView(),
		    'voyage' => $voyage,
		    'photos' => $photos
	));
    }

}
