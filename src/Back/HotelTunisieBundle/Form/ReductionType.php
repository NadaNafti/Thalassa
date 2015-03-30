<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReductionType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('libelle')
                ->add('obligatoire')
                ->add('jourDebut', 'choice', array('choices'=>array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31)))
                ->add('moisDebut', 'choice', array('choices'=>array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)))
                ->add('jourFin', 'choice', array('choices'=>array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31)))
                ->add('moisFin', 'choice', array('choices'=>array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)))
                ->add('parNuit')
                ->add('parChambre')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'Back\HotelTunisieBundle\Entity\Reduction'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_reduction';
    }

}
