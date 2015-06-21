<?php

namespace Back\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgenceType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom')
                ->add('adresse')
                ->add('tel1')
                ->add('tel2')
                ->add('fax')
                ->add('contactEmail')
                ->add('site')
                ->add('file', 'file', array('required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\AdministrationBundle\Entity\Agence'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_administrationbundle_agence';
    }

}
