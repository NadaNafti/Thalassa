<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PaysRepository extends EntityRepository
{
    public function paysVoyageOrganise()
    {
        $query = $this->createQueryBuilder('p');
        $query->join('p.voyages', 'v')
            ->orderBy('p.libelle','asc');
        return $query->getQuery()->getResult();
    }
}
