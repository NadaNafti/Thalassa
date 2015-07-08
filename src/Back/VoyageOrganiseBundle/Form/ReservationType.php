<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Back\VoyageOrganiseBundle\Form\ReservationLigneType;

class ReservationType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder
		->add('commentaire')
		->add('voyage')
		->add('client')
		->add('adultes', 'collection', array(
		    'type' => new ReservationLigneType(), 'label' => ' ',
		    'allow_add' => true,
		    'allow_delete' => true,
		    'by_reference' => false
		))
		->add('enfants', 'collection', array(
		    'type' => new ReservationLigneType(), 'label' => ' ',
		    'allow_add' => true,
		    'allow_delete' => true,
		    'by_reference' => false
		))
	;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
	$resolver->setDefaults(array(
	    'data_class' => 'Back\VoyageOrganiseBundle\Entity\Reservation'
	));
    }

    /**
     * @return string
     */
    public function getName()
    {
	return 'back_voyageorganisebundle_reservation';
    }

}
