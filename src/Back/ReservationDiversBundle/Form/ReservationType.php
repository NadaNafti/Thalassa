<?php

namespace Back\ReservationDiversBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('remise')
            ->add('lignes', 'collection', array(
                'type'         => new ReservationLigneType(),
                'allow_add'    => true,
                'by_reference' => true,
            ));;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\ReservationDiversBundle\Entity\Reservation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_reservationdiversbundle_reservation';
    }
}
