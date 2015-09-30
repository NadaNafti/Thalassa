<?php
    namespace Back\BienEtreBundle\Entity\Repository;

    use Doctrine\ORM\EntityRepository;

    class ProduitRepository extends EntityRepository
    {
        public function filtre($produits = 'all',$name = NULL, $sort='p.libelle', $direction='asc')
        {
            $query = $this->createQueryBuilder('p');
            $query->where($query->expr()->isNotNull('p.id'));
            if($produits != "all")
            {
                $produits= explode(',', $produits);
                $orX = $query->expr()->orX();
                foreach ($produits as $prod)
                    $orX->add($query->expr()->eq("p.type",$prod));
                $query->andWhere($orX);
            }
            if($name != 'all' && !is_null($name)){
                $orX = $query->expr()->orX();
                $name = explode('+',$name);
                foreach($name as $mot){
                    if($mot != '')
                        $orX->add($query->expr()->like("UPPER(p.libelle)","UPPER('%" . $mot . "%')"));
                }
                $query->andWhere($orX);
            }
            $query->orderBy($sort,$direction);
            return $query->getQuery()->getResult();
        }
    }
