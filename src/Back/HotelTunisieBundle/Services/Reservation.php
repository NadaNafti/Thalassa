<?php

namespace Back\HotelTunisieBundle\Services ;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
class Reservation
{
    public function __construct(EntityManager $em , Session $session ,Container $container)
    {
        $this->em=$em;
        $this->session=$session;
        $this->container=$container;
    }

    public function getCalendrier($reservation,$hotel,$client)
    {
        $dates = $this->container->get('library')->getDatesBetween($reservation['dateDebut'] , $reservation['dateFin']) ;
        $lastSaison = $hotel->getSaisonPromotionByDate($reservation['dateDebut']) ;
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
        return $calendrier;
    }

}
