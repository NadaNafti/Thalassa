<?php

namespace Back\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\AdministrationBundle\Entity\Amicale;
use Back\AdministrationBundle\Form\AmicaleType;
use Back\AdministrationBundle\Entity\Convention;
use Back\AdministrationBundle\Form\ConventionType;

class B2bController extends Controller
{

    public function amicaleAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id))
        {
            $amicale=new Amicale();
            $amicale->setMontant(0);
        }
        else
            $amicale=$em->getRepository("BackAdministrationBundle:Amicale")->find($id);
        $form=$this->createForm(new AmicaleType(), $amicale);
        $amicales=$em->getRepository("BackAdministrationBundle:Amicale")->findAll();
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $amicale=$form->getData();
                $em->persist($amicale);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre amicale a été traité avec succées ");
                return $this->redirect($this->generateUrl("amicale"));
            }
        }
        return $this->render('BackAdministrationBundle:b2b:amicale.html.twig', array(
                    'amicales'=>$amicales,
                    'amicale' =>$amicale,
                    'form'    =>$form->createView()
        ));
    }

    public function deleteAmicaleAction(Amicale $amicale)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($amicale);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre amicale a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("amicale"));
    }

    public function hotelsAction(Amicale $amicale)
    {
        $em=$this->getDoctrine()->getManager();
        $session =$this->getRequest()->getSession();
        $form=$this->createForm(new AmicaleType(), $amicale);
        $form   ->remove("libelle")
                ->remove("produits")
                ->remove("adresse")
                ->remove("tel")
                ->remove("fax")
                ->remove("plafond")
                ->add("hotels");
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $amicale=$form->getData();
                $em->persist($amicale);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre amicale a été traité avec succées ");
                return $this->redirect($this->generateUrl("amicale_hotel",array('id'=>$amicale->getId())));
            }
        }
        return $this->render('BackAdministrationBundle:b2b:hotels.html.twig', array(
                    'amicale' =>$amicale,
                    'form'    =>$form->createView()
        ));
    }

        public function conventionAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id))
            $convention=new Convention();
        else
            $convention=$em->getRepository("BackAdministrationBundle:Convention")->find($id);
        $amicales=$em->getRepository("BackAdministrationBundle:Amicale")->findAll();
        $form=$this->createForm(new ConventionType(), $convention);
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $convention=$form->getData();
                $em->persist($convention);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre convention a été traité avec succées ");
                return $this->redirect($this->generateUrl("convention_amicale"));
            }
        }
        return $this->render('BackAdministrationBundle:b2b:convention.html.twig', array(
                    'amicales'=>$amicales,
                    'convention' =>$convention,
                    'form'       =>$form->createView()
        ));
    }

    public function deleteConventionAction(Convention $convention)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($convention);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre convention a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("convention_amicale"));
    }

}
