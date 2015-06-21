<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\EntityRepository;

class HotelRepository extends EntityRepository
{

    public function getDeletedList()
    {
        $query = $this->createQueryBuilder('a');
        $query->where($query->expr()->isNotNull('a.deletedAt'));
        return $query->getQuery()->getResult();
    }

    public function filtreFrontOffice($categorie, $chaine, $ville, $name)
    {
        $query = $this->createQueryBuilder('h');
        $query->join('h.ville', "v");
        $query->join('v.pays', "p");
        $query->where('p.code=:code')->setParameter('code', 'tn');
        $query->andWhere('h.etat=:etat')->setParameter('etat', TRUE);
        if ($categorie != 'all')
            $query->andWhere('h.categorie=:categorie')->setParameter('categorie', $categorie);
        if ($ville != 'all')
            $query->andWhere('h.ville=:ville')->setParameter('ville', $ville);
        if ($chaine != 'all')
            $query->andWhere('h.chaine=:chaine')->setParameter('chaine', $chaine);
        if ($name != 'all')
        {
            $ORs = array();
            $name = explode('+', $name);
            foreach ($name as $mot)
                $ORs[] = $query->expr()->like("UPPER(h.libelle)", "UPPER('%" . $mot . "%')");
            $orX = $query->expr()->andX();
            foreach ($ORs as $or)
                $orX->add($or);
            $query->andWhere($orX);
        }
        $query->orderBy("h.libelle", 'asc');
        return $query->getQuery()->getResult();
    }

    public function filtreBackOffice($ville, $chaine, $categorie, $etat, $libelle, $sort, $direction)
    {
        $query = $this->createQueryBuilder('h');
        $query->join('h.ville', "v");
        $query->join('v.pays', "p");
        $query->leftJoin('h.categorie', "c");
        $query->leftJoin('h.fournisseur', "f");
        $query->where('p.code=:code')->setParameter('code', 'tn');
        if ($ville != 'all')
            $query->andWhere('h.ville=:ville')->setParameter('ville', $ville);
        if ($etat != 'all')
            $query->andWhere('h.etat=:etat')->setParameter('etat', $etat);
        if ($categorie != 'all')
            $query->andWhere('h.categorie=:categorie')->setParameter('categorie', $categorie);
        if ($chaine != 'all')
            $query->andWhere('h.chaine=:chaine')->setParameter('chaine', $chaine);
        if ($libelle != 'all')
        {
            $ORs = array();
            $libelle = explode('+', $libelle);
            foreach ($libelle as $mot)
                $ORs[] = $query->expr()->like("UPPER(h.libelle)", "UPPER('%" . $mot . "%')");
            $orX = $query->expr()->andX();
            foreach ($ORs as $or)
                $orX->add($or);
            $query->andWhere($orX);
        }
        $query->orderBy($sort, $direction);
        return $query->getQuery()->getResult();
    }

}
