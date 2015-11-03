<?php

namespace Back\BilletterieMaritimeBundle\Controller;

use Back\BilletterieMaritimeBundle\Entity\BilletterieReservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Form\PieceType;
use Back\CommercialBundle\Entity\Reglement;

class BilletterieController extends Controller
{

    public function listeAction($page,$etat,$sort,$direction)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if($request->isMethod("POST"))
            return $this->redirect($this->generateUrl('back_billetterie_reservation_liste',array('etat' => $request->get('etatFiltre'))));
        $reservations = $em->getRepository('BackBilletterieMaritimeBundle:BilletterieReservation')->filtre($etat,$sort,$direction);
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($reservations,$page,20);
        return $this->render('BackBilletterieMaritimeBundle:billetterie:liste.html.twig',array(
            'reservations' => $reservations,
        ));
    }

    public function notificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository("BackBilletterieMaritimeBundle:BilletterieReservation")->findBy(array('etat'=>1),array('id'=>'desc'));
        return $this->render('BackBilletterieMaritimeBundle:billetterie:notification.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    public function consulterAction(BilletterieReservation $reservation)
    {
        return $this->render('BackBilletterieMaritimeBundle:billetterie:consultation.html.twig', array(
            'reservation' => $reservation,
        ));
    }
    
    public function recuAction(BilletterieReservation $reservation)
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('BackBilletterieMaritimeBundle:billetterie:recus.html.twig', array(
            'reservation' => $reservation,
            'agence'      => $em->getRepository('BackAdministrationBundle:Agence')->find(1),
        ));
    }

    public function deleteAction(BilletterieReservation $reservation)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        try
        {
            $em->remove($reservation);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre etat a été supprimée avec succés ");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("back_billetterie_reservation_liste"));
    }

    public function prendreEnChargeAction(BilletterieReservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        $em->flush();
        $session->getFlashBag()->add('success', "Vous avez pris en charge cette réservation avec succès ");
        return $this->redirect($this->generateUrl("back_billetterie_reservation_consultation", array('id' => $reservation->getId())));
    }

    public function remiseAction(BilletterieReservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            $remise = abs($this->getRequest()->get("remise"));
            $em->persist($reservation->setRemise($remise));
            $em->flush();
            $session->getFlashBag()->add('success', "Votre Remise a été modifié avec succés ");
        }
        return $this->redirect($this->generateUrl('back_billetterie_reservation_consultation', array('id' => $reservation->getId())));
    }

    public function totalAction(BilletterieReservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId()) {
            $em->persist($reservation->setTotalAchat(abs($this->getRequest()->get("totalAchat")))->setTotalVente(abs($this->getRequest()->get("totalVente"))));
            $em->flush();
            $session->getFlashBag()->add('success', "Votre total a été modifié avec succés ");
        }
        return $this->redirect($this->generateUrl('back_billetterie_reservation_consultation', array('id' => $reservation->getId())));
    }

    public function annulerAction(BilletterieReservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        if($user->getId() == $reservation->getResponsable()->getId()){
            foreach($reservation->getReglements() as $reglement){
                $piece = $reglement->getPiece();
                $em->persist($piece->setMontant($piece->getMontant() + $reglement->getMontant())->setRegle(FALSE)->setDateReglement(NULL));
                $em->remove($reglement);
            }
            $em->persist($reservation->setValidated(NULL)->setEtat(9)->setCommentaire($request->get('commentaire')));
            $em->flush();
            $this->container->get('mailerservice')->annulation($reservation,'B');
            $session->getFlashBag()->add('success',"Réservation a été annullée avec succès ");
        }
        return $this->redirect($this->generateUrl("back_billetterie_reservation_consultation",array('id' => $reservation->getId())));
    }

    public function validerAction(BilletterieReservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array('client' => $reservation->getClient(),'regle' => FALSE));
        if($user->getId() != $reservation->getResponsable()->getId() || $reservation->getEtat() == 2)
            return $this->redirect($this->generateUrl("back_billetterie_reservation_consultation",array('id' => $reservation->getId())));
        $form = $this->createFormBuilder()
            ->add("piece",new PieceType());
        foreach($pieces as $piece)
            $form->add('piece' . $piece->getId(),'checkbox',array('label' => $piece->getNumero(),'required' => FALSE));
        $form = $form->getForm();
        if($request->isMethod("POST")){
            $form->submit($request);
            $data = $form->getData();
            foreach($pieces as $piece){
                if($data['piece' . $piece->getId()] && $reservation->getMontantRestant() > 0){
                    $reglement = new Reglement();
                    if($piece->getMontant() <= $reservation->getMontantRestant()){
                        $reglement->setMontant($piece->getMontant());
                        $em->persist($piece->setRegle(TRUE)->setDateReglement(new \DateTime())->setMontant(0));
                    } else{
                        $reglement->setMontant($reservation->getMontantRestant());
                        $em->persist($piece->setMontant($piece->getMontant() - $reservation->getMontantRestant()));
                    }
                    $reglement->setPiece($piece);
                    $reglement->setReservationsBilletterie($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                }
            }
            if($reservation->getMontantRestant() > 0 &&  !is_null($data['piece']->getModeReglement()) && !is_null($data['piece']->getMontantOrigine())) {
                if($data['piece']->getMontantOrigine() > 0){
                    $reglement = new Reglement();
                    $piece = $data['piece'];
                    $piece->setClient($reservation->getClient())
                        ->setDateCreation(new \DateTime());
                    if($piece->getMontantOrigine() <= $reservation->getMontantRestant()){
                        $reglement->setMontant($piece->getMontantOrigine());
                        $em->persist($piece->setRegle(TRUE)->setDateReglement(new \DateTime())->setMontant(0));
                    } else{
                        $reglement->setMontant($reservation->getMontantRestant());
                        $em->persist($piece->setRegle(FALSE)->setMontant($piece->getMontantOrigine() - $reservation->getMontantRestant()));
                    }
                    $reglement->setPiece($piece);
                    $reglement->setReservationsBilletterie($reservation);
                    $reglement->setDateCreation(new \DateTime());
                    $em->persist($reglement);
                    $reservation->addReglement($reglement);
                    $session->getFlashBag()->add('success',"Votre piéce a été ajoutée avec succès");
                } else
                    $session->getFlashBag()->add('danger',"Le montant de la piéce doit étre suppérieure à 0");
            }
            if($reservation->getMontantRestant() == 0){
                $em->persist($reservation->setEtat(2)->setValidated(new \DateTime()));
                $em->flush();
                $session->getFlashBag()->add('success'," Votre Réservation a été validée avec succès ");
                $this->container->get('mailerservice')->validation($reservation,'B');
                return $this->redirect($this->generateUrl("back_billetterie_reservation_consultation",array('id' => $reservation->getId())));
            } else
                $session->getFlashBag()->add('info'," Votre Réservation n'a pas été encore validée, reste encore <strong>" . $reservation->getMontantRestant() . " DT </strong> a payé");
            $em->flush();
            return $this->redirect($this->generateUrl("back_billetterie_reservation_validation",array('id' => $reservation->getId())));
        }
        return $this->render('BackBilletterieMaritimeBundle:billetterie:validation.html.twig',array(
            'reservation' => $reservation,
            'form'        => $form->createView(),
            'pieces'      => $pieces,
        ));
    }
}
