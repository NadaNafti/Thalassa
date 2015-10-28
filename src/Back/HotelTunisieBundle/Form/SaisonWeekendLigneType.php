<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SaisonWeekendLigneType extends AbstractType
{

    public $idHotel;
    public function __construct($id=null)
    {
        $this->idHotel=$id;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chambre')
            ->add('valeur')
            ->add('valeurPour','checkbox',array(
                'label'=>"En Pourcentage",
                'required'=>false
            ))
        ;
        if (is_null($this->idHotel))
            $builder->add('chambre');
        else {
            $id = $this->idHotel;
            $builder->add("chambre", "entity", array(
                    'class'         => 'BackHotelTunisieBundle:Chambre',
                    'query_builder' => function (EntityRepository $er) use ($id) {
                        return $er->createQueryBuilder('a')
                            ->join("a.hotels", "h")->where('h.id = :id')->setParameter('id', $id);
                    }
                , 'multiple'        => false,
                    'expanded'      => FALSE,)
            );
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonWeekendLigne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonweekendligne';
    }
}
