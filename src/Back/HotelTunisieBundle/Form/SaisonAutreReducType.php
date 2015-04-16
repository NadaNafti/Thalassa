<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonAutreReducType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('valeurAdulte')
                ->add('valeurEnfant')
                ->add('valeurPour', 'checkbox', array(
                    'label'   =>'En pourcentage',
                    'required'=>false
                ))
                ->add('marge')
                ->add('margePour', 'checkbox', array(
                    'label'   =>'En pourcentage',
                    'required'=>false
                ))
                ->add('reduc')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'Back\HotelTunisieBundle\Entity\SaisonAutreReduc'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonautrereduc';
    }

}
