<?php

namespace Back\AdministrationBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface ;
use Symfony\Component\OptionsResolver\OptionsResolverInterface ;

class ConventionType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder , array $options)
    {
        $builder
                ->add('dateDebut' , 'date' , array (
                    'required' => false ,
                    'widget' => 'single_text' ,
                    'format' => 'yyyy-MM-dd' ,
                ))
                ->add('dateFin' , 'date' , array (
                    'required' => false ,
                    'widget' => 'single_text' ,
                    'format' => 'yyyy-MM-dd' ,
                ))
                ->add('remise')
                ->add('typeRemise' , 'choice' , array (
                    'choices' => array ('1' => 'Remise Total' , '2' => 'Remise Prix de base') ,
                    'required' => true ,
                    'empty_value' => 'Type de remise' ,
                    'empty_data' => null
                ))
                ->add('type' , 'choice' , array (
                    'choices' => array (
                        '1' => 'Ne pas prendre en compte les promo et appliquer les remises' ,
                        '2' => 'Prendre en compte les promo et ne pas appliquer les remises'
                    ) ,
                    'required' => true ,
                    'empty_value' => 'Promo & Remises' ,
                    'empty_data' => null
                ))
                ->add('amicale')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array (
            'data_class' => 'Back\AdministrationBundle\Entity\Convention'
        )) ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_administrationbundle_convention' ;
    }

}
