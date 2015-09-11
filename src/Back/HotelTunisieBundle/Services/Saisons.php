<?php

namespace Back\HotelTunisieBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Doctrine\ORM\EntityManager;
use Back\UserBundle\Entity\Client;
use Back\HotelTunisieBundle\Entity\Hotel;

class Saisons
{

    public function __construct( EntityManager $entityManager )
    {
        $this->em = $entityManager;
    }

    public function getSaisonByClient( Hotel $hotel,Client $client,$date )
    {
        if( is_null( $client->getAmicale() ) || is_null( $client ) )
            return $hotel->getSaisonPromotionByDate( $date );
        return $hotel->getSaisonByClient( $date,$client );
    }

    public function getValideHotel( $hotels )
    {
        $newList = array();
        foreach( $hotels as $hotel ){
            if( !is_null( $hotel->getSaisonBase() ) && $hotel->getSaisonBase()->isValid() && $hotel->getEtat() == 1 )
                $newList[] = $hotel;
        }
        return $newList;
    }

}
