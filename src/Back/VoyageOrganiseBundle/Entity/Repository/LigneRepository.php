<?php

namespace Back\VoyageOrganiseBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class LigneRepository extends EntityRepository
{

    public function findCircuitByVoyage($id)
    {
        $query = $this->createQueryBuilder('p');
	$query->join('p.periodeC', "pe");
        $query->Where('pe.voyage=:id')->setParameter('id', $id);
        return $query->getQuery()->getResult();
    }
    public function findFraisByVoyage($id)
    {
        $query = $this->createQueryBuilder('p');
	$query->join('p.periodeF', "pe");
        $query->Where('pe.voyage=:id')->setParameter('id', $id);
        return $query->getQuery()->getResult();
    }

}
