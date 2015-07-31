<?php

namespace Front\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Front\ConfigBundle\Form\MediaType;

class BlockMetroSHTType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('tag1')
            ->add('photo1',new MediaType())
            ->add('tag2')
            ->add('photo2',new MediaType())
            ->add('tag3')
            ->add('photo3',new MediaType())
            ->add('tag4')
            ->add('photo4',new MediaType())
            ->add('tag5')
            ->add('photo5',new MediaType())
            ->add('tag6')
            ->add('photo6',new MediaType())
            ->add('tag7')
            ->add('photo7',new MediaType())
            ->add('tag8')
            ->add('photo8',new MediaType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Front\ConfigBundle\Entity\BlockMetroSHT'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'front_configbundle_blockmetrosht';
    }
}
