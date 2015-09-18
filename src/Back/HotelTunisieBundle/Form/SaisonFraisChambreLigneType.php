<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonFraisChambreLigneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreAdulte')
            ->add('nombreEnfant')
            ->add('adulte1')
            ->add('adulte2')
            ->add('adulte3')
            ->add('adulte4')
            ->add('adulte5')
            ->add('adulte6')
            ->add('adulte7')
            ->add('adulte8')
            ->add('adulte9')
            ->add('adulte10')
            ->add('enfant1')
            ->add('enfant2')
            ->add('enfant3')
            ->add('enfant4')
            ->add('enfant5')
            ->add('enfant6')
            ->add('enfant7')
            ->add('enfant8')
            ->add('enfant9')
            ->add('enfant10')
            ->add('margeAdulte')
            ->add('margeEnfant')
            ->add('arrangement')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonFraisChambreLigne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonfraischambreligne';
    }
}
