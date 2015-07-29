<?php

namespace Front\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Front\ConfigBundle\Entity\SliderSHT;
use Front\ConfigBundle\Form\SliderSHTType;

class HotelTunisieController extends Controller
{

    public function sliderAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	if (is_null($id))
	    $slider = new SliderSHT();
	else
	    $slider = $em->getRepository('FrontConfigBundle:SliderSHT')->find($id);
	$sliders = $em->getRepository('FrontConfigBundle:SliderSHT')->findBy(array(), array('ordre' => 'asc'));
	$form = $this->createForm(new SliderSHTType(), $slider);
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$slider = $form->getData();
		$em->persist($slider);
		$em->flush();
		$session->getFlashBag()->add('success', "Votre slider a été mise a jour avec succès ");
		return $this->redirect($this->generateUrl("front_config_hoteltunisie_slider"));
	    }
	}
	return $this->render('FrontConfigBundle:HotelTunisie:slider.html.twig', array(
		    'sliders' => $sliders,
		    'form' => $form->createView(),
	));
    }

    public function deleteSliderAction(SliderSHT $slider)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$em->remove($slider);
	$em->flush();
	$session->getFlashBag()->add('success', " Votre slider a été supprimé avec succées ");
	return $this->redirect($this->generateUrl('front_config_hoteltunisie_slider'));
    }

}
