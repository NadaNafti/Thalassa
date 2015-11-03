<?php

namespace Back\CommercialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PieceType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('numero','text', array('required' => false))
                ->add('modeReglement', 'choice', array('choices' => array(
                        'AD' => 'Autorisation de débit',
                        'PC' => 'Pris en charge',
                        'CB' => 'Carte Bancaire',
                        'C' => 'Chèque',
                        'E' => 'Espèce',
                        'V' => 'Virement',
                    ),
                    'required' => false
                ))
                ->add('dateEcheance', 'date', array(
                    'required' => false,
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'required' => false
                ))
                ->add('montantOrigine','text', array('required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\CommercialBundle\Entity\Piece'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_commercialbundle_piece';
    }

}
