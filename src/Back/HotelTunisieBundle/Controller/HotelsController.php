<?php

namespace Back\HotelTunisieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\HotelTunisieBundle\Entity\Hotel;
use Back\HotelTunisieBundle\Form\HotelType;

class HotelsController extends Controller
{
    public function ajoutAction()
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $session=$this->getRequest()->getSession();
        $hotel = new Hotel;
        $form =$this->createForm(new HotelType(), $hotel);
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $hotel=$form->getData();
                $em->persist($hotel);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre hotel a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("list_hotels"));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:ajout.html.twig',array(
            'form'=>$form->createView()
        ));
    }
    
    public function listeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $hotels=$em->getRepository("BackHotelTunisieBundle:Hotel")->findAll();
        $paginator=$this->get('knp_paginator');
        $hotels=$paginator->paginate($hotels, $request->query->get('page', 1), 10);
        return $this->render('BackHotelTunisieBundle:Hotels:liste.html.twig',array(
                    'hotels'=>$hotels,
        ));
    }
}
