<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class RegionRepository extends EntityRepository
{
    public function getFromString($ch)
    {
        $query = $this->createQueryBuilder('r');
        $query->where($query->expr()->isNotNull('r.id'));
        if($ch!='all')
        {
            $array=explode(',',$ch);
            $query->andWhere('r.id IN (:array)')->setParameter('array', $array);
        }
        $query->orderBy("r.libelle", 'asc');
        return $query->getQuery()->getResult();
    }
}
