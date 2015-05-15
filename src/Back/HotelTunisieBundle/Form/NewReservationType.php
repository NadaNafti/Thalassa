<?php

namespace Back\HotelTunisieBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface ;
use Symfony\Component\OptionsResolver\OptionsResolverInterface ;
use Doctrine\ORM\EntityRepository ;
use Symfony\Component\Validator\Constraints\Range ;

class NewReservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder , array $options)
    {
        $builder
                ->add('villes' , 'entity' , array ('class' => 'BackHotelTunisieBundle:Ville' ,
                    'query_builder' => function(EntityRepository $er)
            {
                return $er->createQueryBuilder('u')
                        ->orderBy('u.libelle' , 'ASC') ;
            } ,
                    'required' => false ,
                    'empty_value' => 'Tous les villes' ,
                    'empty_data' => null
                ))
                ->add('client' , 'entity' , array ('class' => 'BackUserBundle:Client' ,
                    'query_builder' => function(EntityRepository $er)
            {
                return $er->createQueryBuilder('u')
                        ->orderBy('u.nomPrenom' , 'ASC') ;
            } ,
                    'required' => true
                ))
                ->add('hotels' , 'entity' , array ('class' => 'BackHotelTunisieBundle:Hotel'))
                ->add('dateDebut' , 'date' , array (
                    'required' => false ,
                    'widget' => 'single_text' ,
                    'format' => 'yyyy-MM-dd' ,
                ))
                ->add('nuitees' , 'integer' , array (
                    'constraints' => new Range(array ('min' => 1 , 'max' => 20))
                ))
        ;
    }

    public function getName()
    {
        return 'NewReservationType' ;
    }

}
