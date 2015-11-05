<?php

namespace Back\BienEtreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('libelle')
                ->add('type', 'choice', array(
                    'choices' => array(
                        1 => 'Pack',
                        2 => 'Soin',
                        3 => 'Cure'
                    ),
                    'expanded' => true
                ))
                ->add('descriptionCourte')
                ->add('descriptionLongue', 'ckeditor')
                ->add('centres')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BienEtreBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'back_bienetrebundle_produit';
    }
    
    
    
    

}
