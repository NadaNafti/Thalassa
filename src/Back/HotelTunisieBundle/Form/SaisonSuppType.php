<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonSuppType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('suppSingle')
            ->add('suppSinglePour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
            ->add('sippSingleMarge')
            ->add('suppSingleMargePour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
            ->add('supp3Lit')
            ->add('supp3LitPour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
            ->add('supp3LitMarge')
            ->add('supp3LitMargePour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
            ->add('supp4Lit')
            ->add('supp4LitPour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
            ->add('supp4LitMarge')
            ->add('supp4LitMargePour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
            ->add('suppSingleEnfant', 'checkbox', array(
                    'label'   =>'Activer',
                    'required'=>false
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonSupp'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonsupp';
    }
}
