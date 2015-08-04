<?php

namespace Back\VoyageOrganiseBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PackRepository extends EntityRepository
{

    public function findByVoyage($id)
    {
        $query = $this->createQueryBuilder('p');
	$query->join('p.periode', "pe");
        $query->Where('pe.voyage=:id')->setParameter('id', $id);
        return $query->getQuery()->getResult();
    }

}
