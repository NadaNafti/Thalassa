<?php

namespace Back\ProgrammeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\ProgrammeBundle\Entity\Reservation;
use Back\ProgrammeBundle\Entity\ReservationLigne;
use Back\ProgrammeBundle\Form\ReservationLigneType;
use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Form\PieceType;
use Back\CommercialBundle\Entity\Reglement;
use Back\AdministrationBundle\Entity\SousEtat;
use Back\AdministrationBundle\Form\SousEtatPRType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReservationController extends Controller {

    public function notificationAction() {
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository('BackProgrammeBundle:Reservation')->filtre(1);
        return $this->render('BackProgrammeBundle:reservation:notification.html.twig', array(
                    'reservations' => $reservations,
        ));
    }

    public function listeAction($page, $etat, $sort, $direction) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->isMethod("POST"))
            return $this->redirect($this->generateUrl('back_programmes_reservation', array('etat' => $request->get('etatFiltre'))));
        $reservations = $em->getRepository('BackProgrammeBundle:Reservation')->filtre($etat, $sort, $direction);
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($reservations, $page, 20);
        $form = $this->createForm(new SousEtatPRType(), new SousEtat());
        return $this->render('BackProgrammeBundle:reservation:liste.html.twig', array(
                    'reservations' => $reservations,
                    'form' => $form->createView()
        ));
    }

    public function priseEnChargeAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        $em->flush();
        $session->getFlashBag()->add('success', "Vous avez pris en charge cette réservation avec succès ");
        return $this->redirect($this->generateUrl("back_programmes_reservation_consulter", array('id' => $reservation->getId())));
    }

    public function consulterAction(Reservation $reservation) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if ($reservation->getEtat() == 1 && ($reservation->getPeriode()->getMax() - $reservation->getPeriode()->getNombreInscription()) <= 0)
            $session->getFlashBag()->add('info', 'Il y a plus de place dans cette Période <br><strong>Maximum d\'inscription : </strong>' . $reservation->getPeriode()->getMax() . '<br><strong>Nombre de place</strong> : ' . $reservation->getPeriode()->getNombreInscription());
        $reservationLigne = new ReservationLigne();
        $form = $this->createForm(new ReservationLigneType(), $reservationLigne->setCode('Manuelle'));
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $reservationLigne = $form->getData();
                $em->persist($reservationLigne);
                $em->flush();
                $session->getFlashBag()->add('success', "Votre ligne a été modifé avec succées");
                return $this->redirect($this->generateUrl('back_programmes_reservation_consulter', array('id' => $reservation->getId())));
            }
        }
        return $this->render('BackProgrammeBundle:reservation:consulter.html.twig', array(
                    'reservation' => $reservation,
                    'form' => $form->createView(),
        ));
    }

    public function annulerAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $periode = $reservation->getPeriode();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            foreach ($reservation->getReglements() as $reglement) {
                $piece = $reglement->getPiece();
                $em->persist($piece->setMontant($piece->getMontant() + $reglement->getMontant())->setRegle(FALSE)->setDateReglement(NULL));
                $em->remove($reglement);
            }
            if ($reservation->getEtat() == 2 && !$reservation->getPeriode()->getDepartGarantie())
                $em->persist($periode->setNombreInscription($periode->getNombreInscription() - $reservation->getNombreOccupants()));
            $em->persist($reservation->setValidated(NULL)->setEtat(9)->setCommentaire($request->get('commentaire')));
            $em->flush();
            $this->container->get('mailerservice')->annulation($reservation, 'PR');
            $session->getFlashBag()->add('success', "Réservation a été annullée avec succès ");
        }
        return $this->redirect($this->generateUrl("back_programmes_reservation_consulter", array('id' => $reservation->getId())));
    }

    public function deleteAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            $em->remove($reservation);
            $em->flush();
            $session->getFlashBag()->add('success', "Réservation a été supprimée avec succès ");
        }
        return $this->redirect($this->generateUrl("back_programmes_reservation"));
    }

    public function validerAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $periode = $reservation->getPeriode();
        $pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array('client' => $reservation->getClient(), 'regle' => FALSE));
        if ($user->getId() != $reservation->getResponsable()->getId() || $reservation->getEtat() == 2)
            return $this->redirect($this->generateUrl("back_programmes_reservation_consulter", array('id' => $reservation->getId())));
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
                    $reglement->setReservationPR($reservation);
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
                    $reglement->setReservationPR($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                    $session->getFlashBag()->add('success', "Votre piéce a été ajoutée avec succès");
                } else
                    $session->getFlashBag()->add('danger', "Le montant de la piéce doit étre suppérieure à 0");
            }
            if ($reservation->getMontantRestant() == 0) {
                $em->persist($periode->setNombreInscription($periode->getNombreInscription() + $reservation->getNombreOccupants()));
                $session->getFlashBag()->add('info', 'Reste encore ' . ($periode->getMax() - $periode->getNombreInscription()) . ' places dans ' . $reservation->getProgramme()->getLibelle());
                $em->persist($reservation->setEtat(2)->setValidated(new \DateTime()));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Réservation a été validée avec succès ");
                $this->container->get('mailerservice')->validation($reservation, 'PR');
                return $this->redirect($this->generateUrl("back_programmes_reservation_consulter", array('id' => $reservation->getId())));
            } else
                $session->getFlashBag()->add('info', " Votre Réservation n'a pas été encore validée, reste encore <strong>" . $reservation->getMontantRestant() . " DT </strong> a payé");
            $em->flush();
            return $this->redirect($this->generateUrl("back_programmes_reservation_validation", array('id' => $reservation->getId())));
        }
        if (($reservation->getPeriode()->getMax() - $reservation->getPeriode()->getNombreInscription()) <= 0)
            $session->getFlashBag()->add('info', 'Il y a plus de place dans cette Période <br><strong>Maximum d\'inscription : </strong>' . $reservation->getPeriode()->getMax() . '<br><strong>Nombre de place</strong> : ' . $reservation->getPeriode()->getNombreInscription());
        return $this->render('BackProgrammeBundle:reservation:validation.html.twig', array(
                    'reservation' => $reservation,
                    'form' => $form->createView(),
                    'pieces' => $pieces,
        ));
    }

    public function deleteLigneAction(ReservationLigne $ligne) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($ligne);
        $em->flush();
        $session->getFlashBag()->add('success', "Ligne a été supprimée avec succès ");
        if (!is_null($ligne->getPersonne()->getReservationA()))
            return $this->redirect($this->generateUrl('back_programmes_reservation_consulter', array('id' => $ligne->getPersonne()->getReservationA()->getId())));
        else
            return $this->redirect($this->generateUrl('back_programmes_reservation_consulter', array('id' => $ligne->getPersonne()->getReservationE()->getId())));
    }

    public function editLigneAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $ligne = $em->getRepository('BackProgrammeBundle:ReservationLigne')->find($request->get('editLineId'));
        if ($ligne && $user->getId() == $reservation->getResponsable()->getId()) {
            $ligne->setLibelle($request->get('editLineLibelle'))
                    ->setAchat($request->get('editLineAchat'))
                    ->setVente($request->get('editLineVente'));
            $em->persist($ligne);
            $em->flush();
        }
        $session->getFlashBag()->add('success', "Ligne a été modifié avec succès ");
        return $this->redirect($this->generateUrl('back_programmes_reservation_consulter', array('id' => $reservation->getId())));
    }

    public function remiseAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            $remise = abs($this->getRequest()->get("remise"));
            $em->persist($reservation->setRemise($remise));
            $em->flush();
            $session->getFlashBag()->add('success', "Votre Remise a été modifié avec succés ");
        }
        return $this->redirect($this->generateUrl('back_programmes_reservation_consulter', array('id' => $reservation->getId())));
    }

    public function addSousEtatsAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $currentUser = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new SousEtatPRType(), new SousEtat());
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($form->getData()->setUser($currentUser));
                $em->flush();
                $session->getFlashBag()->add('success', " Sous-état ajouté avec succès ");
                return $this->redirect($this->generateUrl('back_programmes_reservation'));
            }
        }
    }

    public function ajaxSousEtatsAction() {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->find('BackProgrammeBundle:Reservation', $this->getRequest()->get('id'));
        $array = array();
        $tab = array();
        $response = new JsonResponse();
        if ($reservation) {
            foreach ($reservation->getSousEtats() as $etat) {
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
