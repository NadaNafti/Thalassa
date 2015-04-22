<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonArrangementType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('etat', 'checkbox', array(
                    'label'   =>' ',
                    'required'=>false,
                    'attr'    =>array( 'style'=>'margin-top:-15px;' )
                ))
                ->add('valeur')
                ->add('valeurPour', 'checkbox', array(
                    'label'   =>'En pourcentage',
                    'required'=>false
                ))
                ->add('marge')
                ->add('margePour', 'checkbox', array(
                    'label'   =>'En pourcentage',
                    'required'=>false
                ))
                ->add('arrangement')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'Back\HotelTunisieBundle\Entity\SaisonArrangement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonarrangement';
    }

}
