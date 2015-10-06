<?php

namespace Back\HotelTunisieBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Doctrine\ORM\EntityManager;
use Back\UserBundle\Entity\Client;
use Back\HotelTunisieBundle\Entity\Hotel;

class Saisons
{

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getSaisonByClient(Hotel $hotel, Client $client, $date, $nbrChambre = 0)
    {

        $saison = $hotel->getSaisonByClient($date, $client);
        if (is_null($client) || is_null($client->getAmicale()) || $saison->getType() != 3) {
            $saisonContingent = $this->getSaisonContingent( $hotel, $date,$nbrChambre);
            if (!is_null(($saisonContingent)))
                return $saisonContingent;
        }
        return $saison;
    }

    public function getSaisonContingent(Hotel $hotel, $date,$nbrChambre)
    {
        $saisonContingent = $hotel->getSaisonPromotionByDate($date, true);
        if ($this->hasChambreContingent($saisonContingent, $date, $nbrChambre))
            return $saisonContingent;
        return null;
    }

    public function hasChambreContingent($saison, $date, $nbrChambre)
    {
        if (is_null($saison))
            return false;
        $query = $this->em->getRepository('BackHotelTunisieBundle:ReservationChambre')->getCountChambreContingent($saison, $date);
        if ($query + $nbrChambre <= $saison->getTotalContingent() && $saison->getType() == 4)
            return true;
        else
            return false;

    }

    public function getValideHotel($hotels)
    {
        $newList = array();
        foreach ($hotels as $hotel) {
            if (!is_null($hotel->getSaisonBase()) && $hotel->getSaisonBase()->isValid() && $hotel->getEtat() == 1)
                $newList[] = $hotel;
        }
        return $newList;
    }

}
