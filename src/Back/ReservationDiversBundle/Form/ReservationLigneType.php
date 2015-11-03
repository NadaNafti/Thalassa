<?php

namespace Back\ReservationDiversBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservationLigneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('quantite')
            ->add('nbrAdulte')
            ->add('puhtAdulte')
            ->add('puttAdulte')
            ->add('nbrEnfant')
            ->add('puhtEnfant')
            ->add('puttEnfant')
            ->add('tauxTva')
            ->add('montantRemise')
            ->add('reservation')
            ->add('parent')
            ->add('produit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\ReservationDiversBundle\Entity\ReservationLigne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_reservationdiversbundle_reservationligne';
    }
}
