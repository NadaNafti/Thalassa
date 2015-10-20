<?php

namespace Back\CaisseBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CaisseRepository extends EntityRepository {

    public function filtre($user = 'all', $ouverture = 'all', $fermeture = 'all', $type = 'all', $sort = "l.id", $direction = "desc") {
        $query = $this->createQueryBuilder('l');
        $query->join('l.session', 's');
        $query->where($query->expr()->isNotNull('l.id'));
        if ($user != 'all')
            $query->andWhere('s.user= :user')->setParameter('user', $user);
        if ($ouverture != 'all')
            $query->andWhere('s.dateOuverture= :ouverture')->setParameter('ouverture', $ouverture);
        if ($fermeture != 'all')
            $query->andWhere('s.dateFermeture= :fermeture')->setParameter('fermeture', $fermeture);
        if ($type != 'all')
            $query->andWhere('l.type= :type')->setParameter('type', $type);
        $query->orderBy($sort, $direction);
        return $query->getQuery()->getResult();
    }

}
