<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SupplementType extends AbstractType
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
                ->add('obligatoire')
                ->add('jourDebut', 'choice', array('choices'=>$jour))
                ->add('moisDebut', 'choice', array('choices'=>$mois))
                ->add('jourFin', 'choice', array('choices'=>$jour))
                ->add('moisFin', 'choice', array('choices'=>$mois))
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
            'data_class'=>'Back\HotelTunisieBundle\Entity\Supplement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_supplement';
    }

}
