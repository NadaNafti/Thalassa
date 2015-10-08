<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ReservationChambreRepository extends EntityRepository
{

    public function getCountChambreContingent($saison,$date)
    {
        $query = $this
                ->createQueryBuilder('c')
                ->select('count(c)')
                ->join('c.jours','j')
                ->join('c.reservation','r')
                ->where('j.saisonContingent=:saison')->setParameter('saison',$saison->getId())
                ->andWhere('j.jour=:date')->setParameter('date',$date)
                ->andWhere('r.etat= 2');

        return $query->getQuery()->getSingleScalarResult();
    }

}
