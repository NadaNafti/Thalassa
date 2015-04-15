<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonReducType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('val1Enfant1Adulte1')
                ->add('val1Enfant1Adulte2')
                ->add('pour1Enfant1Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('marge1Enfant1Adulte')
                ->add('margepour1Enfant1Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('val1Enfant2Adulte1')
                ->add('val1Enfant2Adulte2')
                ->add('pour1Enfant2Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('marge1Enfant2Adulte')
                ->add('margepour1Enfant2Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('val1EnfantSepare1')
                ->add('val1EnfantSepare2')
                ->add('pour1EnfantSepare', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('marge1EnfantSepare')
                ->add('margepour1EnfantSepare', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('val2Enfant1Adulte1')
                ->add('val2Enfant1Adulte2')
                ->add('pour2Enfant1Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('marge2Enfant1Adulte')
                ->add('margepour2Enfant1Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('val2Enfant2Adulte1')
                ->add('val2Enfant2Adulte2')
                ->add('pour2Enfant2Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('marge2Enfant2Adulte')
                ->add('margepour2Enfant2Adulte', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('val2EnfantOuPlusSepare1')
                ->add('val2EnfantOuPlusSepare2')
                ->add('pour2EnfantOuPlusSepare', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('marge2EnfantOuPlusSepare')
                ->add('margepour2EnfantOuPlusSepare', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('reduc3Lit')
                ->add('reduc3LitPour', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('reduc3LitMarge')
                ->add('reduc3LitMargePour', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('reduc4Lit')
                ->add('reduc4LitPour', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
                ->add('reduc4LitMarge')
                ->add('reduc4LitMargePour', 'checkbox', array(
                    'label'   =>' En pourcentage',
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
            'data_class'=>'Back\HotelTunisieBundle\Entity\SaisonReduc'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonreduc';
    }

}
