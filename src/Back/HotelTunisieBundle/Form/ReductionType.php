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
        $jour=array();
        $mois=array();
        for($i=1; $i<32; $i++)
            $jour[$i]=$i;
        for($i=1; $i<13; $i++)
            $mois[$i]=$i;
        $builder
                ->add('libelle')
                ->add('jourDebut', 'choice', array('choices'=>$jour))
                ->add('moisDebut', 'choice', array('choices'=>$mois))
                ->add('jourFin', 'choice', array('choices'=>$jour))
                ->add('moisFin', 'choice', array('choices'=>$mois))
                ->add('parNuit', 'choice', array(
                    'choices' =>array( '0'=>'Une seul fois', '1'=>'Chaque nuit' ),
                    'expanded'=>true,
                    'multiple'=>false,
                ))
                ->add('parChambre', 'choice', array(
                    'choices' =>array( '0'=>'Par personne', '1'=>'Par chambre' ),
                    'expanded'=>true,
                    'multiple'=>false,
                ))
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
