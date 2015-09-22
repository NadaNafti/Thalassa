<?php

namespace Back\BilletterieMaritimeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('typeVol')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('cin')
            ->add('tel')
            ->add('codePostal')
            ->add('ville')
            ->add('company')
            ->add('classe')
            ->add('lieuDepart')
            ->add('lieuArriver')
            ->add('dateDepart')
            ->add('deteArriver')
            ->add('responsable')
            ->add('client')
            ->add('lignes','collection',new BilletterieReservationLigneType())
        ;
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
