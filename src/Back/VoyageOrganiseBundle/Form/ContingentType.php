<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContingentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chambreSingle')
            ->add('chambreDouble')
            ->add('chambreTriple')
            ->add('chambreQuadruple')
            ->add('hotel')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\VoyageOrganiseBundle\Entity\Contingent'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_voyageorganisebundle_contingent';
    }
}
