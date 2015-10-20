<?php

namespace Back\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PointVenteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('libelle')
                ->add('tel1')
                ->add('tel2')
                ->add('fax')
                ->add('adresse')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Back\AdministrationBundle\Entity\PointVente'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'back_administrationbundle_pointvente';
    }

}
