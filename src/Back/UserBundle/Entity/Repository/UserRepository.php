<?php
    namespace Back\UserBundle\Entity\Repository;

    use Doctrine\ORM\EntityRepository;

    class UserRepository extends EntityRepository
    {
        public function findByRole($role)
        {
            $qb = $this->createQueryBuilder('u');
            $qb
                ->leftJoin('u.groups', 'g')
                ->where($qb->expr()->orX(
                    $qb->expr()->like('u.roles', ':roles'),
                    $qb->expr()->like('g.roles', ':roles')
                ))
                ->setParameter('roles', '%"'.$role.'"%');
            return $qb->getQuery()->getResult();
        }
    }
