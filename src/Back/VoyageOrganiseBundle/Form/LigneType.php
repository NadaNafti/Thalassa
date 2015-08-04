<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LigneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('adulteAchat')
            ->add('adulteVente')
            ->add('enfantAchat')
            ->add('enfantVente')
            ->add('obligatoire','checkbox',array(
		'label'=>'Obligatoire',
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
            'data_class' => 'Back\VoyageOrganiseBundle\Entity\Ligne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_voyageorganisebundle_ligne';
    }
}
