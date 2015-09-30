<?php

namespace Back\BienEtreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombrePersonne')
            ->add('nomPrenom')
            ->add('email')
            ->add('tel')
            ->add('dateDebut')
            ->add('commentaire')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BienEtreBundle\Entity\Reservation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_bienetrebundle_reservation';
    }
}
