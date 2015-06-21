<?php

namespace Back\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\AdministrationBundle\Entity\Agence;
use Back\AdministrationBundle\Form\AgenceType;
use Symfony\Component\Form\FormError;

class ConfigurationController extends Controller
{

    public function agenceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $agence = $em->getRepository("BackAdministrationBundle:Agence")->find(1);
        if (!$agence)
            $agence = new Agence();
        $form = $this->createForm(new AgenceType(), $agence);
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $agence = $form->getData();
                $em->persist($agence);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre agence a été modifié avec succées ");
                return $this->redirect($this->generateUrl('configuration_agence'));
            }
        }
        return $this->render('BackAdministrationBundle:configuration:agence.html.twig', array(
                    'form' => $form->createView(),
                    'agence' => $agence,
        ));
    }

}
