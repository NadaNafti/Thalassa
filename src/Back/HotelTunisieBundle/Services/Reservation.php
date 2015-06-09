<?php

namespace Back\HotelTunisieBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;

class Reservation
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
                $tabChambre['supplements'][]=$this->container->get('lignes')->ligneAutresSupplement($saisonFist, $arr, $idSupp, $results['dateDebut'],$results['dateFin']);
            foreach($chambre['reduc'] as $idReduc)
                $tabChambre['reductions'][]=$this->container->get('lignes')->ligneAutresReduction($saisonFist, $arr, $idReduc, $results['dateDebut'],$results['dateFin']);
            $results['chambres'][]=$tabChambre;
        }
        return $results;
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
