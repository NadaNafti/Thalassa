<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\EntityRepository;

class HotelRepository extends EntityRepository
{

    public function getDeletedList()
    {
        $query=$this->createQueryBuilder('a');
        $query->where($query->expr()->isNotNull('a.deletedAt'));
        return $query->getQuery()->getResult();
    }

    public function filtreBackOffice($ville, $chaine, $libelle)
    {
        $query=$this->createQueryBuilder('h');
        $query->where($query->expr()->isNotNull('h.id'));
        if($ville != 'all')
            $query->andWhere('h.ville=:ville')->setParameter('ville', $ville);
        if($chaine != 'all')
            $query->andWhere('h.chaine=:chaine')->setParameter('chaine', $chaine);
        if($libelle != 'all')
        {
            $ORs=array();
            $libelle=explode('+', $libelle);
            foreach($libelle as $mot)
                $ORs[]=$query->expr()->like("UPPER(h.libelle)", "UPPER('%".$mot."%')");
            $orX=$query->expr()->orX();
            foreach($ORs as $or)
                $orX->add($or);
            $query->andWhere($orX);
        }
        $query->orderBy("h.id", 'desc');
        return $query->getQuery()->getResult();
    }

}
