<?php

namespace Front\GeneralBundle\Controller;

use Back\ResaBookingBundle\Entity\Hotel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\ResaBookingBundle\WSDL\rooms;

class ResaBookingController extends Controller
{
    public function listeAction($page,$region,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        if($debut =='_')
        {
            $debut=date('Y-m-d');
            $fin=date('Y-m-d', strtotime($debut. ' + 1 days'));
        }
        $rooms= $this->container->get('resabookingservice')->getRooms($room1,$room2,$room3,$room4,$room5);
        $reponse=$this->container->get('resabookingservice')->availabilityHotel($region,$debut,$fin, $rooms);
        return $this->render('FrontGeneralBundle:resabooking/liste:liste.html.twig',array('reponse'=>$reponse));
    }

    public function detailsAction(Hotel $hotel,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        dump($hotel);
        return $this->render('FrontGeneralBundle:resabooking/details:details.html.twig',array('hotel'=>$hotel));
    }
}
