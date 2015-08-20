<?php

namespace Back\ProgrammeBundle\Form;

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
            ->add('obligatoire')
            //->add('periode')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\ProgrammeBundle\Entity\Ligne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_programmebundle_ligne';
    }
}
