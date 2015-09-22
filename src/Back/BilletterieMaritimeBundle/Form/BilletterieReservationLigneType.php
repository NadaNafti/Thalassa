<?php

namespace Back\BilletterieMaritimeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BilletterieReservationLigneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                'choices' => array(
                    1 => "Adulte (+23 ans)",
                    2 => "Jeune (19-23 ans)",
                    3 => "Enfant (2-11 ans)",
                    4 => "Bébé (0-23 mois)",
                )
            ))
            ->add('nomPrenom')
            ->add('naissance', 'date', array(
                'required' => FALSE,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',
            ))
            ->add('passport')
            ->add('reservation');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\BilletterieMaritimeBundle\Entity\BilletterieReservationLigne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_billetteriemaritimebundle_billetteriereservationligne';
    }
}
