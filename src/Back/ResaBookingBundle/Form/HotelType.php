<?php

namespace Back\ResaBookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class HotelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idResa',null,array(
                'disabled' => true)
            )
            ->add('libelleResa',null,array(
                'disabled' => true)
            )
            ->add('region',null,array(
                'disabled' => true)
            )
            ->add('categorie',null,array(
                'disabled' => true)
            )
            ->add('hotel', 'entity', array('class' => 'BackHotelTunisieBundle:Hotel',
                'query_builder' => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('h')
                        ->join('h.ville', "v")
                        ->join('v.pays', "p")
                        ->where('p.code=:code')->setParameter('code', 'tn')
                        ->andWhere('h.etat=:etat')->setParameter('etat', TRUE)
                        ->orderBy("h.libelle", 'asc');
                },
                'required' => true,
                'empty_value' => 'Tous les Hôtels en tunisie',
                'empty_data' => null
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\ResaBookingBundle\Entity\Hotel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_resabookingbundle_hotel';
    }
}


