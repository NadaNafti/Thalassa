<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Range;

class NewReservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('villes', 'entity', array('class'         => 'BackHotelTunisieBundle:Ville',
                                            'query_builder' => function (EntityRepository $er) {
                                                return $er->createQueryBuilder('u')
                                                    ->join('u.pays', 'p')
                                                    ->where('p.code= :code')->setParameter(':code', 'tn')
                                                    ->orderBy('u.libelle', 'ASC');
                                            },
                                            'required'      => false,
                                            'empty_value'   => 'Villes en tunisie',
                                            'empty_data'    => null
            ))
            ->add('categories', 'entity', array('class'         => 'BackHotelTunisieBundle:Categorie',
                                            'query_builder' => function (EntityRepository $er) {
                                                return $er->createQueryBuilder('c')
                                                    ->orderBy('c.libelle', 'ASC');
                                            },
                                            'required'      => false,
                                            'empty_value'   => 'Catégories',
                                            'empty_data'    => null
            ))
            ->add('client', 'entity', array('class'         => 'BackUserBundle:Client',
                                            'query_builder' => function (EntityRepository $er) {
                                                return $er->createQueryBuilder('u')
                                                    ->orderBy('u.nomPrenom', 'ASC');
                                            },
                                            'required'      => true,
                                            'empty_value'   => 'Liste des clients',
                                            'empty_data'    => null,
                                            'property'      => 'getLongName'
            ))
            ->add('hotels', 'entity', array('class'         => 'BackHotelTunisieBundle:Hotel',
                                            'query_builder' => function (EntityRepository $er) {
                                                return $er->createQueryBuilder('h')
                                                    ->where('h.etat = 1')
                                                    ->andWhere('h.saisonBase is not null')
                                                    ->orderBy('h.libelle', 'ASC');
                                            },
                                            'required'      => true,
                                            'empty_value'   => 'Liste des hôtels',
                                            'empty_data'    => null
            ))
            ->add('dateDebut', 'date', array(
                'required' => true,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',
            ))
            ->add('nuitees', 'integer', array(
                'constraints' => new Range(array('min' => 1, 'max' => 20))
            ));
    }

    public function getName()
    {
        return 'NewReservationType';
    }

}
