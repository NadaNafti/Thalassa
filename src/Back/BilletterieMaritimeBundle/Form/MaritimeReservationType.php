<?php

namespace Back\BilletterieMaritimeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MaritimeReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeVoyage', 'choice', array(
                'choices' => array(
                    1 => "Aller-Retour",
                    2 => "Aller-Simple",
                )
            ))
            ->add('commentaire')
            ->add('nomPrenom')
            ->add('email')
            ->add('cin')
            ->add('tel')
            ->add('marque')
            ->add('matriculation')
            ->add('passagers', 'choice', array(
                'choices' => array(
                    1 => "Résident",
                    2 => "Non-Résident",
                    3 => "Diplomat",
                    4 => "Etudiant",
                )
            ))
            ->add('cabine', 'choice', array(
                'choices' => array(
                    1 => "Fauteuil",
                    2 => "Cabine-Exterieur",
                    3 => "Cabine-Interieur",
                    4 => "Suite",
                )
            ))
            ->add('lieuDepart')
            ->add('lieuArrivee')
            ->add('dateDepart', 'date', array(
                'required' => FALSE,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BilletterieMaritimeBundle\Entity\MaritimeReservation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_billetteriemaritimebundle_maritimereservation';
    }
}
