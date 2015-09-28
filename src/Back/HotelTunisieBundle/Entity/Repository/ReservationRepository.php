<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{

    public function filtreBackOffice($etat, $amicale='all',$checkIn='all',$checkOut='all',$hotel='all',$user='all', $sort="r.id", $direction="asc")
    {
        $query = $this->createQueryBuilder('r');
        $query->join('r.hotel','h');
        $query->join('r.client','c');
        $query->where($query->expr()->isNotNull('r.id'));
        if ($etat != 'all')
            $query->andWhere('r.etat=:etat')->setParameter('etat', $etat);
        if ($amicale != 'all')
            $query->andWhere('c.amicale=:amicale')->setParameter('amicale', $amicale);
        if ($hotel != 'all')
            $query->andWhere('r.hotel=:hotel')->setParameter('hotel', $hotel);
        if ($user != 'all')
            $query->andWhere('r.responsable=:user')->setParameter('user', $user);
        if ($checkIn != 'all')
            $query->andWhere('r.dateDebut=:checkIn')->setParameter('checkIn', $checkIn);
        if ($checkOut != 'all')
        {
            $date= new \DateTime($checkOut);
            $query->andWhere('r.dateFin=:checkOut')->setParameter('checkOut', $date->modify('-1 day')->format('Y-m-d'));
        }
        $query->orderBy($sort, $direction);
        return $query->getQuery()->getResult();
    }

}
