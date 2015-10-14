<?php

namespace Back\ResaBookingBundle\Controller;

use Back\ResaBookingBundle\Entity\Configuration;
use Back\ResaBookingBundle\Form\ConfigurationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConfigurationController extends Controller
{
    public function parametresAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request= $this->getRequest();
        $configuration= $em->find('BackResaBookingBundle:Configuration',1);
        if(!$configuration)
            $configuration=new Configuration();
        $form=$this->createForm(new ConfigurationType(),$configuration);
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $configuration=$form->getData();
                $em->persist($configuration);
                $em->flush();
                $session->getFlashBag()->add('success'," Vos paramétres ont été traités avec succées ");
                return $this->redirect($this->generateUrl('back_resabooking_config_parametres'));
            }
        }
        return $this->render('BackResaBookingBundle:configuration:parametres.html.twig',array('form'=>$form->createView()));
    }
}
