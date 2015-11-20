<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{

    public function filtreBackOffice($etat, $amicale = 'all', $checkIn = 'all', $checkOut = 'all', $hotel = 'all', $user = 'all', $sort = "r.id", $direction = "desc")
    {
        $query = $this->createQueryBuilder('r');
        $query->join('r.hotel', 'h');
        $query->join('r.client', 'c');
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
        if ($checkOut != 'all') {
            $date = new \DateTime($checkOut);
            $query->andWhere('r.dateFin=:checkOut')->setParameter('checkOut', $date->modify('-1 day')->format('Y-m-d'));
        }
        $query->orderBy($sort, $direction);
        return $query->getQuery()->getResult();
    }

    public function getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions="all", $hotels="all", $users="all",$source="all",$arrangements="all",$chambres='all')
    {
        $emConfig = $this->getEntityManager()->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        $emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
        $query = $this->createQueryBuilder('r');
        switch($typeStatistique)
        {
            case 'nbr_reservation': $query->select('count(DISTINCT r.id)');break;
            case 'nombre_nuitee': $query->select('sum(r.nuitees)');break;
            case 'chiffre_affaire': $query->select('sum(r.chiffreAffaire)');break;
            case 'nbr_chambre': $query->select('count(c.id)')->join('r.chambres','c');break;
        }

        $query->where($query->expr()->isNotNull('r.id'));

        if ($arrangements != 'all') {
            $array = explode(',', $arrangements);
            $query->andWhere('c.arrangement IN (:arrayArr)')->setParameter('arrayArr', $array);
        }

        if ($chambres != 'all') {
            $array = explode(',', $chambres);
            $query->andWhere('c.chambre IN (:arrayCH)')->setParameter('arrayCH', $array);
        }
        if($source!='all')
        {
            if($source=='f')
                $query->andWhere('r.frontOffice= true');
            else
                $query->andWhere('r.frontOffice = false');
        }
        if ($hotels != 'all') {
            $array = explode(',', $hotels);
            $query->andWhere('r.hotel IN (:arrayH)')->setParameter('arrayH', $array);
        }
        if ($regions != 'all') {
            $query->join('r.hotel','h');
            $query->join('h.ville','v');
            $array = explode(',', $regions);
            $query->andWhere('v.region IN (:arrayR)')->setParameter('arrayR', $array);
        }
        $query->andWhere('r.etat=:etat')->setParameter('etat', $etat)
            ->andWhere('YEAR(r.dateDebut) = :year')->setParameter('year', $annee);
        if ($mois != 'all') {
            $array = explode(',', $mois);
            $query->andWhere('MONTH(r.dateDebut) IN (:arrayM)')->setParameter('arrayM', $array);
        }
        if ($users != 'all') {
            $array = explode(',', $users);
            $query->andWhere('r.responsable IN (:array)')->setParameter('array', $array);
        }
        return $query->getQuery()->getSingleScalarResult();
    }


    public function getFromString($hotels,$regions)
    {
        $query = $this->createQueryBuilder('r');
        $query->where($query->expr()->isNotNull('r.id'));
        $query->join('r.hotel','h');
        if($hotels!='all')
        {
            $array=explode(',',$hotels);
            $query->andWhere('h.id IN (:array1)')->setParameter('array1', $array);
        }
        $query->join('h.ville','v');
        if($regions!='all')
        {
            $array=explode(',',$regions);
            $query->andWhere('v.region IN (:array2)')->setParameter('array2', $array);
        }
        return $query->getQuery()->getResult();
    }

}
