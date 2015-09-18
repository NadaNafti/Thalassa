<?php
    namespace Back\ProgrammeBundle\Entity\Repository;

    use Doctrine\ORM\EntityRepository;

    class ProgrammeRepository extends EntityRepository
    {
        public function filtre($themes = 'all',$name = NULL, $sort='p.libelle', $direction='asc')
        {
            $query = $this->createQueryBuilder('p');
            $query->where($query->expr()->isNotNull('p.id'));
            if($themes != 'all'){
                $query->join('p.themes',"t");
                $orX = $query->expr()->orX();
                $themess = explode(',',$themes);
                foreach($themess as $th)
                    $orX->add($query->expr()->eq("t.id",$th));
                $query->andWhere($orX);
            }
            if($name != 'all'){
                $orX = $query->expr()->andX();
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
