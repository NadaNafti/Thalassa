<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConfigurationVoucherType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debutVoucher')
            ->add('gmaps', 'checkbox', array(
                'label'    => 'Activer google maps dans le voucher',
                'required' => false
            ))
            ->add('codeCouleur')
            ->add('texteVoucher', 'ckeditor')
            ->add('typeNumerotation', 'choice', array(
                'choices' => array(
                    1 => 'Année, num Piéce',
                    2 => 'Num Piéce/Mois/Année',
                ),
            ))
            ->add('model', 'choice', array(
                'choices' => array(
                    1 => 'Modèle 1',
                    2 => 'Modèle 2',
                ),
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\ConfigurationVoucher'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_configuration_voucher';
    }

}
