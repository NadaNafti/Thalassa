<?php

namespace Front\GeneralBundle\Controller;

use Back\BilletterieMaritimeBundle\Entity\BilletterieReservation;
use Back\BilletterieMaritimeBundle\Entity\BilletterieReservationLigne;
use Back\BilletterieMaritimeBundle\Form\BilletterieReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BilletterieController extends Controller
{
    public function reservationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
            $client = $user->getClient();
        else
            $client = $this->container->get('users')->getPassager();
        $reservation = new BilletterieReservation();
        $reservation->setClient($client)
            ->setNomPrenom($client->getNomPrenom())
            ->setTel($client->getTel1());
        if (!is_null($client->getUser()))
            $reservation->setEmail($client->getUser()->getEmail());
        $form = $this->createForm(new BilletterieReservationType(), $reservation);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $reservation = $form->getData();
                $em->persist($reservation->setEtat(1)->setFrontOffice(1));
                foreach ($reservation->getLignes() as $ligne)
                    $em->persist($ligne->setReservation($reservation));
                $em->flush();
                return $this->redirect($this->generateUrl('front_billetterie_succees',array('id'=>$reservation->getId())));
            }
        }
        return $this->render('FrontGeneralBundle:billetterie:reservation.html.twig', array(
                'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate'),
                'form'       => $form->createView())
        );
    }

    public function successAction(BilletterieReservation $reservation)
    {
        return $this->render("FrontGeneralBundle:billetterie:success.html.twig", array(
            'reservation' => $reservation
        ));
    }
}
