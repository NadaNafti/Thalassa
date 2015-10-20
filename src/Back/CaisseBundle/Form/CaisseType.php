<?php

namespace Back\CaisseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Back\UserBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
class CaisseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('libelle')
                ->add('pointVente')
                ->add('user');
//                        ,'entity', array(
//                'class' => 'BackUserBundle:User',
//                'query_builder' => function(EntityRepository $qb)
//                {
//                     $qb->createQueryBuilder('u');
//                     return $qb->leftJoin('u.groups', 'g')
//                ->where($qb->expr()->orX(
//                    $qb->expr()->like('u.roles', ':roles'),
//                    $qb->expr()->like('g.roles', ':roles')
//                ))
//                ->setParameter('roles', '%ROLE_ADMIN%');
//                     },
//                    'required' => true
//            ));
                        
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Back\CaisseBundle\Entity\Caisse'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'back_caissebundle_caisse';
    }

}
