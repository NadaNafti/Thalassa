<?php

namespace Back\ResaBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{
    public function listeAction($page,$etat)
    {
        $em=$this->getDoctrine()->getManager();
        $reservations = $em->getRepository('BackResaBookingBundle:Reservation')->filtreBackOffice($etat);
        $reservations = $this->get('knp_paginator')->paginate($reservations, $page, 20);
        return $this->render('BackResaBookingBundle:reservation:liste.html.twig',array(
            'reservations'=>$reservations
        ));
    }

    public function filtreAction()
    {
        return $this->redirect($this->generateUrl('back_resabooking_reservation_liste',array('etat'=>$this->getRequest()->get('etat'))));
    }
}
