<?php

namespace Back\CommercialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder
		->add('timbre', 'checkbox', array(
		    'label' => 'Activer le Timbre dans les réservations',
		    'required' => false,
		))
		->add('montantTimbre')
	;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
	$resolver->setDefaults(array(
	    'data_class' => 'Back\CommercialBundle\Entity\Tarif'
	));
    }

    /**
     * @return string
     */
    public function getName()
    {
	return 'back_commercialbundle_tarif';
    }

}
