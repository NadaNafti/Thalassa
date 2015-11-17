<?php

namespace Back\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
       return $this->render('BackGeneralBundle:Default:index.html.twig');
    }

    public function allReservationAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reservations=$em->getRepository('BackHotelTunisieBundle:Reservation')->findAll();
        return $this->render('BackGeneralBundle:Default:allreservation.html.twig',array('reservations'=>$reservations));
    }
}
