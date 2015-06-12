<?php

namespace Back\AdministrationBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EmailRepository extends EntityRepository
{

    public function findByProduit($produit)
    {
        $query=$this->createQueryBuilder('e')
                ->select('e')
                ->leftJoin('e.produits', 'p')
                ->addSelect('p');

        $query=$query->add('where', $query->expr()->in('p', ':p'))
                ->setParameter('p', $produit)
                ->getQuery()
                ->getResult();

        return $query;
    }

}
