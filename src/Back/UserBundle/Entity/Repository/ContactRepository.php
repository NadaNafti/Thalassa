<?php

namespace Back\UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ContactRepository extends EntityRepository {

    public function listeClient() {
        $query = $this->createQueryBuilder('ct');
        $query->where($query->expr()->isNotNull('ct.client'));
        return $query->getQuery()->getResult();
    }
    
    public function listeFournisseur() {
        $query = $this->createQueryBuilder('ct');
        $query->where($query->expr()->isNotNull('ct.fournisseur'));
        return $query->getQuery()->getResult();
    }

}
