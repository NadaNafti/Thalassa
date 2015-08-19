<?php

namespace Back\ProgrammeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\ProgrammeBundle\Entity\Theme;
use Back\ProgrammeBundle\Form\ThemeType;


class ReferentielController extends Controller
{

    public function themeAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	if (is_null($id))
	    $theme = new Theme();
	else
	    $theme = $em->getRepository('BackProgrammeBundle:Theme')->find($id);
	$themes = $em->getRepository('BackProgrammeBundle:Theme')->findBy(array(), array('id'=>'desc'));
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
		return $this->redirect($this->generateUrl('back_programme_theme'));
	    }
	}
	return $this->render('BackProgrammeBundle:referentiel:theme.html.twig', array(
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
	return $this->redirect($this->generateUrl('back_programme_theme'));
    }

}
