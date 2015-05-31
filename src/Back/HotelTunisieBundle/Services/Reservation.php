<?php

namespace Back\HotelTunisieBundle\Services ;

use Doctrine\ORM\EntityManager ;
use Symfony\Component\HttpFoundation\Session\Session ;
use Symfony\Component\DependencyInjection\Container ;

class Reservation
{

    public function __construct(EntityManager $em , Session $session , Container $container)
    {
        $this->em = $em ;
        $this->session = $session ;
        $this->container = $container ;
    }

    public function reservation($reservation)
    {
        $calendrier = $this->getCalendrier($reservation) ;
        $results = array () ;
        $results['hotel'] = $reservation['hotel'] ;
        $results['client'] = $reservation['client'] ;
        $results['dateDebut'] = $reservation['dateDebut'] ;
        $results['dateFin'] = $reservation['dateFin'] ;
        $results['nuitees'] = $reservation['nuitees'] ;
        $results['chambres'] = array () ;
        foreach ($reservation['chambres'] as $chambre)
        {
            $tabChambre = array () ;
            $tabChambre['details'] = $chambre ;
            $tabChambre['adultes'] = array () ;
            $tabChambre['enfants'] = array () ;
            $tabOccupants = explode(',' , $chambre['occupants']) ;
            for ($i = 1 ; $i <= $tabOccupants[0] ; $i++)
            {
                $tabAdult = array () ;
                $tabAdult['ordre'] = $i ;
                $tabAdult['jours'] = array () ;
                foreach ($calendrier as $periode)
                {
                    $saison = $this->em->getRepository('BackHotelTunisieBundle:Saison')->find($periode['saison']->getId()) ;
                    $dates = $this->container->get('library')->getDatesBetween($periode['dateDebut'] , $periode['dateFin']) ;
                    foreach ($dates as $date)
                    {
                        $tabjour = array () ;
                        $tabjour['jour'] = $date ;
                        $tabjour['saison'] = array ('id' => $saison->getId() , 'name' => $saison->getLibelle()) ;
                        $tabjour['lignes'] = array () ;
                        $tabLigne = array () ;

                        $tabLigne[] = $this->container->get('lignes')->lignePrixBase($saison) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneArrangement($saison , $chambre['arrangement']) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppSingle($saison , $chambre['chambre']) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppReduc3Lit($saison ,$i) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppReduc4Lit($saison ,$i) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppAutreChambre($saison ,$chambre['chambre']) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppWeekend($saison ,$chambre['chambre'],$date) ;
                        foreach ($chambre['vue'] as $vue)
                            $tabLigne[] = $this->container->get('lignes')->ligneSuppVue($saison ,$vue) ;

                        $tabjour['lignes'][] = $tabLigne ;
                        $tabAdult['jours'][] = $tabjour ;
                    }
                }
                $tabChambre['adultes'][] = $tabAdult ;
            }
            for ($i = 1 ; $i <= count($tabOccupants) - 1 ; $i++)
            {
                $tabEnfant = array () ;
                $tabEnfant['ordre'] = $i ;
                $tabEnfant['age'] = $tabOccupants[$i] ;
                $tabEnfant['jours'] = array () ;
                foreach ($calendrier as $periode)
                {
                    $saison = $this->em->getRepository('BackHotelTunisieBundle:Saison')->find($periode['saison']->getId()) ;
                    $dates = $this->container->get('library')->getDatesBetween($periode['dateDebut'] , $periode['dateFin']) ;
                    foreach ($dates as $date)
                    {
                        $tabjour = array () ;
                        $tabjour['jour'] = $date ;
                        $tabjour['saison'] = array ('id' => $saison->getId() , 'name' => $saison->getLibelle()) ;
                        $tabjour['lignes'] = array () ;
                        $tabLigne = array () ;

                        $tabLigne[] = $this->container->get('lignes')->lignePrixBase($saison) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneArrangement($saison , $chambre['arrangement']) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppSingleEnfant($saison , $chambre['chambre']) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppAutreChambre($saison ,$chambre['chambre']) ;
                        $tabLigne[] = $this->container->get('lignes')->ligneSuppWeekend($saison ,$chambre['chambre'],$date) ;

                        foreach ($chambre['vue'] as $vue)
                            $tabLigne[] = $this->container->get('lignes')->ligneSuppVue($saison ,$vue) ;

                        $tabjour['lignes'][] = $tabLigne ;
                        $tabEnfant['jours'][] = $tabjour ;
                    }
                }
                $tabChambre['enfants'][] = $tabEnfant ;
            }
            $results['chambres'][] = $tabChambre ;
        }

        dump($results) ;
        return $results ;
    }

    public function getCalendrier($reservation)
    {
        $hotel = $this->em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']) ;
        $client = $this->em->getRepository("BackUserBundle:Client")->find($reservation['client']) ;
        $dates = $this->container->get('library')->getDatesBetween($reservation['dateDebut'] , $reservation['dateFin']) ;
        $lastSaison = $this->container->get('saisons')->getSaisonByClient($hotel , $client , $reservation['dateDebut']) ;
        $dateDebut = $reservation['dateDebut'] ;
        $dateFin = '' ;
        $calendrier = array () ;
        foreach ($dates as $date)
        {
            $saison = $this->container->get("saisons")->getSaisonByClient($hotel , $client , $date) ;
            if ($saison->getId() != $lastSaison->getId() || $date == $reservation['dateFin'])
            {
                if ($date == $reservation['dateFin'])
                    $dateFin = $date ;
                $calendrier[] = array ('dateDebut' => $dateDebut , 'dateFin' => $dateFin , 'saison' => $lastSaison) ;
                $lastSaison = $saison ;
                $dateDebut = $date ;
            }
            $dateFin = $date ;
        }
        return $calendrier ;
    }

}
