<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonContingentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut', 'date', array(
                'required'=>false,
                'widget'  =>'single_text',
                'format'  =>'yyyy-MM-dd',
            ))
            ->add('fin', 'date', array(
                'required'=>false,
                'widget'  =>'single_text',
                'format'  =>'yyyy-MM-dd',
            ))
            ->add('nombreChambre')
//            ->add('saison')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonContingent'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisoncontingent';
    }
}
