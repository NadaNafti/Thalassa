<?php

namespace Back\HotelTunisieBundle\Services ;

use Symfony\Component\Security\Core\SecurityContextInterface ;
use Doctrine\ORM\EntityManager ;
use Back\UserBundle\Entity\Client ;
use Back\HotelTunisieBundle\Entity\Hotel ;

class Saisons
{

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager ;
    }

    public function getSaisonByClient(Hotel $hotel , Client $client , $date)
    {
        if (is_null($client->getAmicale()))
            return $hotel->getSaisonPromotionByDate($date) ;
        $convention = $client->getAmicale()->getConventionByDateHotel($date , $hotel->getId()) ;
        if (is_null($convention))
            return $hotel->getSaisonPromotionByDate($date) ;
        if ($convention->getType() == 1)
            return $hotel->getSaisonByDate($date) ;

        return $hotel->getSaisonPromotionByDate($date) ;
    }

}
