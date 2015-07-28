<?php

namespace Front\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Front\ConfigBundle\Entity\TopDestination;
use Front\ConfigBundle\Form\TopDestinationType;
use Front\ConfigBundle\Entity\SliderVO;
use Front\ConfigBundle\Form\SliderVOType;

class VoyageOrganiseController extends Controller
{

    public function topDestinationAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	if (is_null($id))
	    $topDestnation = new TopDestination();
	else
	    $topDestnation = $em->getRepository('FrontConfigBundle:TopDestination')->find($id);
	$topDestnations = $em->getRepository('FrontConfigBundle:TopDestination')->findBy(array(), array('ordre' => 'asc'));
	$form = $this->createForm(new TopDestinationType(), $topDestnation);
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$topDestnation=$form->getData();
		$em->persist($topDestnation);
		$em->flush();
		$session->getFlashBag()->add('success', "Votre top destination a été mise a jour avec succès ");
		return $this->redirect($this->generateUrl("front_config_voyageorganise_topdestination"));
	    }
	}
	return $this->render('FrontConfigBundle:VoyageOrganise:topDestination.html.twig', array(
		    'topDestinations' => $topDestnations,
		    'form' => $form->createView(),
	));
    }

    public function deleteTopDestinationAction(TopDestination $topDestination)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	try
	{
	    $em->remove($topDestination);
	    $em->flush();
	    $session->getFlashBag()->add('success', " Votre top destination a été supprimé avec succées ");
	}
	catch (\Exception $ex)
	{
	    $session->getFlashBag()->add('danger', 'Votre destination est utilisé dans une autre table');
	}
	return $this->redirect($this->generateUrl('front_config_voyageorganise_topdestination'));
    }

    public function showTopDestinationAction()
    {
	$em=  $this->getDoctrine()->getManager();
	$topDestinations=$em->getRepository('FrontConfigBundle:TopDestination')->findBy(array(), array('ordre'=>'asc'));
	return $this->render('FrontConfigBundle:VoyageOrganise:showTopDestination.html.twig', array(
		    'topDestinations' => $topDestinations,
	));
    }
    
    public function sliderAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	if (is_null($id))
	    $slider = new SliderVO();
	else
	    $slider = $em->getRepository('FrontConfigBundle:SliderVO')->find($id);
	$sliders = $em->getRepository('FrontConfigBundle:SliderVO')->findBy(array(), array('ordre' => 'asc'));
	$form = $this->createForm(new SliderVOType(), $slider);
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$slider=$form->getData();
		$em->persist($slider);
		$em->flush();
		$session->getFlashBag()->add('success', "Votre slider a été mise a jour avec succès ");
		return $this->redirect($this->generateUrl("front_config_voyageorganise_slider"));
	    }
	}
	return $this->render('FrontConfigBundle:VoyageOrganise:slider.html.twig', array(
		    'sliders' => $sliders,
		    'form' => $form->createView(),
	));
    }

    public function deleteSliderAction(SliderVO $slider)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	try
	{
	    $em->remove($slider);
	    $em->flush();
	    $session->getFlashBag()->add('success', " Votre top slider a été supprimé avec succées ");
	}
	catch (\Exception $ex)
	{
	    $session->getFlashBag()->add('danger', 'Votre slider est utilisé dans une autre table');
	}
	return $this->redirect($this->generateUrl('front_config_voyageorganise_slider'));
    }
    
}
