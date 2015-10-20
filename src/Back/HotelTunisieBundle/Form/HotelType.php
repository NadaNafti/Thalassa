<?php

namespace Back\HotelTunisieBundle\Form;

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
            ->add('libelle')
            ->add('checkIn')
            ->add('checkOut')
            ->add('email1')
            ->add('email2')
            ->add('tel1')
            ->add('tel2')
            ->add('longitude')
            ->add('latitude')
            ->add('adresse', 'text')
            ->add('descriptionCourte')
            ->add('tripAdvisor')
            ->add('shortTripAdvisor')
            ->add('descriptionLongue', 'ckeditor')
            ->add('chaine')
            ->add('fournisseur')
            ->add('ville', 'entity', array(
                'class'         => 'BackHotelTunisieBundle:Ville',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->join('u.pays', 'p')
                        ->where('p.code= :code')->setParameter(':code', 'tn')
                        ->orderBy('u.libelle', 'ASC');
                },
                'required'      => true,
                'empty_value'   => 'Tous les villes en tunisie',
                'empty_data'    => null
            ))
            ->add('categorie')
            ->add('tags')
            ->add('chambres', 'entity', array(
                'class'    => 'BackHotelTunisieBundle:Chambre',
                'multiple' => true,
                'property' => 'getLongName'
            ))
            ->add('options')
            ->add('localisations')
            ->add('themes')
            ->add('arrangements')
            ->add('amenagements')
            ->add('vues');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\Hotel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_hotel';
    }
}
