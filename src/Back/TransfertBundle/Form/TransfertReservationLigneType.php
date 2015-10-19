<?php

namespace Back\TransfertBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransfertReservationLigneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie','choice',array(
                'choices' => array(
                    1=>"Véhicule de tourisme",
                    2=>"Véhicule monospace",
                    3=>"Véhicule Luxe et Confort",
                    4=>"4*4",
                    5=>"Grand Bus",
                    6=>"Mini Bus",
                    7=>"Autres",
                    )
                )
            )
            ->add('nombre','choice',array(
                'choices' => array(
                    1=>1,
                    2=>2,
                    3=>3,
                    4=>4,
                    5=>5,
                    6=>6,
                    7=>7,
                    8=>8,
                    9=>9,
                    10=>10,
                )
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\TransfertBundle\Entity\TransfertReservationLigne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_transfertbundle_transfertreservationligne';
    }
}
