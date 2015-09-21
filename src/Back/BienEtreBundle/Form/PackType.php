<?php

namespace Back\BienEtreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PackType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('prix')
            ->add('description')
            ->add('centre')
            ->add('soins')
            ->add('cures')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BienEtreBundle\Entity\Pack'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_bienetrebundle_pack';
    }
}
