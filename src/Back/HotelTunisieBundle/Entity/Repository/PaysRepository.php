<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PaysRepository extends EntityRepository
{
    public function paysVoyageOrganise()
    {
        $query = $this->createQueryBuilder('p');
        $query->join('p.voyages', 'v');
        return $query->getQuery()->getResult();
    }
}
