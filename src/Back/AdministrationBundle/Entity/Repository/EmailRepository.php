<?php

namespace Back\AdministrationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class EmailRepository extends EntityRepository
{

    public function findByProduit($code, $option=null)
    {
        $query = $this->createQueryBuilder('e')
            ->join('e.produits', 'p')
            ->where('p.code=UPPER(:code)')->setParameter('code', $code);
        if (!is_null($option))
            $query->andWhere('e.'.$option.'=:bool')->setParameter('bool', true);
        return $query->getQuery()->getResult();
    }

}
