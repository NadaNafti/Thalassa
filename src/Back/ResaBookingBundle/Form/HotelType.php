<?php

namespace Back\ResaBookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id','hidden')
            ->add('hotel','entity',array(
                'class'=>'BackHotelTunisieBundle:Hotel',
                'required'      => false,
                'empty_value'   => 'Pas d\'hôtel',
                'empty_data'    => null
            ))
        ;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'back_resabookingbundle_hotel';
    }
}
