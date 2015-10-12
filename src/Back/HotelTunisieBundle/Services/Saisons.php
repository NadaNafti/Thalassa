<?php

namespace Back\HotelTunisieBundle\Services;

use Proxies\__CG__\Back\HotelTunisieBundle\Entity\Saison;
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

    public function getSaisonByClient(Hotel $hotel, Client $client, $date)
    {

        $saison = $hotel->getSaisonByClient($date, $client);
        if (is_null($client) || is_null($client->getAmicale()) || $saison->getType() != 3)
            $saison = $hotel->getSaisonPromotionByDate($date, true);
        return $saison;
    }

    public function getSaisonContingent(Hotel $hotel, $date)
    {
        $saison=$hotel->getSaisonPromotionByDate($date, true);
        if($saison->getType()==4)
            return $saison;
        else
            return null;
    }

    public function hasChambreContingent($saison, $date, $nbrChambre)
    {
        if (is_null($saison))
            return false;
        $query = $this->em->getRepository('BackHotelTunisieBundle:ReservationChambre')->getCountChambreContingent($saison, $date);
        if ($query + $nbrChambre <= $saison->getNombreContingentDispo($date) && $saison->getType() == 4 && $saison->getNombreContingentDispo($date)>0)
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
