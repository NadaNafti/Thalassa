<?php

namespace Back\TransfertBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransfertReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('commentaire')

            ->add('organisme','choice',array(
                'choices'=>array(
                    1=>"Particulier",
                    2=>"Société",
                    3=>"Etablissement",
                    4=>"Autres",
                    )
                )
            )

            ->add('departDe','choice', array(
                'choices'=> array(
                    0=>"",
                    1=>"Ain Draham",
                    2=>"Bizerte",
                    3=>"Côtes de Carthage",
                    4=>"Djerba",
                    5=>"Douz",
                    6=>"Gabes",
                    7=>"Gafsas",
                    8=>"Hammamet",
                    9=>"Kebili",
                    10=>"Kelibia",
                    11=>"Korba",
                    12=>"Korbous",
                    13=>"Ksar Ghilane",
                    14=>"Mahdia",
                    15=>"Matmata",
                    16=>"Monastir",
                    17=>"Nabeul",
                    18=>"Nefta",
                    19=>"Sfax",
                    20=>"Sousse",
                    21=>"Tabarka",
                    22=>"Tamerza",
                    23=>"Tataouine",
                    24=>"Tozeur",
                    25=>"Tunis ville",
                    26=>"Zarzis",
                )
            ))

            ->add('heureDepart','time', array(
                'input'  => 'timestamp',
                'widget' => 'single_text',
                ))

            ->add('dateDepart','date',array(
                'required' => FALSE,
                'widget'   => 'single_text',
                'format'   => 'yyyy-MM-dd',)
            )

            ->add('arriveeA','choice', array(
                'choices'=> array(
                    0=>"",
                    1=>"Ain Draham",
                    2=>"Bizerte",
                    3=>"Côtes de Carthage",
                    4=>"Djerba",
                    5=>"Douz",
                    6=>"Gabes",
                    7=>"Gafsas",
                    8=>"Hammamet",
                    9=>"Kebili",
                    10=>"Kelibia",
                    11=>"Korba",
                    12=>"Korbous",
                    13=>"Ksar Ghilane",
                    14=>"Mahdia",
                    15=>"Matmata",
                    16=>"Monastir",
                    17=>"Nabeul",
                    18=>"Nefta",
                    19=>"Sfax",
                    20=>"Sousse",
                    21=>"Tabarka",
                    22=>"Tamerza",
                    23=>"Tataouine",
                    24=>"Tozeur",
                    25=>"Tunis ville",
                    26=>"Zarzis",
                )
            ))

            ->add('heureArrivee','time', array(
                'input'  => 'timestamp',
                'widget' => 'single_text',
            ))

            ->add('dateArrivee','date',array(
                    'required' => FALSE,
                    'widget'   => 'single_text',
                    'format'   => 'yyyy-MM-dd',)
            )

            ->add('pointDepartArrivee','choice', array(
                'choices'=> array(
                      1 => 'Aéroport',
                      2 => 'Hôtel',
                      3 => 'Autres',
                )
            ))

            ->add('nomPrenom')

            ->add('tel')

            ->add('email')

            ->add('lignes', 'collection', array(
                'type' => new TransfertReservationLigneType(),
                'allow_add' => true,
                'by_reference' => true,
            ));
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\TransfertBundle\Entity\TransfertReservation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_transfertbundle_transfertreservation';
    }
}
