<?php

namespace Back\HotelTunisieBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\HotelTunisieBundle\Entity\Reservation;
use Back\HotelTunisieBundle\Entity\ReservationPersonne;
use Back\HotelTunisieBundle\Entity\ReservationLigne;
use Back\HotelTunisieBundle\Entity\ReservationJour;
use Back\HotelTunisieBundle\Entity\ReservationChambre;
use Back\HotelTunisieBundle\Entity\ReservationRepository;

class ReservationService
{

    public function __construct(EntityManager $em, Session $session, Container $container)
    {
        $this->em=$em;
        $this->session=$session;
        $this->container=$container;
    }

    public function reservation($reservation)
    {
        $calendrier=$this->getCalendrier($reservation);
        $results=array();
        $results['hotel']=$reservation['hotel'];
        $results['client']=$reservation['client'];
        $results['dateDebut']=$reservation['dateDebut'];
        $results['dateFin']=$reservation['dateFin'];
        $results['nuitees']=$reservation['nuitees'];
        $results['surDemande']=FALSE;
        $results['chambres']=array();
        $saisonFist=$this->em->getRepository('BackHotelTunisieBundle:Saison')->find($reservation['saison']);
        foreach($reservation['chambres'] as $chambre)
        {
            $tabChambre=array();
            $tabChambre['details']=$chambre;
            $tabChambre['adultes']=array();
            $tabChambre['enfants']=array();
            $tabChambre['supplements']=array();
            $tabChambre['reductions']=array();
            $arr=$chambre['arrangement'];
            $tabOccupants=explode(',', $chambre['occupants']);
            $nbrAdulte=$tabOccupants[0];
            $nbrEnfant=count($tabOccupants) - 1;
            for($i=1; $i <= $tabOccupants[0]; $i++)
            {
                $tabAdult=array();
                $tabAdult['ordre']=$i;
                $tabAdult['jours']=array();
                $ordre=0;
                foreach($calendrier as $periode)
                {
                    $ordre++;
                    $saison=$this->em->getRepository('BackHotelTunisieBundle:Saison')->find($periode['saison']->getId());
                    if(is_null($saison->getType()))
                        $results['surDemande']=TRUE;
                    $dates=$this->container->get('library')->getDatesBetween($periode['dateDebut'], $periode['dateFin']);
                    $date=$periode['dateDebut'];
                    $tabjour=array();
                    $tabjour['jour']=$date;
                    $tabjour['saison']=array( 'id'=>$saison->getId(), 'name'=>$saison->getLibelle() );
                    $tabjour['lignes']=array();
                    $tabLigne=array();

                    $tabLigne[]=$this->container->get('lignes')->lignePrixBase($saison);
                    $tabLigne[]=$this->container->get('lignes')->ligneArrangement($saison, $arr);
                    $tabLigne[]=$this->container->get('lignes')->ligneSuppSingle($saison, $arr, $chambre['chambre'], $nbrAdulte, $nbrEnfant, 'adulte');
                    $tabLigne[]=$this->container->get('lignes')->ligneSuppReduc3Lit($saison, $arr, $i);
                    $tabLigne[]=$this->container->get('lignes')->ligneSuppReduc4Lit($saison, $arr, $i);
                    $tabLigne[]=$this->container->get('lignes')->ligneSuppAutreChambre($saison, $arr, $chambre['chambre']);
                    $tabLigne[]=$this->container->get('lignes')->ligneSuppWeekend($saison, $arr, $chambre['chambre'], $date, $results['nuitees']);
                    foreach($chambre['vue'] as $vue)
                        $tabLigne[]=$this->container->get('lignes')->ligneSuppVue($saison, $arr, $vue);
                    foreach($chambre['supp'] as $idSupp)
                        $tabLigne[]=$this->container->get('lignes')->ligneAutresSupplementParNuitees($saisonFist, $arr, 'adulte', $idSupp, \DateTime::createFromFormat('Y-m-d', $date), $ordre);
                    foreach($chambre['reduc'] as $idReduc)
                        $tabLigne[]=$this->container->get('lignes')->ligneAutresReductionParNuitees($saisonFist, $arr, 'adulte', $idReduc, \DateTime::createFromFormat('Y-m-d', $date), $ordre);
                    $tabjour['lignes']=$tabLigne;
                    $tabAdult['jours'][]=$tabjour;
                }
                $tabChambre['adultes'][]=$tabAdult;
            }
            for($i=1; $i <= count($tabOccupants) - 1; $i++)
            {
                $tabEnfant=array();
                $tabEnfant['ordre']=$i;
                $tabEnfant['age']=$tabOccupants[$i];
                $tabEnfant['jours']=array();
                $ordre=0;
                foreach($calendrier as $periode)
                {
                    $ordre++;
                    $saison=$this->em->getRepository('BackHotelTunisieBundle:Saison')->find($periode['saison']->getId());
                    if(is_null($saison->getType()))
                        $results['surDemande']=TRUE;
                    $date=$periode['dateDebut'];
                    $dates=$this->container->get('library')->getDatesBetween($periode['dateDebut'], $periode['dateFin']);

                    $tabjour=array();
                    $tabjour['jour']=$date;
                    $tabjour['saison']=array( 'id'=>$saison->getId(), 'name'=>$saison->getLibelle() );
                    $tabjour['lignes']=array();
                    $tabLigne=array();

                    $tabLigne[]=$this->container->get('lignes')->lignePrixBase($saison);
                    $tabLigne[]=$this->container->get('lignes')->ligneArrangement($saison, $arr);
                    $tabLigne[]=$this->container->get('lignes')->ligneSuppSingle($saison, $arr, $chambre['chambre'], $nbrAdulte, $nbrEnfant, 'enfant');
                    $tabLigne[]=$this->container->get('lignes')->ligneSuppAutreChambre($saison, $arr, $chambre['chambre']);
                    $tabLigne[]=$this->container->get('lignes')->ligneReduc1Enf1Adu($saison, $arr, $i, $nbrAdulte, $tabEnfant['age']);
                    $tabLigne[]=$this->container->get('lignes')->ligneReduc1Enf2Adu($saison, $arr, $i, $nbrAdulte, $tabEnfant['age']);
                    $tabLigne[]=$this->container->get('lignes')->ligneReduc1EnfSeparer($saison, $arr, $i, $nbrAdulte, $tabEnfant['age']);
                    $tabLigne[]=$this->container->get('lignes')->ligneReduc2Enf1Adu($saison, $arr, $i, $nbrAdulte, $tabEnfant['age']);
                    $tabLigne[]=$this->container->get('lignes')->ligneReduc2Enf2Adu($saison, $arr, $i, $nbrAdulte, $tabEnfant['age']);
                    $tabLigne[]=$this->container->get('lignes')->ligneReduc2EnfSeparer($saison, $arr, $i, $nbrAdulte, $tabEnfant['age']);

                    $tabLigne[]=$this->container->get('lignes')->ligneSuppWeekend($saison, $arr, $chambre['chambre'], $date, $results['nuitees']);
                    foreach($chambre['vue'] as $vue)
                        $tabLigne[]=$this->container->get('lignes')->ligneSuppVue($saison, $arr, $vue);
                    foreach($chambre['supp'] as $idSupp)
                        $tabLigne[]=$this->container->get('lignes')->ligneAutresSupplementParNuitees($saisonFist, $arr, 'enfant', $idSupp, \DateTime::createFromFormat('Y-m-d', $date), $ordre);
                    foreach($chambre['reduc'] as $idReduc)
                        $tabLigne[]=$this->container->get('lignes')->ligneAutresReductionParNuitees($saisonFist, $arr, 'enfant', $idReduc, \DateTime::createFromFormat('Y-m-d', $date), $ordre);
                    $tabjour['lignes']=$tabLigne;
                    $tabEnfant['jours'][]=$tabjour;
                }
                $tabChambre['enfants'][]=$tabEnfant;
            }
            foreach($chambre['supp'] as $idSupp)
                $tabChambre['supplements'][]=$this->container->get('lignes')->ligneAutresSupplement($saisonFist, $arr, $idSupp, $results['dateDebut'], $results['dateFin']);
            foreach($chambre['reduc'] as $idReduc)
                $tabChambre['reductions'][]=$this->container->get('lignes')->ligneAutresReduction($saisonFist, $arr, $idReduc, $results['dateDebut'], $results['dateFin']);
            $results['chambres'][]=$tabChambre;
        }
        return $results;
    }

