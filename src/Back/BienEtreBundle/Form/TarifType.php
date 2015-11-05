<?php

namespace Back\BienEtreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('prixAchat')
                ->add('prixVente')
                ->add('dateDeb', 'date', array(
                    'required' => FALSE,
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('dateFin', 'date', array(
                    'required' => FALSE,
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('libelle')
                ->add('promotion')
                ->add('duree')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BienEtreBundle\Entity\Tarif'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'back_bienetrebundle_tarif';
    }

}
