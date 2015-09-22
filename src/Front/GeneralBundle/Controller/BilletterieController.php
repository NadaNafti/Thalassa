<?php

namespace Front\GeneralBundle\Controller;

use Back\BilletterieMaritimeBundle\Entity\BilletterieReservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BilletterieController extends Controller
{
    public function reservationAction()
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
            $client = $user->getClient();
        else
            $client = $this->container->get('users')->getPassager();
    }
}
