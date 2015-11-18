<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Range;

class ReportingNombreReservationType extends AbstractType
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
//            ->add('type', 'choice', array(
//                'choices' => array(
//                    "hotel"     => "Hôtel",
//                    "region"    => "Région",
//                    "operateur" => "Opérateur",
//                    "source"    => "Source",
//                    "client"    => "Client",
//                    "amicale"   => "Amicale",
//                ),
//                'data'    => 'hotel',
//            ))
            ->add('hotels', 'entity', array('class'         => 'BackHotelTunisieBundle:Hotel',
                                            'query_builder' => function (EntityRepository $er) {
                                                return $er->createQueryBuilder('h')
                                                    ->join('h.ville', 'v')
                                                    ->join('v.pays', 'p')
                                                    ->where('p.code = :code')->setParameter('code', 'tn')
                                                    ->orderBy('h.libelle', 'ASC');
                                            },
                                            'required'      => false,
                                            'multiple'      => true,
                                            'empty_value'   => 'Tous les hôtels',
                                            'empty_data'    => null
            ))
            ->add('regions', 'entity', array('class'         => 'BackHotelTunisieBundle:Region',
                                             'query_builder' => function (EntityRepository $er) {
                                                 return $er->createQueryBuilder('r')
                                                     ->join('r.villes', 'v')
                                                     ->join('v.pays', 'p')
                                                     ->where('p.code = :code')->setParameter('code', 'tn')
                                                     ->orderBy('r.libelle', 'ASC');
                                             },
                                             'required'      => false,
                                             'multiple'      => true,
                                             'empty_value'   => 'Tous les hôtels',
                                             'empty_data'    => null
            ))
            ->add('users', 'entity', array('class'         => 'BackUserBundle:User',
                                           'query_builder' => function (EntityRepository $er) {
                                               $qb = $er->createQueryBuilder('u');
                                               return $qb
                                                   ->leftJoin('u.groups', 'g')
                                                   ->where($qb->expr()->orX(
                                                       $qb->expr()->like('u.roles', ':roles'),
                                                       $qb->expr()->like('g.roles', ':roles')
                                                   ))
                                                   ->setParameter('roles', '%"ROLE_ADMIN"%');
                                           },
                                           'required'      => false,
                                           'multiple'      => true,
                                           'empty_value'   => 'Tous les hôtels',
                                           'empty_data'    => null
            ));
    }

    public function getName()
    {
        return 'ReportingNombreReservationType';
    }

}
