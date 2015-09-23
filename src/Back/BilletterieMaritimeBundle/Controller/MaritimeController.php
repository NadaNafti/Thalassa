<?php

namespace Back\BilletterieMaritimeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MaritimeController extends Controller
{

    public function listeAction($page,$etat,$sort,$direction)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if($request->isMethod("POST"))
            return $this->redirect($this->generateUrl('back_maritime_reservation_liste',array('etat' => $request->get('etatFiltre'))));
        $reservations = $em->getRepository('BackBilletterieMaritimeBundle:MaritimeReservation')->filtre($etat,$sort,$direction);
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($reservations,$page,20);
        return $this->render('BackBilletterieMaritimeBundle:maritime:liste.html.twig',array(
            'reservations' => $reservations,
        ));
    }
    public function notificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository("BackBilletterieMaritimeBundle:MaritimeReservation")->findBy(array('etat'=>1),array('id'=>'desc'));
        return $this->render('BackBilletterieMaritimeBundle:maritime:notification.html.twig', array(
            'reservations' => $reservations,
        ));
    }
}
