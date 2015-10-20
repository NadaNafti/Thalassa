<?php

namespace Front\GeneralBundle\Controller;

use Back\ResaBookingBundle\Entity\Hotel;
use Back\ResaBookingBundle\WSDL\chamb;
use Back\ResaBookingBundle\WSDL\chambs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\ResaBookingBundle\WSDL\rooms;

class ResaBookingController extends Controller
{
    public function initialiseAction()
    {
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            return $this->redirect($this->generateUrl('front_resabooking_liste',array(
                'region'=>urlencode($request->get('region')),
                'debut'=>$request->get('debut'),
                'fin'=>$request->get('fin'),
            )));
        }
        return $this->redirect($this->generateUrl('front_resabooking_liste',array(
            'debut'=>date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')),
            'fin'=>date('Y-m-d', strtotime(date('Y-m-d'). ' + 2 days')),
        )));
    }

    public function listeAction($page,$region,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        $rooms= $this->container->get('resabookingservice')->getRooms($room1,$room2,$room3,$room4,$room5);
        $reponse=$this->container->get('resabookingservice')->availabilityHotel($region,$debut,$fin, $rooms);
        if($reponse->rep->statut=='failure')
            $this->getRequest()->getSession()->getFlashBag()->add('warning', $reponse->rep->detail_erreur);
        return $this->render('FrontGeneralBundle:resabooking/liste:liste.html.twig',array('reponse'=>$reponse));
    }

    public function detailsAction(Hotel $hotel,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        $rooms= $this->container->get('resabookingservice')->getRooms($room1,$room2,$room3,$room4,$room5);
        $reponse=$this->container->get('resabookingservice')->availabilityHotel($hotel->getProduit()['region'],$debut,$fin, $rooms,$hotel->getId());
        if($reponse->rep->statut=='failure')
            $this->getRequest()->getSession()->getFlashBag()->add('warning', $reponse->rep->detail_erreur);
        return $this->render('FrontGeneralBundle:resabooking/details:details.html.twig',array(
            'hotel'=>$hotel,
            'reponse'=>$reponse
        ));
    }

    public function detailsUpdateRoomsAction($hotel)
    {
        $room1=null;
        $room2=null;
        $room3=null;
        $room4=null;
        $room5=null;
        $request=$this->getRequest();
        for($i=1;$i<=$request->get('nombreChambre');$i++)
        {
            $var='room'.$i;
            $$var=$request->get('adulte'.$i);
            for($j=1;$j<=$request->get('enfant'.$i);$j++)
                $$var.=','.$request->get("age_".$i."_".$j);
        }

        return $this->redirect($this->generateUrl('front_resabooking_details',array(
            'hotel'=>$hotel,
            'debut'=>$request->get('debut'),
            'fin'=>$request->get('fin'),
            'room1'=>$room1,
            'room2'=>$room2,
            'room3'=>$room3,
            'room4'=>$room4,
            'room5'=>$room5
        )));
    }
}
