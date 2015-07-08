<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DescriptionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('texte','ckeditor')
            ->add('ordre')
            ->add('visible','checkbox',array(
		'label'=>'Visible',
		'required'=>FALSE
	    ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\VoyageOrganiseBundle\Entity\Description'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_voyageorganisebundle_description';
    }
}
