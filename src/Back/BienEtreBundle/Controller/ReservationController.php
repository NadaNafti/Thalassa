<?php

namespace Back\BienEtreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\BienEtreBundle\Entity\Reservation;
use Back\CommercialBundle\Form\PieceType;
use Back\CommercialBundle\Entity\Reglement;
use Back\AdministrationBundle\Entity\SousEtat;
use Back\AdministrationBundle\Form\SousEtatBEType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller {

    public function listeAction($page, $etat, $sort, $direction) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->isMethod("POST"))
            return $this->redirect($this->generateUrl('back_bienetre_reservation_liste', array('etat' => $request->get('etatFiltre'))));
        $reservations = $em->getRepository('BackBienEtreBundle:Reservation')->filtre($etat, $sort, $direction);
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($reservations, $page, 20);
        $form = $this->createForm(new SousEtatBEType(), new SousEtat());
        return $this->render('BackBienEtreBundle:reservation:liste.html.twig', array(
                    'reservations' => $reservations,
                    'form' => $form->createView()
        ));
    }

    public function prendreEnChargeAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        $em->flush();
        $session->getFlashBag()->add('success', "Vous avez pris en charge cette réservation avec succès ");
        return $this->redirect($this->generateUrl("back_bienetre_reservation_consultation", array('id' => $reservation->getId())));
    }

    public function consulterAction(Reservation $reservation) {
        return $this->render('BackBienEtreBundle:reservation:consultation.html.twig', array(
                    'reservation' => $reservation,
        ));
    }

    public function deleteAction(Reservation $reservation) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($reservation);
            $em->flush();
            $session->getFlashBag()->add('success', " La réservation a été supprimée avec succés ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("back_bienetre_reservation_liste"));
    }

    public function annulerAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            foreach ($reservation->getReglements() as $reglement) {
                $piece = $reglement->getPiece();
                $em->persist($piece->setMontant($piece->getMontant() + $reglement->getMontant())->setRegle(FALSE)->setDateReglement(NULL));
                $em->remove($reglement);
            }
            $em->persist($reservation->setValidated(NULL)->setEtat(9)->setCommentaire($request->get('commentaire')));
            $em->flush();
            $this->container->get('mailerservice')->annulation($reservation,'BE');
            $session->getFlashBag()->add('success',"Réservation annullée avec succès ");
        }
        return $this->redirect($this->generateUrl("back_bienetre_reservation_consultation", array('id' => $reservation->getId())));
    }

    public function remiseAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            $remise = abs($this->getRequest()->get("remise"));
            $em->persist($reservation->setRemise($remise));
            $em->flush();
            $session->getFlashBag()->add('success', "La remise a été modifiée avec succés ");
        }
        return $this->redirect($this->generateUrl('back_bienetre_reservation_consultation', array('id' => $reservation->getId())));
    }

    public function validerAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array('client' => $reservation->getClient(), 'regle' => FALSE));
        if ($user->getId() != $reservation->getResponsable()->getId() || $reservation->getEtat() == 2)
            return $this->redirect($this->generateUrl("back_bienetre_reservation_consultation", array('id' => $reservation->getId())));
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
                    $reglement->setReservationBE($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                }
            }
            if ($reservation->getMontantRestant() > 0 && !is_null($data['piece']->getModeReglement()) && !is_null($data['piece']->getMontantOrigine())) {
                if ($data['piece']->getMontantOrigine() > 0) {
                    $reglement = new Reglement();
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
                    $reglement->setReservationBE($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                    $session->getFlashBag()->add('success', "Piéce ajoutée avec succès");
                } else
                    $session->getFlashBag()->add('danger', "Le montant de la piéce doit être supérieur à 0");
            }
            if ($reservation->getMontantRestant() == 0) {
                $em->persist($reservation->setEtat(2)->setValidated(new \DateTime()));
                $em->flush();
                $session->getFlashBag()->add('success',"Réservation validée avec succès ");
                $this->container->get('mailerservice')->validation($reservation,'BE');
                return $this->redirect($this->generateUrl("back_bienetre_reservation_consultation",array('id' => $reservation->getId())));
            } else
                $session->getFlashBag()->add('info', "Réservation non encore validée, il reste encore <strong>" . $reservation->getMontantRestant() . " DT </strong> à payer");
            $em->flush();
            return $this->redirect($this->generateUrl("back_bienetre_reservation_validation", array('id' => $reservation->getId())));
        }
        return $this->render('BackBienEtreBundle:reservation:validation.html.twig', array(
                    'reservation' => $reservation,
                    'form' => $form->createView(),
                    'pieces' => $pieces,
        ));
    }

    public function notificationAction() {
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository("BackBienEtreBundle:Reservation")->findBy(array('etat' => 1), array('id' => 'desc'));
        return $this->render('BackBienEtreBundle:reservation:notification.html.twig', array(
                    'reservations' => $reservations,
        ));
    }
    
    public function addSousEtatsAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $currentUser = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new SousEtatBEType(), new SousEtat());
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($form->getData()->setUser($currentUser));
                $em->flush();
                $session->getFlashBag()->add('success', " Sous-état ajouté avec succès ");
                return $this->redirect($this->generateUrl('back_bienetre_reservation_liste'));
            }
        }
    }
    
    public function ajaxSousEtatsAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->find('BackBienEtreBundle:Reservation',$this->getRequest()->get('id'));
        $array = array();
        $tab = array();
        $response = new JsonResponse();
        if ($reservation)
        {
            foreach ($reservation->getSousEtats() as $etat)
            {
                $tab['etat'] = $etat->getEtat()->getLibelle();
                $tab['user'] = $etat->getUser()->getUsername();
                $tab['commentaire'] = $etat->getCommentaire();
                $tab['date'] = $etat->getCreated()->format('d/m/Y h:i');
                $array[] = $tab;
            }
        }
        $response->setData($array);
        return $response;
    }

}
