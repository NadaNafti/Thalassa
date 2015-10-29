<?php

namespace Back\HotelTunisieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SaisonVueType extends AbstractType
{

    public $idHotel;

    public function __construct($id = null)
    {
        $this->idHotel = $id;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etat', 'checkbox', array(
                'label'    => ' ',
                'required' => false,
                'attr'     => array('style' => 'margin-top:-15px;')
            ))
            ->add('valeur')
            ->add('valeurPour', 'checkbox', array(
                'label'    => 'En pourcentage',
                'required' => false
            ))
            ->add('marge')
            ->add('margePour', 'checkbox', array(
                'label'    => 'En pourcentage',
                'required' => false
            ))
            ->add('vue');
            if (is_null($this->idHotel))
                $builder->add('removedChambres');
            else {
                $id = $this->idHotel;
                $builder->add("removedChambres", "entity", array(
                        'class'         => 'BackHotelTunisieBundle:Chambre',
                        'query_builder' => function (EntityRepository $er) use ($id) {
                            return $er->createQueryBuilder('a')
                                ->join("a.hotels", "h")->where('h.id = :id')->setParameter('id', $id);
                        }
                    , 'multiple'        => TRUE,
                        'expanded'      => FALSE,
                        'required'=>false
                        )
                );
            }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\HotelTunisieBundle\Entity\SaisonVue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_hoteltunisiebundle_saisonvue';
    }

}
