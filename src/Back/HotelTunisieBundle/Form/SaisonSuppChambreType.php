<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaisonSuppChambreType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('etat')
                ->add('valeur')
                ->add('valeurPour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
                ->add('marge')
                ->add('margePour', 'checkbox', array(
                    'label'   =>'Par pourcentage',
                    'required'=>false
                ))
                ->add('chambre')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'Back\HotelTunisieBundle\Entity\SaisonSuppChambre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonsuppchambre';
    }

}
