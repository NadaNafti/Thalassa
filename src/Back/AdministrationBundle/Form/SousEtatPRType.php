<?php

namespace Back\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SousEtatPRType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire')
            ->add('reservationPR')
            ->add('etat','entity', array(
                'class' => 'Back\AdministrationBundle\Entity\Etat',
                'query_builder' => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('e')
                        ->join('e.produit','p')
                        ->where('p.code = :code ')->setParameter('code', 'PR')
                        ;
                },
                'required' => true,
                'empty_value' => 'Liste des sous Etats',
                'empty_data' => null
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\AdministrationBundle\Entity\SousEtat'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_administrationbundle_sousetat_pr';
    }
}
