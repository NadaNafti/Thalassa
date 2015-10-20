<?php

namespace Back\CaisseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeLigneCaisseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('code')
                ->add('sensMouvement', 'choice', array(
                    'choices' => array(
                        'C' => 'Crédit',
                        'D' => 'Débit'
                    ), 'required' => true
                ))
                ->add('libelle')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Back\CaisseBundle\Entity\TypeLigneCaisse'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'back_caissebundle_typelignecaisse';
    }

}
