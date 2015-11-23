<?php

namespace Back\ResaBookingBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{
    public function filtreBackOffice($etat)
    {
        $query = $this->createQueryBuilder('r');
        $query->where($query->expr()->isNotNull('r.id'));
        if ($etat != 'all')
            $query->andWhere('r.etat=:etat')->setParameter('etat', $etat);
        $query->orderBy('r.id', 'desc');
        return $query->getQuery()->getResult();
    }

}
