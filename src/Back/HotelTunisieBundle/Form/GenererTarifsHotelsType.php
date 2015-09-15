<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Range;

class GenererTarifsHotelsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut', 'date', array(
                'required' => true,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',
            ))
            ->add('fin', 'date', array(
                'required' => true,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',
            ))
            ->add('amicale', 'entity', array('class'         => 'BackAdministrationBundle:Amicale',
                                             'query_builder' => function (EntityRepository $er) {
                                                 return $er->createQueryBuilder('a')
                                                     ->join('a.produits', 'p')
                                                     ->where('p.code= :type')->setParameter('type','SHT')
                                                     ->orderBy('a.libelle', 'ASC');
                                             },
                                             'required'      => false,
                                             'empty_value'   => 'Tarif passager',
                                             'empty_data'    => null
            ));
    }

    public function getName()
    {
        return 'GenererTarifsHotelsType';
    }

}
