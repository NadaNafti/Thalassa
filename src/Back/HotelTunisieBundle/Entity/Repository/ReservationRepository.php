<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{

    public function filtreBackOffice($etat, $amicale, $sort, $direction)
    {
        $query = $this->createQueryBuilder('r');
        $query->join('r.hotel','h');
        $query->join('r.client','c');
        $query->where($query->expr()->isNotNull('r.id'));
        if ($etat != 'all')
            $query->andWhere('r.etat=:etat')->setParameter('etat', $etat);
        if ($amicale != 'all')
            $query->andWhere('c.amicale=:amicale')->setParameter('amicale', $amicale);
        $query->orderBy($sort, $direction);
        return $query->getQuery()->getResult();
    }

}
