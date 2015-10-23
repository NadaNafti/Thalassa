<?php

namespace Back\ResaBookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConfigurationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('password')
            ->add('lienProduit')
            ->add('lienPrix')
            ->add('wsdl')
            ->add('email')
            ->add('civilite','choice',array(
                'required'=>true,
                'choices'=>array(
                    'Mr'=>"Mr",
                    'Mme'=>"Mme",
                    'Melle'=>"Melle",
                )
            ))
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('tel')
            ->add('ville')
            ->add('codePostal')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\ResaBookingBundle\Entity\Configuration'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_resabookingbundle_configuration';
    }
}
