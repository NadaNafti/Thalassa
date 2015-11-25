<?php

namespace Back\ResaBookingBundle\Controller;

use Back\ResaBookingBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Form\PieceType;
use Back\CommercialBundle\Entity\Reglement;

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

    public function enChargeAction(Reservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        $em->flush();
        $session->getFlashBag()->add('success', "Vous avez pris en charge cette réservation avec succès ");
        return $this->redirect($this->generateUrl("back_resabooking_reservation_details", array('id' => $reservation->getId())));
    }

    public function detailsAction(Reservation $reservation)
    {
        return $this->render('BackResaBookingBundle:reservation:consultation.html.twig',array(
            'reservation'=>$reservation
        ));
    }

    public function validationAction(Reservation $reservation){
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array('client' => $reservation->getClient(), 'regle' => FALSE));
        if ($user->getId() != $reservation->getResponsable()->getId() || $reservation->getEtat() == 2)
            return $this->redirect($this->generateUrl("back_resabooking_reservation_details", array('id' => $reservation->getId())));
        $form = $this->createFormBuilder()
            ->add("piece", new PieceType());
        foreach ($pieces as $piece)
            $form->add('piece' . $piece->getId(), 'checkbox', array('label' => $piece->getNumero(), 'required' => FALSE));
        $form = $form->getForm();
        if ($request->isMethod("POST")) {
            $form->submit($request);
            $data = $form->getData();
            foreach ($pieces as $piece) {
                if ($data['piece' . $piece->getId()] && $reservation->getMontantRestant() > 0) {
                    $reglement = new Reglement();
                    if ($piece->getMontant() <= $reservation->getMontantRestant()) {
                        $reglement->setMontant($piece->getMontant());
                        $em->persist($piece->setRegle(TRUE)->setDateReglement(new \DateTime())->setMontant(0));
                    } else {
                        $reglement->setMontant($reservation->getMontantRestant());
                        $em->persist($piece->setMontant($piece->getMontant() - $reservation->getMontantRestant()));
                    }
                    $reglement->setPiece($piece);
                    $reglement->setReservatioRB($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                }
            }
            if ($reservation->getMontantRestant() > 0 && !is_null($data['piece']->getModeReglement()) && !is_null($data['piece']->getMontantOrigine())) {
                if ($data['piece']->getMontantOrigine() > 0) {
                    $reglement = new Reglement();
                    $piece = new Piece();
                    $piece = $data['piece'];
                    $piece->setClient($reservation->getClient())
                        ->setDateCreation(new \DateTime());
                    if ($piece->getMontantOrigine() <= $reservation->getMontantRestant()) {
                        $reglement->setMontant($piece->getMontantOrigine());
                        $em->persist($piece->setRegle(TRUE)->setDateReglement(new \DateTime())->setMontant(0));
                    } else {
                        $reglement->setMontant($reservation->getMontantRestant());
                        $em->persist($piece->setRegle(FALSE)->setMontant($piece->getMontantOrigine() - $reservation->getMontantRestant()));
                    }
                    $reglement->setPiece($piece);
                    $reglement->setReservationRB($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                    $session->getFlashBag()->add('success', "Votre piéce a été ajoutée avec succès");
                } else
                    $session->getFlashBag()->add('danger', "Le montant de la piéce doit étre suppérieure à 0");
            }
            if ($reservation->getMontantRestant() == 0) {
                $em->persist($reservation->setEtat(2)->setValidated(new \DateTime()));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Réservation a été validée avec succès ");
                $this->container->get('mailerservice')->validation($reservation, 'PR');
                return $this->redirect($this->generateUrl("back_resabooking_reservation_details", array('id' => $reservation->getId())));
            } else
                $session->getFlashBag()->add('info', " Votre Réservation n'a pas été encore validée, reste encore <strong>" . $reservation->getMontantRestant() . " DT </strong> a payé");
            $em->flush();
            return $this->redirect($this->generateUrl("back_resabooking_reservation_validation", array('id' => $reservation->getId())));
        }
        return $this->render('BackResaBookingBundle:reservation:validation.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
            'pieces' => $pieces,
        ));
    }
}
