<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Back\VoyageOrganiseBundle\Form\LigneType;

class PackType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('file', 'file', array('required' => false))
                ->add('updateAt')
                ->add('libelle')
                ->add('singleAchat')
                ->add('singleVente')
                ->add('doubleAchat')
                ->add('doubleVente')
                ->add('tripleAchat')
                ->add('tripleVente')
                ->add('quadrupleAchat')
                ->add('quadrupleVente')
                ->add('periode')
                ->add('hotels')
                ->add('supplements', 'collection', array(
                    'type' => new LigneType(), 'label' => ' ',
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
            'data_class' => 'Back\VoyageOrganiseBundle\Entity\Pack'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_voyageorganisebundle_pack';
    }

}
