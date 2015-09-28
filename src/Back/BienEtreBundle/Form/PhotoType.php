<?php

namespace Back\BienEtreBundle\Form;

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
                ->add('file','file',array('required' => TRUE))
                ->add('type','choice',array(
                    'choices'  => array('1' => 'Principale','2' => 'Album'),
                    'required' => TRUE,
                ))
                ->add('ordre')
                ->add('visible','checkbox',array(
                    'label'    => 'Visible',
                    'required' => FALSE,
                ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BienEtreBundle\Entity\Photo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_bienetrebundle_photo';
    }
}