    public function saveReservation($data, $result, $source)
    {
        $hotel=$this->em->getRepository('BackHotelTunisieBundle:Hotel')->find($result['hotel']);
        $client=$data['client'];
        $this->em->persist($client);
        $reservation=new Reservation();
        $reservation->setClient($client)
                ->setHotel($hotel)
                ->setDateDebut(\DateTime::createFromFormat('Y-m-d', $result['dateDebut']))
                ->setDateFin(\DateTime::createFromFormat('Y-m-d', $result['dateFin']))
                ->setNuitees($result['nuitees'])
                ->setSurDemande($result['surDemande'])
                ->setEtat(1);
        if($source == 'backoffice')
        {
            $user=$this->container->get('security.context')->getToken()->getUser();
            $reservation->setResponsable($user)->setFrontOffice(0);
        }
        else
            $reservation->setFrontOffice(1);
        $this->em->persist($reservation);
        $chambreOrdre=0;
        foreach($result['chambres'] as $chambre)
        {
            $noms=array();
            $chambreOrdre++;
            $reservationChambre=new ReservationChambre();
            $reservationChambre->setReservation($reservation)
                    ->setChambre($this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($chambre['details']['chambre']))
                    ->setArrangement($this->em->getRepository('BackHotelTunisieBundle:Arrangement')->find($chambre['details']['arrangement']))
                    ->setOccupants(explode(',', $chambre['details']['occupants']))
                    ->setReductions($chambre['details']['reduc'])
                    ->setSupplements($chambre['details']['supp'])
                    ->setVues($chambre['details']['vue'])
                    ->setNoms(array());
            $this->em->persist($reservationChambre);
            foreach($chambre['adultes'] as $adulte)
            {
                $ReservationPersonne=new ReservationPersonne();
                $ReservationPersonne->setReservationChambreAdulte($reservationChambre)
                        ->setOrdre($adulte['ordre'])
                        ->setNom($data['chambre'.$chambreOrdre.'adulte'.$adulte['ordre']]);
                $this->em->persist($ReservationPersonne);
                $noms[]=$data['chambre'.$chambreOrdre.'adulte'.$adulte['ordre']];
                foreach($adulte['jours'] as $jour)
                {
                    $reservationJour=new ReservationJour();
                    $reservationJour->setPersonne($ReservationPersonne)
                            ->setJour(\DateTime::createFromFormat('Y-m-d', $jour['jour']))
                            ->setSaison($this->em->getRepository('BackHotelTunisieBundle:Saison')->find($jour['saison']['id']));
                    $this->em->persist($reservationJour);
                    foreach($jour['lignes'] as $ligne)
                    {
                        if(!is_null($ligne))
                        {
                            $reservationLigne=new ReservationLigne();
                            $reservationLigne->setJour($reservationJour)
                                    ->setCode($ligne['code'])
                                    ->setLibelle($ligne['name'])
                                    ->setAchat($ligne['achat'])
                                    ->setVente($ligne['vente']);
                            $this->em->persist($reservationLigne);
                        }
                    }
                }
            }
            foreach($chambre['enfants'] as $enfant)
            {
                $ReservationPersonne=new ReservationPersonne();
                $ReservationPersonne->setReservationChambreEnfant($reservationChambre)
                        ->setOrdre($enfant['ordre'])
                        ->setNom($data['chambre'.$chambreOrdre.'Enfant'.$enfant['ordre']])
                        ->setAge($enfant['age']);
                $this->em->persist($ReservationPersonne);
                $noms[]=$data['chambre'.$chambreOrdre.'Enfant'.$enfant['ordre']];
                foreach($enfant['jours'] as $jour)
                {
                    $reservationJour=new ReservationJour();
                    $reservationJour->setPersonne($ReservationPersonne)
                            ->setJour(\DateTime::createFromFormat('Y-m-d', $jour['jour']))
                            ->setSaison($this->em->getRepository('BackHotelTunisieBundle:Saison')->find($jour['saison']['id']));
                    $this->em->persist($reservationJour);
                    foreach($jour['lignes'] as $ligne)
                    {
                        if(!is_null($ligne))
                        {
                            $reservationLigne=new ReservationLigne();
                            $reservationLigne->setJour($reservationJour)
                                    ->setCode($ligne['code'])
                                    ->setLibelle($ligne['name'])
                                    ->setAchat($ligne['achat'])
                                    ->setVente($ligne['vente']);
                            $this->em->persist($reservationLigne);
                        }
                    }
                }
            }
            $this->em->persist($reservationChambre->setNoms($noms));
            foreach($chambre['supplements'] as $suppLigne)
            {
                $reservationLigne=new ReservationLigne();
                if(!is_null($suppLigne))
                {
                    $reservationLigne=new ReservationLigne();
                    $reservationLigne->setSupplement($reservationChambre)
                            ->setCode($suppLigne['code'])
                            ->setLibelle($suppLigne['name'])
                            ->setAchat($suppLigne['achat'])
                            ->setVente($suppLigne['vente']);
                    $this->em->persist($reservationLigne);
                }
            }
            foreach($chambre['reductions'] as $reducLigne)
            {
                $reservationLigne=new ReservationLigne();
                if(!is_null($reducLigne))
                {
                    $reservationLigne=new ReservationLigne();
                    $reservationLigne->setReduction($reservationChambre)
                            ->setCode($reducLigne['code'])
                            ->setLibelle($reducLigne['name'])
                            ->setAchat($reducLigne['achat'])
                            ->setVente($reducLigne['vente']);
                    $this->em->persist($reservationLigne);
                }
            }
        }
        $this->em->flush();
    }

    public function getCalendrier($reservation)
    {
        $hotel=$this->em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']);
        $client=$this->em->getRepository("BackUserBundle:Client")->find($reservation['client']);
        $dates=$this->container->get('library')->getDatesBetween($reservation['dateDebut'], $reservation['dateFin']);
        $calendrier=array();
        foreach($dates as $date)
        {
            $saison=$this->container->get("saisons")->getSaisonByClient($hotel, $client, $date);
            $calendrier[]=array( 'dateDebut'=>$date, 'dateFin'=>$date, 'saison'=>$saison );
        }
        return $calendrier;
    }

}