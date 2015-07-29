<?php

namespace Front\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SliderSHTType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder
		->add('ordre')
		->add('titre1')
		->add('titre2')
		->add('titre3')
		->add('url')
		->add('file', 'file', array('required' => false))
	;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
	$resolver->setDefaults(array(
	    'data_class' => 'Front\ConfigBundle\Entity\SliderSHT'
	));
    }

    /**
     * @return string
     */
    public function getName()
    {
	return 'front_configbundle_slidersht';
    }

}
