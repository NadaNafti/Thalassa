<?php

namespace Back\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AmicaleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('produits')
            ->add('adresse')
            ->add('tel')
            ->add('fax')
            ->add('plafond')
            ->add('type','choice',array(
                'required'=>true,
                'choices'=>array(
                    1=>"Association",
                    2=>"Amicale",
                    3=>"Eétablissement public",
                    4=>"Fondation",
                    5=>"Société",
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\AdministrationBundle\Entity\Amicale'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_administrationbundle_amicale';
    }
}
