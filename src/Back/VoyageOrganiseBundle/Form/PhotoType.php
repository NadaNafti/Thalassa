<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhotoType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder
		->add('file', 'file', array('required' => true))
		->add('type', 'choice', array(
		    'choices' => array('1' => 'Principale', '2' => 'Album'),
		    'required' => true,
		))
		->add('ordre')
		->add('visible', 'checkbox', array(
		    'label' => 'Visible',
		    'required' => false
		))
	;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
	$resolver->setDefaults(array(
	    'data_class' => 'Back\VoyageOrganiseBundle\Entity\Photo'
	));
    }

    /**
     * @return string
     */
    public function getName()
    {
	return 'back_voyageorganisebundle_photo';
    }

}
