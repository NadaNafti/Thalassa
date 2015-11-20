<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Range;

class ReportingArrangementType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        for ($i = 2010; $i <= date('Y'); $i++) {
            $years[$i] = $i;
        }
        $builder
            ->add('mois', 'choice', array(
                'choices'  => array(
                    1  => 'Janvier',
                    2  => 'Février',
                    3  => 'Mars',
                    4  => 'Avril',
                    5  => 'Mai',
                    6  => 'Juin',
                    7  => 'Juillet',
                    8  => 'Août',
                    9  => 'Septembre',
                    10 => 'Octobre',
                    11 => 'Novembre',
                    12 => 'Decembre',
                ),
                'multiple' => true,
                'required' => false
            ))
            ->add('annee', 'choice', array(
                'choices'  => $years,
                'required' => true,
                'data'     => date('Y')
            ))
            ->add('etat', 'choice', array(
                'choices'  => array(
                    1 => "Enregistré",
                    2 => "Validée",
                    9 => "Annulée",
                ),
                'data'     => 2,
                'expanded' => true
            ))
            ;
    }

    public function getName()
    {
        return 'ReportingArrangementType';
    }

}
