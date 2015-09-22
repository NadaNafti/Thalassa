<?php

namespace Back\BilletterieMaritimeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Back\BilletterieMaritimeBundle\Form\BilletterieReservationLigneType;

class BilletterieReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire')
            ->add('typeVol','choice',array(
                'choices'=>array(
                    1=>"Aller-Retour",
                    2=>"Aller-Simple",
                    3=>"Multi-Segments",
                )
            ))
            ->add('nomPrenom')
            ->add('email')
            ->add('cin')
            ->add('tel')
            ->add('codePostal')
            ->add('ville')
            ->add('company')
            ->add('classe','choice',array(
                'choices'=>array(
                    1=>"Economy",
                    2=>"Business",
                    3=>"First",
                )
            ))
            ->add('lieuDepart')
            ->add('lieuArriver')
            ->add('dateDepart', 'date', array(
                'required' => FALSE,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',
            ))
            ->add('deteArriver', 'date', array(
                'required' => FALSE,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',
            ))
            ->add('lignes', 'collection', array('type' => new BilletterieReservationLigneType()));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BilletterieMaritimeBundle\Entity\BilletterieReservation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_billetteriemaritimebundle_billetteriereservation';
    }
}
