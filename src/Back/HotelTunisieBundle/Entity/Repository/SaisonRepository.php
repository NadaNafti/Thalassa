<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class SaisonRepository extends EntityRepository
{
    public function genererListe($debut, $fin, $amicale)
    {
        $query = $this->createQueryBuilder('s');
        $query
            ->join('s.periodes', 'p')
            ->where($query->expr()->isNotNull('s.type'))
            ->andWhere(
                $query
                    ->expr()->orX()
                    ->add($query->expr()->between('p.dateDebut', ':date_from', ':date_to'))
                    ->add($query->expr()->between('p.dateFin', ':date_from', ':date_to'))
                    ->add($query->expr()->between(':date_from', 'p.dateDebut', 'p.dateFin'))
                    ->add($query->expr()->between(':date_to', 'p.dateDebut', 'p.dateFin'))

            )
            ->setParameter('date_from', $debut)
            ->setParameter('date_to', $fin);
        if (!is_null($amicale)) {
            $query
                ->join('s.amicales', 'a')
                ->andWhere('s.type=3')
                ->andWhere('a.id=:idAmicale')->setParameter('idAmicale', $amicale);
        } else
            $query->andWhere('s.type!=3');

        return $query->getQuery()->getResult();
    }
}
