<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonChambreType extends AbstractType
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
                    'attr'=>array('style'=>'margin-top:-15px;')
                ))
            ->add('minAdulte')
            ->add('maxAdulte')
            ->add('minEnfant')
            ->add('maxEnfant')
            ->add('minPax')
            ->add('maxPax')
            ->add('chambre')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonChambre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonchambre';
    }
}
