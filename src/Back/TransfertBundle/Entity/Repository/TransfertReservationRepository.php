<?php

namespace Back\TransfertBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TransfertReservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TransfertReservationRepository extends EntityRepository
{
    public function filtre($etat,$sort = 'r.id',$direction = 'desc')
    {
        $query = $this->createQueryBuilder('r');
        $query->join('r.client',"c");
        $query->where($query->expr()->isNotNull('r.id'));
        if($etat != 'all')
            $query->andWhere('r.etat=:etat')->setParameter('etat',$etat);
        $query->orderBy($sort,$direction);
        return $query->getQuery()->getResult();
    }
}
