<?php

namespace Back\AdministrationBundle\Controller;

use Back\AdministrationBundle\Entity\Etat;
use Back\AdministrationBundle\Form\EtatType;
use Back\AdministrationBundle\Entity\PointVente;
use Back\AdministrationBundle\Form\PointVenteType;
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
    
    public function pointVenteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id))
            $pointVente=new PointVente();
        else
            $pointVente=$em->find('BackAdministrationBundle:PointVente',$id);
        $form=$this->createForm(new PointVenteType(),$pointVente);
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $pointVente=$form->getData();
                $em->persist($pointVente);
                $em->flush();
                $session->getFlashBag()->add('success', " Point de vente a été enregistré avec succès ");
                return $this->redirect($this->generateUrl('configuration_pointVente'));
            }
        }
        return $this->render('BackAdministrationBundle:configuration:pointVente.html.twig', array(
            'form' => $form->createView(),
            'pointVentes' => $em->getRepository('BackAdministrationBundle:PointVente')->findAll(),
        ));
    }
    
    public function pointVenteDeleteAction(PointVente $pointVente)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        try
        {
            $em->remove($pointVente);
            $em->flush();
            $session->getFlashBag()->add('success', " Point de vente a été supprimé avec succès ");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("configuration_pointVente"));
    }

    public function etatAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id))
            $etat=new Etat();
        else
            $etat=$em->find('BackAdministrationBundle:Etat',$id);
        $form=$this->createForm(new EtatType(),$etat);
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $etat=$form->getData();
                $em->persist($etat);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre état a été enregistré avec succès ");
                return $this->redirect($this->generateUrl('configuration_etat'));
            }
        }
        return $this->render('BackAdministrationBundle:configuration:etat.html.twig', array(
            'form' => $form->createView(),
            'produits' => $em->getRepository('BackAdministrationBundle:Produit')->findAll(),
        ));
    }

    public function etatDeleteAction(Etat $etat)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        try
        {
            $em->remove($etat);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre état a été supprimé avec succès ");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("configuration_etat"));
    }

}
