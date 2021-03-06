<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Back\AdministrationBundle\Form\SousEtatVOType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\Reservation;
use Back\VoyageOrganiseBundle\Entity\ReservationLigne;
use Back\VoyageOrganiseBundle\Form\ReservationType;
use Back\VoyageOrganiseBundle\Form\NewReservationType;
use Back\UserBundle\Form\ClientType;
use Back\VoyageOrganiseBundle\Form\ReservationLigneType;
use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Form\PieceType;
use Back\CommercialBundle\Entity\Reglement;
use Back\VoyageOrganiseBundle\Entity\ReservationPersonne;
use Symfony\Component\HttpFoundation\Response;
use Back\AdministrationBundle\Entity\SousEtat;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReservationController extends Controller {

    public function listeAction($page, $etat, $sort, $direction) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->isMethod("POST"))
            return $this->redirect($this->generateUrl('back_voyages_organises_reservation', array('etat' => $request->get('etatFiltre'))));
        $reservations = $em->getRepository('BackVoyageOrganiseBundle:Reservation')->filtre($etat, $sort, $direction);
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($reservations, $page, 20);
        $form = $this->createForm(new SousEtatVOType(), new SousEtat());
        return $this->render('BackVoyageOrganiseBundle:reservation:liste.html.twig', array(
                    'reservations' => $reservations,
                    'form' => $form->createView()
        ));
    }

    public function newAction() {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $form = $this->createForm(new NewReservationType());
        if ($this->getRequest()->isMethod("POST")) {
            $form->submit($this->getRequest());
            $data = $form->getData();
            dump($data);
            return $this->redirect($this->generateUrl('formulaire_reservationVO', array(
                                'idClient' => $data['client']->getId(),
                                'idPack' => $data['packs']->getId(),
            )));
        }
        return $this->render('BackVoyageOrganiseBundle:Reservation:new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function formulaireAction($idClient, $idPack) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $client = $em->getRepository("BackUserBundle:Client")->find($idClient);
        $pack = $em->getRepository("BackVoyageOrganiseBundle:Pack")->find($idPack);
        $form = $this->createFormBuilder()
                ->add("client", new ClientType(), array('data' => $client));
        $form = $form->getForm();
        if ($request->isMethod('POST')) {
            $form->submit($request);
            $data = $request->request->all();
            $nbrPassagers = 0;
            if (isset($data['chambresingle']))
                $nbrPassagers+=$data['chambresingle'];
            else
                $data['chambresingle'] = 0;
            if (isset($data['chambredouble']))
                $nbrPassagers+=$data['chambredouble'] * 2;
            else
                $data['chambredouble'] = 0;
            if (isset($data['chambretriple']))
                $nbrPassagers+=$data['chambretriple'] * 3;
            else
                $data['chambretriple'] = 0;
            if (isset($data['chambrequadruple']))
                $nbrPassagers+=$data['chambrequadruple'] * 4;
            else
                $data['chambrequadruple'] = 0;
            if ($nbrPassagers == 0) {
                $session->getFlashBag()->add('danger', "Vous devrez choisir au moins une chambre.");
                return $this->redirect($this->generateUrl('formulaire_reservationVO', array('idClient' => $client->getId(), 'idPack' => $pack->getId())));
            } elseif ($pack->getPeriode()->getDepartGarantie() && $nbrPassagers < $pack->getPeriode()->getMin()) {
                $session->getFlashBag()->add('danger', "Vous devrez choisir au moins " . $pack->getPeriode()->getMin() . " personnes.");
                return $this->redirect($this->generateUrl('formulaire_reservationVO', array('idClient' => $client->getId(), 'idPack' => $pack->getId())));
            }
            return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array(
                                'id' => $this->container->get('reservationVO')->saveReservation($pack, $client, $data, 'backoffice'))));
        }
        return $this->render('BackVoyageOrganiseBundle:Reservation:formulaire.html.twig', array(
                    'form' => $form->createView(),
                    'periode' => $pack->getPeriode(),
                    'pack' => $pack
        ));
    }

    public function addSousEtatsAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $currentUser = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new SousEtatVOType(), new SousEtat());
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($form->getData()->setUser($currentUser));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre sous etat a été ajouté avec succées ");
                return $this->redirect($this->generateUrl('back_voyages_organises_reservation'));
            }
        }
    }

    public function priseEnChargeAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        $em->flush();
        $session->getFlashBag()->add('success', "Vous avez pris en charge cette réservation avec succès ");
        return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array('id' => $reservation->getId())));
    }
    
    public function recusAction(Reservation $reservation)
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('BackVoyageOrganiseBundle:Reservation:recus.html.twig', array(
            'reservation' => $reservation,
            'agence'      => $em->getRepository('BackAdministrationBundle:Agence')->find(1),
        ));
    }

    public function consulterAction(Reservation $reservation) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if ($reservation->getEtat() == 1 && !$reservation->getPack()->getPeriode()->getDepartGarantie() && ($reservation->getPack()->getPeriode()->getMax() - $reservation->getPack()->getPeriode()->getNombreInscription()) <= 0)
            $session->getFlashBag()->add('info', 'Il y a plus de place dans cette Période <br><strong>Maximum d\'inscription : </strong>' . $reservation->getPack()->getPeriode()->getMax() . '<br><strong>Nombre de place</strong> : ' . $reservation->getPack()->getPeriode()->getNombreInscription());
        $reservationLigne = new ReservationLigne();
        $form = $this->createForm(new ReservationLigneType(), $reservationLigne->setCode('Manuelle'));
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $reservationLigne = $form->getData();
                $em->persist($reservationLigne);
                $em->flush();
                $session->getFlashBag()->add('success', "Votre ligne a été modifé avec succées");
                return $this->redirect($this->generateUrl('back_voyages_organises_reservation_consulter', array('id' => $reservation->getId())));
            }
        }
        return $this->render('BackVoyageOrganiseBundle:reservation:consulter.html.twig', array(
                    'reservation' => $reservation,
                    'form' => $form->createView(),
        ));
    }

    public function annulerAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $periode = $reservation->getPack()->getPeriode();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            foreach ($reservation->getReglements() as $reglement) {
                $piece = $reglement->getPiece();
                $em->persist($piece->setMontant($piece->getMontant() + $reglement->getMontant())->setRegle(FALSE)->setDateReglement(NULL));
                $em->remove($reglement);
            }
            if ($reservation->getEtat() == 2 && !$reservation->getPack()->getPeriode()->getDepartGarantie())
                $em->persist($periode->setNombreInscription($periode->getNombreInscription() - $reservation->getNombreOccupants()));
            $em->persist($reservation->setValidated(NULL)->setEtat(9)->setCommentaire($request->get('commentaire')));
            $em->flush();
            $this->container->get('mailerservice')->annulation($reservation, 'VO');
            $session->getFlashBag()->add('success', "Réservation a été annullée avec succès ");
        }
        return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array('id' => $reservation->getId())));
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
        return $this->redirect($this->generateUrl("back_voyages_organises_reservation"));
    }

    public function totalAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setTotal($this->getRequest()->get('total')));
        $em->flush();
        return $this->redirect($this->generateUrl("back_voyages_organises_reservation_validation", array('id' => $reservation->getId())));
    }

    public function validerAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $periode = $reservation->getPack()->getPeriode();
        $pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array('client' => $reservation->getClient(), 'regle' => FALSE));
        if ($user->getId() != $reservation->getResponsable()->getId() || $reservation->getEtat() == 2)
            return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array('id' => $reservation->getId())));
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
                    $reglement->setReservationVO($reservation);
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
                    $reglement->setReservationVO($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                    $session->getFlashBag()->add('success', "Votre piéce a été ajoutée avec succès");
                } else
                    $session->getFlashBag()->add('danger', "Le montant de la piéce doit étre suppérieure à 0");
            }
            if ($reservation->getMontantRestant() == 0) {
                if (!$periode->getDepartGarantie()) {
                    $em->persist($periode->setNombreInscription($periode->getNombreInscription() + $reservation->getNombreOccupants()));
                    $session->getFlashBag()->add('info', 'Reste encore ' . ($periode->getMax() - $periode->getNombreInscription()) . ' places dans ' . $reservation->getVoyage()->getLibelle());
                }
                $em->persist($reservation->setEtat(2)->setValidated(new \DateTime()));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Réservation a été validée avec succès ");
                $this->container->get('mailerservice')->validation($reservation, 'VO');
                return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array('id' => $reservation->getId())));
            } else
                $session->getFlashBag()->add('info', " Votre Réservation n'a pas été encore validée, reste encore <strong>" . $reservation->getMontantRestant() . " DT </strong> a payé");
            $em->flush();
            return $this->redirect($this->generateUrl("back_voyages_organises_reservation_validation", array('id' => $reservation->getId())));
        }
        if (!$reservation->getPack()->getPeriode()->getDepartGarantie() && ($reservation->getPack()->getPeriode()->getMax() - $reservation->getPack()->getPeriode()->getNombreInscription()) <= 0)
            $session->getFlashBag()->add('info', 'Il y a plus de place dans cette Période <br><strong>Maximum d\'inscription : </strong>' . $reservation->getPack()->getPeriode()->getMax() . '<br><strong>Nombre de place</strong> : ' . $reservation->getPack()->getPeriode()->getNombreInscription());
        return $this->render('BackVoyageOrganiseBundle:reservation:validation.html.twig', array(
                    'reservation' => $reservation,
                    'form' => $form->createView(),
                    'pieces' => $pieces,
        ));
    }

    public function notificationAction() {
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository('BackVoyageOrganiseBundle:Reservation')->filtre(1);
        return $this->render('BackVoyageOrganiseBundle:reservation:notification.html.twig', array(
                    'reservations' => $reservations,
        ));
    }

    public function deleteLigneAction(ReservationLigne $ligne) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($ligne);
        $em->flush();
        $session->getFlashBag()->add('success', "Ligne a été supprimée avec succès ");
        return $this->redirect($this->generateUrl('back_voyages_organises_reservation_consulter', array('id' => $ligne->getPersonne()->getChambre()->getReservation()->getId())));
    }

    public function editLigneAction(Reservation $reservation) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $ligne = $em->getRepository('BackVoyageOrganiseBundle:ReservationLigne')->find($request->get('editLineId'));
        if ($ligne && $user->getId() == $reservation->getResponsable()->getId()) {
            $ligne->setLibelle($request->get('editLineLibelle'))
                    ->setAchat($request->get('editLineAchat'))
                    ->setVente($request->get('editLineVente'));
            $em->persist($ligne);
            $em->flush();
        }
        $session->getFlashBag()->add('success', "Ligne a été modifié avec succès ");
        return $this->redirect($this->generateUrl('back_voyages_organises_reservation_consulter', array('id' => $reservation->getId())));
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
        return $this->redirect($this->generateUrl('back_voyages_organises_reservation_consulter', array('id' => $reservation->getId())));
    }

    public function contingentAction(Reservation $reservation) {
        return $this->render('BackVoyageOrganiseBundle:reservation:contingent.html.twig', array(
                    'reservation' => $reservation,
        ));
    }

    public function contingentAjaxAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $json = json_decode($request->get('json'));
        if ($request->get('chambre') != 'none') {
            $chambre = $em->find('BackVoyageOrganiseBundle:Chambre', $request->get('chambre'));
            foreach ($json as $id) {
                $pers = $em->find('BackVoyageOrganiseBundle:ReservationPersonne', $id->id);
                if (is_null($pers->getChambreContingent()) || $pers->getChambreContingent()->getId() != $chambre->getId()) {
                    $em->persist($pers->setChambreContingent($chambre));
                    $this->container->get('chambrevo')->updatePersonne($pers, $chambre->getType());
                    $em->flush();
                    return new Response('true');
                }
            }
        } else {
            foreach ($json as $id) {
                $pers = $em->find('BackVoyageOrganiseBundle:ReservationPersonne', $id->id);
                if (!is_null($pers->getChambreContingent())) {
                    $em->persist($pers->setChambreContingent(null));
                    $this->container->get('chambrevo')->updatePersonne($pers, $pers->getChambre()->getType());
                    $em->flush();
                    return new Response('true');
                }
            }
        }
        return new Response($request->get('json'));
    }

    public function ajaxSousEtatsAction() {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->find('BackVoyageOrganiseBundle:Reservation', $this->getRequest()->get('id'));
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

    public function ajaxPeriodeAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $id = $request->get("voyage");
        $response = new JsonResponse();
        $voyage = $em->find("BackVoyageOrganiseBundle:VoyageOrganise", $id);
        $tab = array();
        foreach ($voyage->getPeriodes() as $periode)
            $tab[$periode->getId()] = $periode->getLibelle();
        $response->setData($tab);
        return $response;
    }

    public function ajaxPackAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $id = $request->get("periode");
        $response = new JsonResponse();
        $periode = $em->find("BackVoyageOrganiseBundle:Periode", $id);
        $tab = array();
        foreach ($periode->getPacks() as $pack)
            $tab[$pack->getId()] = $pack->getLibelle();
        $response->setData($tab);
        return $response;
    }

}
