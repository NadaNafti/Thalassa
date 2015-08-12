<?php

namespace Back\VoyageOrganiseBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\VoyageOrganiseBundle\Entity\Pack;
use Back\VoyageOrganiseBundle\Entity\Reservation;
use Back\VoyageOrganiseBundle\Entity\ReservationChambre;
use Back\VoyageOrganiseBundle\Entity\ReservationLigne;
use Back\VoyageOrganiseBundle\Entity\ReservationPersonne;
use Back\UserBundle\Entity\Client;

class ReservationService
{

    protected $em;
    protected $session;
    protected $container;
    protected $mailer;
    protected $templating;

    public function __construct(EntityManager $em, Session $session, Container $container, \Swift_Mailer $mailer, $templating)
    {
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function saveReservation(Pack $pack, Client $client, $data, $source)
    {
        $periode = $pack->getPeriode();
        $supplements = array();
        $circuits = array();
        $frais = array();
        $chambres = array(
            array('single', 1, $pack->getSingleAchat(), $pack->getSingleVente()),
            array('double', 2, $pack->getDoubleAchat(), $pack->getDoubleVente()),
            array('triple', 3, $pack->getTripleAchat(), $pack->getTripleVente()),
            array('quadruple', 4, $pack->getQuadrupleAchat(), $pack->getQuadrupleVente())
        );
        $coordoonnes = array($client->getNomPrenom(), $client->getTel1(), $client->getTel2(), $client->getAdresse());
        $tarifCommercial = $this->em->getRepository('BackCommercialBundle:Tarif')->find(1);
        $reservation = new Reservation();
        $reservation->setClient($client)
                ->setCoordonnees($coordoonnes)
                ->setEtat(1)
                ->setPack($pack)
                ->setVoyage($periode->getVoyage());
        if ($tarifCommercial && $tarifCommercial->getTimbre())
            $reservation->setTimbre($tarifCommercial->getMontantTimbre());
        if($source=='frontoffice')
            $reservation->setFrontOffice (TRUE);
        $this->em->persist($reservation);
        $x = 0;
        foreach ($chambres as $ch)
        {
            for ($i = 1; $i <= $data['chambre' . $ch[0]]; $i++)
            {
                $reservationChambre = new ReservationChambre();
                $reservationChambre->setReservation($reservation)
                        ->setType($ch[1]);
                $this->em->persist($reservationChambre);
                for ($p = 1; $p <= $ch[1]; $p++)
                {
                    $x++;
                    $reservationPersonne = new ReservationPersonne();
                    $reservationPersonne->setChambre($reservationChambre)
                            ->setNomPrenom($data[$ch[0] . '_nom_' . $i . '_' . $p])
                            ->setPassport($data[$ch[0] . '_passport_' . $i . '_' . $p]);
                    if ($data[$ch[0] . '_age_' . $i . '_' . $p] != 'adulte')
                        $reservationPersonne->setAge($data[$ch[0] . '_age_' . $i . '_' . $p])->setEnfant(true);
                    else
                        $reservationPersonne->setAge(null)->setEnfant(false);
                    $this->em->persist($reservationPersonne);
                    $reservationLigne = new ReservationLigne();
                    $reservationLigne->setPersonne($reservationPersonne)
                            ->setLibelle('Logement chambre ' . $ch[0])
                            ->setCode('chambre_' . $ch[0])
                            ->setAchat($ch[2])
                            ->setVente($ch[3]);
                    $this->em->persist($reservationLigne);
                    foreach ($pack->getSupplements() as $supp)
                    {
                        if ($supp->getObligatoire() || isset($data['supplement' . $supp->getId()]))
                        {
                            if ($x == 1)
                                $supplements[] = $supp->getId();
                            $reservationLigne = new ReservationLigne();
                            $reservationLigne->setPersonne($reservationPersonne)
                                    ->setLibelle($supp->getLibelle())
                                    ->setCode('Supplement')
                                    ->setAchat($supp->getAdulteAchat())
                                    ->setVente($supp->getAdulteVente());
                            $this->em->persist($reservationLigne);
                        }
                    }
                    foreach ($periode->getCircuits() as $supp)
                    {
                        if ($supp->getObligatoire() || isset($data['circuit' . $supp->getId()]))
                        {
                            if ($x == 1)
                                $circuits[] = $supp->getId();
                            $reservationLigne = new ReservationLigne();
                            $reservationLigne->setPersonne($reservationPersonne);
                            if (!$reservationPersonne->getEnfant())
                                $reservationLigne->setAchat($supp->getAdulteAchat())->setVente($supp->getAdulteVente())->setCode('CircuitAdl')->setLibelle($supp->getLibelle() . ' adulte');
                            else
                                $reservationLigne->setAchat($supp->getEnfantAchat())->setVente($supp->getEnfantVente())->setCode('CircuitEnf')->setLibelle($supp->getLibelle() . ' enfant');
                            $this->em->persist($reservationLigne);
                        }
                    }
                    foreach ($periode->getFrais() as $supp)
                    {
                        if ($supp->getObligatoire() || isset($data['frai' . $supp->getId()]))
                        {
                            if ($x == 1)
                                $frais[] = $supp->getId();
                            $reservationLigne = new ReservationLigne();
                            $reservationLigne->setPersonne($reservationPersonne);
                            if (!$reservationPersonne->getEnfant())
                                $reservationLigne->setAchat($supp->getAdulteAchat())->setVente($supp->getAdulteVente())->setCode('FraisDiversAdl')->setLibelle($supp->getLibelle() . ' adulte');
                            else
                                $reservationLigne->setAchat($supp->getEnfantAchat())->setVente($supp->getEnfantVente())->setCode('FraisDiversEnf')->setLibelle($supp->getLibelle() . ' enfant');
                            $this->em->persist($reservationLigne);
                        }
                    }
                }
            }
        }
        $this->em->persist($reservation->setSupplements($supplements)->setCircuits($circuits)->setFrais($frais));
        $this->em->flush();
        return $reservation->getId();
    }

}
