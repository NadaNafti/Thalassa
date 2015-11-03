<?php

namespace Back\ReservationDiversBundle\Controller;

use Back\ReservationDiversBundle\Entity\Reservation;
use Back\ReservationDiversBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{
    public function nouveauAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session =$this->getRequest()->getSession();
        if(is_null($id))
            $reservation = new Reservation();
        else
            $reservation=$em->find('BackReservationDiversBundle:Reservation',$id);
        $form=$this->createForm(new ReservationType(),$reservation);
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $reservation=$form->getData();
                $em->persist($reservation);
                foreach($reservation->getLignes() as $ligne)
                    $em->persist($ligne->setReservation($reservation));
                $em->flush();
                return $this->redirect($this->generateUrl('back_reservation_divers_nouveau',array('id'=>$reservation->getId())));
            }
        }
        return $this->render('BackReservationDiversBundle:Reservation:nouveau.html.twig',array('form'=>$form->createView()));
    }
}
