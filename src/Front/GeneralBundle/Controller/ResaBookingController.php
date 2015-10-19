<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResaBookingController extends Controller
{
    public function listeAction($page,$region,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('FrontGeneralBundle:resabooking/liste:liste.html.twig');
    }
}
