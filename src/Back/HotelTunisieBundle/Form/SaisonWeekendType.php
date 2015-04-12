<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonWeekendType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('vendredi', 'checkbox', array(
                    'label' => 'Vendredi',
                    'required' => false
                ))
                ->add('samedi', 'checkbox', array(
                    'label' => 'Samedi',
                    'required' => false
                ))
                ->add('dimanche', 'checkbox', array(
                    'label' => 'Dimanche',
                    'required' => false
                ))
                ->add('type', 'choice', array(
                    'choices' => array(
                        '1' => 'Supplément',
                        '2' => 'Réduction'
                    ),
                    'expanded'  => true,
                    'multiple'  => false,
                ))
                ->add('valeur')
                ->add('valeurPour', 'checkbox', array(
                    'label' => 'en pourcentage',
                    'required' => false
                ))
                ->add('marge')
                ->add('margePour', 'checkbox', array(
                    'label' => 'en pourcentage',
                    'required' => false
                ))
                ->add('nbNuitMin')
                ->add('nbNuitMax')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonWeekend'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'back_hoteltunisiebundle_saisonweekend';
    }

}
