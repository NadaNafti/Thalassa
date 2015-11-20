<?php

namespace Back\HotelTunisieBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class HotelRepository extends EntityRepository
{

    public function getDeletedList()
    {
        $query = $this->createQueryBuilder('a');
        $query->where($query->expr()->isNotNull('a.deletedAt'));
        return $query->getQuery()->getResult();
    }

    public function getFromString($ch,$regions)
    {
        $query = $this->createQueryBuilder('h');
        $query->where($query->expr()->isNotNull('h.id'));
        if($ch!='all')
        {
            $array=explode(',',$ch);
            $query->andWhere('h.id IN (:array1)')->setParameter('array1', $array);
        }
        $query->join('h.ville','v');
        if($regions!='all')
        {
            $array=explode(',',$regions);
            $query->andWhere('v.region IN (:array2)')->setParameter('array2', $array);
        }
        $query->orderBy("h.libelle", 'asc');
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
            $mots = explode('+', $name);
            foreach ($mots as $mot)
				$andX = $query->expr()->andX()->add($query->expr()->like("UPPER(h.libelle)", "UPPER('%" . $mot . "%')"));
            $query->andWhere($andX);
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
            $libelle = explode('+', $libelle);
            foreach ($libelle as $mot)
				$andX = $query->expr()->andX()->add($query->expr()->like("UPPER(h.libelle)", "UPPER('%" . $mot . "%')"));
            $query->andWhere($andX);
        }
        $query->orderBy($sort, $direction);
        return $query->getQuery()->getResult();
    }

    public function filtreFrontOfficePlus($categorie = 'all', $chaine = 'all', $ville = 'all', $tag = 'all', $name = null, $sort='h.libelle', $direction='asc')
    {
        $query = $this->createQueryBuilder('h');
        $query->join('h.ville', "v");
        $query->join('v.pays', "p");
        $query->where('p.code=:code')->setParameter('code', 'tn');
        $query->andWhere('h.etat=:etat')->setParameter('etat', TRUE);
        if ($categorie != 'all')
        {
            $orX = $query->expr()->orX();
            $categories = explode(',', $categorie);
            foreach ($categories as $cat)
                $orX->add($query->expr()->eq("h.categorie", $cat));
            $query->andWhere($orX);
        }
        if ($tag != 'all')
        {
            $query->join('h.tags', "t");
            $orX = $query->expr()->orX();
            $tags = explode(',', $tag);
            foreach ($tags as $ta)
                $orX->add($query->expr()->eq("t.id", $ta));
            $query->andWhere($orX);
        }
        if ($ville != 'all')
        {
            $orX = $query->expr()->orX();
            $villes = explode(',', $ville);
            foreach ($villes as $vil)
                $orX->add($query->expr()->eq("h.ville", $vil));
            $query->andWhere($orX);
        }
        if ($chaine != 'all')
        {
            $orX = $query->expr()->orX();
            $chaines = explode(',', $chaine);
            foreach ($chaines as $ch)
                $orX->add($query->expr()->eq("h.chaine", $ch));
            $query->andWhere($orX);
        }
        if ($name != 'all')
        {
            $orX = $query->expr()->andX();
            $name = explode('+', $name);
            foreach ($name as $mot)
            {
                if ($mot != '')
                    $orX->add($query->expr()->like("UPPER(h.libelle)", "UPPER('%" . $mot . "%')"));
            }
            $query->andWhere($orX);
        }
        $query->orderBy($sort, $direction);
        return $query->getQuery()->getResult();
    }

}
