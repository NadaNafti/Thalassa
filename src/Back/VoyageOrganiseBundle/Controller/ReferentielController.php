<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\Destination;
use Back\VoyageOrganiseBundle\Form\DestinationType;
use Back\VoyageOrganiseBundle\Entity\Theme;
use Back\VoyageOrganiseBundle\Form\ThemeType;

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

    public function themeAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	if (is_null($id))
	    $theme = new Theme();
	else
	    $theme = $em->getRepository('BackVoyageOrganiseBundle:Theme')->find($id);
	$themes = $em->getRepository('BackVoyageOrganiseBundle:Theme')->findBy(array(), array('id'=>'desc'));
	$form = $this->createForm(new ThemeType(), $theme);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$theme = $form->getData();
		$em->persist($theme);
		$em->flush();
		$session->getFlashBag()->add('success', " Votre theme a été ajouté avec succées ");
		return $this->redirect($this->generateUrl('back_voyages_organises_theme'));
	    }
	}
	return $this->render('BackVoyageOrganiseBundle:referentiel:theme.html.twig', array(
		    'form' => $form->createView(),
		    'themes' => $themes,
	));
    }

    public function deleteThemeAction(THeme $theme)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	try
	{
	    $em->remove($theme);
	    $em->flush();
	    $session->getFlashBag()->add('success', " Votre theme a été supprimé avec succées ");
	}
	catch (\Exception $ex)
	{
	    $session->getFlashBag()->add('danger', 'Votre theme est utilisé dans les voyages organisés');
	}
	return $this->redirect($this->generateUrl('back_voyages_organises_theme'));
    }

}
