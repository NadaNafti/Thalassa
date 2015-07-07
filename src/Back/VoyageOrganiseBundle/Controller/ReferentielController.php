<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\Destination;
use Back\VoyageOrganiseBundle\Form\DestinationType;
use Back\VoyageOrganiseBundle\Entity\Pays;
use Back\VoyageOrganiseBundle\Form\PaysType;

class ReferentielController extends Controller
{

    public function destinationAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	if (is_null($id))
	    $destination = new Destination ();
	else
	    $destination = $em->getRepository('BackVoyageOrganiseBundle:Destination')->find($id);
	$destinations = $em->getRepository('BackVoyageOrganiseBundle:Destination')->findAll();
	$form = $this->createForm(new DestinationType(), $destination);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$destination = $form->getData();
		$em->persist($destination);
		$em->flush();
		$session->getFlashBag()->add('success', " Votre déstination a été ajouté avec succées ");
		return $this->redirect($this->generateUrl('back_voyages_organises_destination'));
	    }
	}
	return $this->render('BackVoyageOrganiseBundle:referentiel:destination.html.twig', array(
		    'form' => $form->createView(),
		    'destinations' => $destinations,
	));
    }

    public function deleteDestinationAction(Destination $destination)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	try
	{
	    $em->remove($destination);
	    $em->flush();
	    $session->getFlashBag()->add('success', " Votre déstination a été supprimé avec succées ");
	}
	catch (\Exception $ex)
	{
	    $session->getFlashBag()->add('danger', 'Votre destination est utilisé dans les voyages organisés');
	}
	return $this->redirect($this->generateUrl('back_voyages_organises_destination'));
    }

    public function paysAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	if (is_null($id))
	    $pays = new Pays();
	else
	    $pays = $em->getRepository('BackVoyageOrganiseBundle:Pays')->find($id);
	$payss = $em->getRepository('BackVoyageOrganiseBundle:Pays')->findAll();
	$form = $this->createForm(new PaysType(), $pays);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$pays = $form->getData();
		$em->persist($pays);
		$em->flush();
		$session->getFlashBag()->add('success', " Votre pays a été ajouté avec succées ");
		return $this->redirect($this->generateUrl('back_voyages_organises_pays'));
	    }
	}
	return $this->render('BackVoyageOrganiseBundle:referentiel:pays.html.twig', array(
		    'form' => $form->createView(),
		    'payss' => $payss,
	));
    }

    public function deletePaysAction(Pays $pays)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	try
	{
	    $em->remove($pays);
	    $em->flush();
	    $session->getFlashBag()->add('success', " Votre pays a été supprimé avec succées ");
	}
	catch (\Exception $ex)
	{
	    $session->getFlashBag()->add('danger', 'Votre pays est utilisé dans les voyages organisés');
	}
	return $this->redirect($this->generateUrl('back_voyages_organises_pays'));
    }

}
