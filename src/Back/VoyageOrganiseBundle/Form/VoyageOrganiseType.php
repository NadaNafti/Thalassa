<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoyageOrganiseType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder
		->add('libelle')
		->add('nbrJour')
		->add('nbrNuit')
		->add('depart', 'date', array(
		    'required' => false,
		    'widget' => 'single_text',
		    'format' => 'yyyy-MM-dd',
		))
		->add('retour', 'date', array(
		    'required' => false,
		    'widget' => 'single_text',
		    'format' => 'yyyy-MM-dd',
		))
		->add('debutInscription', 'date', array(
		    'required' => false,
		    'widget' => 'single_text',
		    'format' => 'yyyy-MM-dd',
		))
		->add('finInscription', 'date', array(
		    'required' => false,
		    'widget' => 'single_text',
		    'format' => 'yyyy-MM-dd',
		))
		->add('prix')
		->add('nbrInscriptionsMin')
		->add('nbrInscriptionsMax')
		->add('descriptionCourte')
		->add('descriptionLongue','ckeditor')
		->add('pays')
		->add('destination', 'entity', array(
		    'class' => 'Back\VoyageOrganiseBundle\Entity\Destination',
		    'required' => true,
		    'empty_value' => 'Liste des déstinations',
		    'empty_data' => null
		))
	;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
	$resolver->setDefaults(array(
	    'data_class' => 'Back\VoyageOrganiseBundle\Entity\VoyageOrganise'
	));
    }

    /**
     * @return string
     */
    public function getName()
    {
	return 'back_voyageorganisebundle_voyageorganise';
    }

}
