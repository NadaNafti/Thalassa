<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('longitude')
            ->add('latitude')
            ->add('adresse')
            ->add('descriptionCourte')
            ->add('descriptionLongue','ckeditor')
            ->add('chaine')
            ->add('fournisseur')
            ->add('ville')
            ->add('categorie')
            ->add('tags')
            ->add('chambres')
            ->add('options')
            ->add('localisations')
            ->add('themes')
            ->add('arrangements')
            ->add('amenagements')
            ->add('vues')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\Hotel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_hotel';
    }
}
