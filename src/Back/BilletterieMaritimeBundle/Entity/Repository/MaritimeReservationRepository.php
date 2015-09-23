<?php
    namespace Back\BilletterieMaritimeBundle\Entity\Repository;

    use Doctrine\ORM\EntityRepository;

    class MaritimeReservationRepository extends EntityRepository
    {
        public function filtre($etat,$sort = 'r.id',$direction = 'desc')
        {
            $query = $this->createQueryBuilder('r');
            $query->join('r.client',"c");
            $query->where($query->expr()->isNotNull('r.id'));
            if($etat != 'all')
                $query->andWhere('r.etat=:etat')->setParameter('etat',$etat);
            $query->orderBy($sort,$direction);
            return $query->getQuery()->getResult();
        }
    }
