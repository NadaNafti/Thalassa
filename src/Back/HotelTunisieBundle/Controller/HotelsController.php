<?php

namespace Back\HotelTunisieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\HotelTunisieBundle\Entity\Hotel;
use Back\HotelTunisieBundle\Form\HotelType;

class HotelsController extends Controller
{
    public function ajout_hotelAction()
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
                return $this->redirect($this->generateUrl("ajout_hotel"));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:liste.html.twig');
    }
}
