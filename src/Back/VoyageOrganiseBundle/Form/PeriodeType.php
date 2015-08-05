<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PeriodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('prix')
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
            ->add('nombreInscriptionInitiale')
            ->add('min')
            ->add('max')
            ->add('departGarantie', 'checkbox', array(
                    'label'   =>'Départ garentie',
                    'required'=>false
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\VoyageOrganiseBundle\Entity\Periode'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_voyageorganisebundle_periode';
    }
}
