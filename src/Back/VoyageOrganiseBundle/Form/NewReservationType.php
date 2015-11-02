<?php

namespace Back\VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Range;

class NewReservationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('voyages', 'entity', array('class' => 'BackVoyageOrganiseBundle:VoyageOrganise',
                    'required' => false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('v')
                                ->orderBy('v.libelle', 'ASC');
                    },
                    'empty_value' => 'Liste des voyages',
                ))
                ->add('periodes', 'choice', array(
                    'required' => false,
                    'empty_value' => 'Liste des périodes',
                ))
                ->add('packs', 'entity', array('class' => 'BackVoyageOrganiseBundle:Pack',
//                    'choices' => array(),
                    'required' => true,
                    'empty_value' => 'Liste des packs',
                ))
                ->add('client', 'entity', array('class' => 'BackUserBundle:Client',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->orderBy('u.nomPrenom', 'ASC');
                    },
                    'required' => true,
                    'empty_value' => 'Liste des clients',
                    'property' => 'getLongName'
        ));
    }

    public function getName() {
        return 'NewReservationType';
    }

}
