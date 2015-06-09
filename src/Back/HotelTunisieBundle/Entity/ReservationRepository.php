<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{
    public function filtreBackOffice($etat,$amicale)
    {
        $query = $this->createQueryBuilder('r');
        $query->where($query->expr()->isNotNull('r.id'));
        if ($etat != 'all')
            $query->andWhere('r.etat=:etat')->setParameter('etat', $etat);
        $query->join('r.client', 'c');
        if ($amicale != 'all')
            $query->andWhere('c.amicale=:amicale')->setParameter('amicale', $amicale);
        $query->orderBy("r.id", 'desc');
        return $query->getQuery()->getResult();
    }

}
