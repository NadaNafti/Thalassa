<?php

namespace Front\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Front\ConfigBundle\Form\MediaAccueilType;

class AccueilType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre1')
            ->add('texte1')
            ->add('lien1')
            ->add('titre2')
            ->add('texte2')
            ->add('lien2')
            ->add('titre3')
            ->add('texte3')
            ->add('lien3')
            ->add('description','textarea')
            ->add('skype')
            ->add('facebook')
            ->add('googlePlus')
            ->add('youtube')
            ->add('photo1',new MediaAccueilType())
            ->add('photo2',new MediaAccueilType())
            ->add('photo3',new MediaAccueilType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Front\ConfigBundle\Entity\Accueil'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'front_configbundle_accueil';
    }
}
