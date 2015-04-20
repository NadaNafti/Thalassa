<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Back\HotelTunisieBundle\Form\SaisonChambreType;
class SaisonType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('libelle')
                ->add('type', 'choice', array(
                    'choices' => array(
                        '1' => 'Saison',
                        '2' => 'Promotion'
                    ),
                    'expanded'  => true,
                    'multiple'  => false,
                ))
                ->add('delaiAnnulation')
                ->add('delaiRetrocession')
                ->add('nombrePlace')
                ->add('aCompte')
                ->add('minStay')
                ->add('totalContingent')
                ->add('prixConvention','integer')
                ->add('margeVente','integer')
                ->add('pourcentage', 'checkbox', array(
                    'label'   =>' En pourcentage',
                    'required'=>false
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'Back\HotelTunisieBundle\Entity\Saison'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saison';
    }

}
