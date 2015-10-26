<?php

namespace Back\ResaBookingBundle\Controller;

use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Entity\Reglement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\HotelTunisieBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Response;

class PaiementController extends Controller
{
    public function notificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $confPaiement = $em->find('BackHotelTunisieBundle:ConfigurationPayement', 1);
        $ref = $request->get('Reference');
        $act = $request->get('Action');
        $par = $request->get('Param');
        $refArray=explode('-',$ref);
        switch($refArray[0])
        {
            case "SHT": $reservation=$em->find('BackHotelTunisieBundle:Reservation',$refArray[1]);
            case "RB": $reservation =$em->find('BackResaBookingBundle:Reservation',$refArray[1]);
        }
        switch($act) {
            case "DETAIL":
                return new Response( "Reference=" . $ref . "&Action=" . $act . "&Reponse=" . $reservation->getMontantPayementElectronique());
            case "ERREUR":
                $em->persist($reservation->setStatusPayement('ERREUR'));
                $em->flush();
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
            case "ACCORD":
                $piece = new Piece();//Add new piece
                $piece->setClient($reservation->getClient())
                    ->setDateCreation(new \DateTime())
                    ->setDateReglement(new \DateTime())
                    ->setMontantOrigine($reservation->getMontantPayementElectronique())
                    ->setMontant(0)
                    ->setParam($par)
                    ->setModeReglement("PE")
                    ->setRegle(true);
                $em->persist($piece);
                $reglement = new Reglement();//add new reglement
                $reglement->setPiece($piece)
                    ->setMontant($reservation->getMontantPayementElectronique())
                    ->setReservationByCode($reservation,$refArray[0])
                    ->setDateCreation(new \DateTime());
                $em->persist($reglement);
                if($reservation->getTypePayement()==2)//validation reservation
                    $reservation->setEtat(2)->setValidated(new \DateTime());
                switch($refArray[0])
                {
                    case "SHT": $reservation->setCode($this->container->get('reservation')->getCode());
                    case "RB": $reservation->setReponseBooking($this->container->get('resabookingservice')->createbooking($reservation));
                }
                $em->persist($reservation);
                $em->flush();
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
            case "REFUS":
                $em->persist($reservation->setStatusPayement('REFUS'));
                $em->flush();
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
            case "ANNULATION":
                $em->persist($reservation->setStatusPayement('ANNULATION'));
                $em->flush();
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
        }
    }
}