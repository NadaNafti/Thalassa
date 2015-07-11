<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\Reservation;
use Back\VoyageOrganiseBundle\Entity\ReservationLigne;
use Back\VoyageOrganiseBundle\Form\ReservationType;
use Back\VoyageOrganiseBundle\Form\ReservationLigneType;
use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Form\PieceType;
use Back\CommercialBundle\Entity\Reglement;

class ReservationController extends Controller
{

    public function ajouterAction()
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$user = $this->get('security.context')->getToken()->getUser();
	$reservation = new Reservation ();
	$form = $this->createForm(new ReservationType(), $reservation);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    $reservation = $form->getData();
	    $reservation->setResponsable($user)
		    ->setFrontOffice(false)
		    ->setEtat(1);
	    $em->persist($reservation);
	    if (count($reservation->getAdultes()) == 0 && count($reservation->getEnfants()) == 0)
	    {
		$session->getFlashBag()->add('warning', "Vous devez  choisir au moin un adulte ");
		return $this->redirect($this->generateUrl('back_voyages_organises_reservation_ajouter'));
	    }
	    foreach ($reservation->getAdultes() as $adulte)
		$em->persist($adulte->setReservationA($reservation)->setAge(null));
	    foreach ($reservation->getEnfants() as $enfant)
		$em->persist($enfant->setReservationE($reservation));
	    $em->flush();
	    $session->getFlashBag()->add('success', " Votre Réservation a été ajoutée avec succées ");
	    return $this->redirect($this->generateUrl("back_voyages_organises_reservation"));
	}
	return $this->render('BackVoyageOrganiseBundle:reservation:ajout.html.twig', array(
		    'form' => $form->createView()
	));
    }

    public function listeAction($page)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$user = $this->get('security.context')->getToken()->getUser();
	$reservations = $em->getRepository('BackVoyageOrganiseBundle:Reservation')->findAll();
	$paginator = $this->get('knp_paginator');
	$reservations = $paginator->paginate($reservations, $page, 20);
	return $this->render('BackVoyageOrganiseBundle:reservation:liste.html.twig', array(
		    'reservations' => $reservations
	));
    }

    public function priseEnChargeAction(Reservation $reservation)
    {
	$user = $this->get('security.context')->getToken()->getUser();
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$em->persist($reservation->setResponsable($user));
	$em->flush();
	$session->getFlashBag()->add('success', "Vous avez pris en charge cette réservation avec succès ");
	return $this->redirect($this->generateUrl("back_voyages_organises_reservation"));
    }

    public function consulterAction(Reservation $reservation)
    {
	return $this->render('BackVoyageOrganiseBundle:reservation:consulter.html.twig', array(
		    'reservation' => $reservation
	));
    }

    public function annulerAction(Reservation $reservation)
    {
	$user = $this->get('security.context')->getToken()->getUser();
	$em = $this->getDoctrine()->getManager();
	$request = $this->getRequest();
	$session = $this->getRequest()->getSession();
	if ($user->getId() == $reservation->getResponsable()->getId())
	{
	    foreach ($reservation->getReglements() as $reglement)
	    {
		$piece = $reglement->getPiece();
		$em->persist($piece->setMontant($piece->getMontant() + $reglement->getMontant())->setRegle(false)->setDateReglement(null));
		$em->remove($reglement);
	    }
	    if ($reservation->getEtat() == 2)
		$em->persist($reservation->getVoyage()->setNbrInscriptions($reservation->getVoyage()->getNbrInscriptions() - 1));
	    $em->persist($reservation->setEtat(9)->setCommentaire($request->get('commentaire')));
	    $em->flush();
	    $session->getFlashBag()->add('success', "Réservation a été annullée avec succès ");
	}
	return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array('id' => $reservation->getId())));
    }

    public function deleteAction(Reservation $reservation)
    {
	$user = $this->get('security.context')->getToken()->getUser();
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	if ($user->getId() == $reservation->getResponsable()->getId())
	{
	    $em->remove($reservation);
	    $em->flush();
	    $session->getFlashBag()->add('success', "Réservation a été supprimée avec succès ");
	}
	return $this->redirect($this->generateUrl("back_voyages_organises_reservation"));
    }

    public function totalAction(Reservation $reservation)
    {
	$user = $this->get('security.context')->getToken()->getUser();
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$em->persist($reservation->setTotal($this->getRequest()->get('total')));
	$em->flush();
	return $this->redirect($this->generateUrl("back_voyages_organises_reservation_validation", array('id' => $reservation->getId())));
    }

    public function validerAction(Reservation $reservation)
    {
	$user = $this->get('security.context')->getToken()->getUser();
	$em = $this->getDoctrine()->getManager();
	$request = $this->getRequest();
	$session = $this->getRequest()->getSession();
	$pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array('client' => $reservation->getClient(), 'regle' => FALSE));
	if ($user->getId() != $reservation->getResponsable()->getId() || $reservation->getEtat() == 2)
	    return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array('id' => $reservation->getId())));
	$form = $this->createFormBuilder()
		->add("piece", new PieceType());
	foreach ($pieces as $piece)
	    $form->add('piece' . $piece->getId(), 'checkbox', array('label' => $piece->getNumero(), 'required' => false));
	$form = $form->getForm();
	if ($request->isMethod("POST"))
	{
	    if ($reservation->getVoyage()->getNbrInscriptions() + count($reservation->getAdultes()) + count($reservation->getEnfants()) > $reservation->getVoyage()->getNbrInscriptionsMax())
	    {
		$session->getFlashBag()->add('info', "il y a plus de place !!!, le nombre d'inscription courant est " . $reservation->getVoyage()->getNbrInscriptions());
		return $this->redirect($this->generateUrl("back_voyages_organises_reservation_validation", array('id' => $reservation->getId())));
	    }
	    $form->submit($request);
	    $data = $form->getData();
	    foreach ($pieces as $piece)
	    {
		if ($data['piece' . $piece->getId()] && $reservation->getMontantRestant() > 0)
		{
		    $reglement = new Reglement();
		    if ($piece->getMontant() <= $reservation->getMontantRestant())
		    {
			$reglement->setMontant($piece->getMontant());
			$em->persist($piece->setRegle(TRUE)->setDateReglement(new \DateTime())->setMontant(0));
		    }
		    else
		    {
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
	    if ($reservation->getMontantRestant() > 0 && !is_null($data['piece']->getNumero()))
	    {
		if ($data['piece']->getMontantOrigine() > 0)
		{
		    $reglement = new Reglement();
		    $piece = new Piece();
		    $piece = $data['piece'];
		    $piece->setClient($reservation->getClient())
			    ->setDateCreation(new \DateTime());
		    if ($piece->getMontantOrigine() <= $reservation->getMontantRestant())
		    {
			$reglement->setMontant($piece->getMontantOrigine());
			$em->persist($piece->setRegle(TRUE)->setDateReglement(new \DateTime())->setMontant(0));
		    }
		    else
		    {
			$reglement->setMontant($reservation->getMontantRestant());
			$em->persist($piece->setRegle(FALSE)->setMontant($piece->getMontantOrigine() - $reservation->getMontantRestant()));
		    }
		    $reglement->setPiece($piece);
		    $reglement->setReservationVO($reservation);
		    $reglement->setDateCreation(new \DateTime());
		    $em->persist($reglement);
		    $reservation->addReglement($reglement);
		    $session->getFlashBag()->add('success', "Votre piéce a été ajoutée avec succès");
		}
		else
		    $session->getFlashBag()->add('danger', "Le montant de la piéce doit étre suppérieure à 0");
	    }
	    if ($reservation->getMontantRestant() == 0)
	    {
		$em->persist($reservation->getVoyage()->setNbrInscriptions($reservation->getVoyage()->getNbrInscriptions() + count($reservation->getAdultes()) + count($reservation->getEnfants())));
		$em->persist($reservation->setEtat(2)->setValidated(new \DateTime())->setCode($this->container->get('reservation')->getCode()));
		$em->flush();
		$session->getFlashBag()->add('success', " Votre Réservation a été validée avec succès ");
		$session->getFlashBag()->add('info', " Reste encore  ".$reservation->getVoyage()->getNbrInscriptionsMax()-$reservation->getVoyage()->getNbrInscriptions().' places dans '.$reservation->getVoyage()->getLibelle());
		return $this->redirect($this->generateUrl("back_voyages_organises_reservation_consulter", array('id' => $reservation->getId())));
	    }
	    else
		$session->getFlashBag()->add('info', " Votre Réservation n'a pas été encore validée, reste encore <strong>" . $reservation->getMontantRestant() . " DT </strong> a payé");
	    $em->flush();
	    return $this->redirect($this->generateUrl("back_voyages_organises_reservation_validation", array('id' => $reservation->getId())));
	}
	return $this->render('BackVoyageOrganiseBundle:reservation:validation.html.twig', array(
		    'reservation' => $reservation,
		    'form' => $form->createView(),
		    'pieces' => $pieces,
	));
    }

}
