<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\Reservation;
use Back\VoyageOrganiseBundle\Entity\ReservationLigne;
use Back\VoyageOrganiseBundle\Form\ReservationType;
use Back\VoyageOrganiseBundle\Form\ReservationLigneType;

class ReservationController extends Controller
{

    public function ajouterAction()
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$reservation = new Reservation ();
	$form = $this->createForm(new ReservationType(), $reservation);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    $reservation = $form->getData();
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
	    return $this->redirect($this->generateUrl('back_voyages_organises_reservation_ajouter'));
	}
	return $this->render('BackVoyageOrganiseBundle:reservation:ajout.html.twig', array(
		    'form' => $form->createView()
	));
    }

}
