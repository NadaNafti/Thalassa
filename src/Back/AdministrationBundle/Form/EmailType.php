<?php

namespace Back\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmailType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('creationBack', 'checkbox', array(
                'label'    => 'Creation Back',
                'required' => false,
            ))
            ->add('creationFront', 'checkbox', array(
                'label'    => 'Creation Front',
                'required' => false,
            ))
            ->add('validation', 'checkbox', array(
                'label'    => 'Validation',
                'required' => false,
            ))
            ->add('annulation', 'checkbox', array(
                'label'    => 'Annulation',
                'required' => false,
            ))
            ->add('produits', 'entity', array(
                'class'    => 'Back\AdministrationBundle\Entity\Produit',
                'required' => true,
                'expanded' => true,
                'multiple' => true
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\AdministrationBundle\Entity\Email'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_administrationbundle_email';
    }

}
