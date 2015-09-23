<?php

namespace Front\GeneralBundle\Controller;

use Back\BilletterieMaritimeBundle\Entity\MaritimeReservation;
use Back\BilletterieMaritimeBundle\Form\MaritimeReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MaritimeController extends Controller
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
        $reservation= new MaritimeReservation();
        $reservation->setClient($client)
            ->setNomPrenom($client->getNomPrenom())
            ->setTel($client->getTel1());
        if (!is_null($client->getUser()))
            $reservation->setEmail($client->getUser()->getEmail());
        $form=$this->createForm(new MaritimeReservationType(),$reservation);
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $reservation=$form->getData();
                $em->persist($reservation->setEtat(1)->setFrontOffice(1));
                $em->flush();
                return $this->redirect($this->generateUrl('front_maritime_succees',array('id'=>$reservation->getId())));
            }
        }
        return $this->render('FrontGeneralBundle:maritime:reservation.html.twig',array('form'=>$form->createView()));
    }

    public function successAction(MaritimeReservation $reservation)
    {
        return $this->render("FrontGeneralBundle:maritime:success.html.twig", array(
            'reservation' => $reservation
        ));
    }
}
