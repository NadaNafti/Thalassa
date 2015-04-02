<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FicheTechniqueType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('delaiAnnulation')
                ->add('delaiRectrocession')
                ->add('min1AgeEnfant')
                ->add('max1AgeEnfant')
                ->add('min2AgeEnfant')
                ->add('max2AgeEnfant')
                ->add('nbrAdulteAvoirChambreSeparer')
                ->add('minEnfantChambreSepare')
                ->add('maxEnfantChambreSepare')
                ->add('suppSingle1Adulte1EnfantChDouble', 'checkbox', array(
                    'label' => ' Appliquer supp. single avec un adulte et un enfant dans une chambre double :',
                    'required' => false
                ))
                ->add('suppSingle1Adulte2EnfantChDouble', 'checkbox', array(
                    'label' => ' Appliquer supp. single avec un adulte et un deux enfant dans une chambre double :',
                    'required' => false
                ))
                ->add('tarifWeekend', 'checkbox', array(
                    'label' => ' L\'hôtel gère les tarifs week-end :',
                    'required' => false
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\FicheTechnique'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_fichetechnique';
    }

}
