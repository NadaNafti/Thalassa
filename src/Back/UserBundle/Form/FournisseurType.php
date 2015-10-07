<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FournisseurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('type', 'choice', array(
                    'required' => true,
                    'expanded' => true,
                    'choices' => array(
                        1 => 'Société/Association',
                        2 => 'Individu privé'
            )))
            ->add('nomAlternatif')
            ->add('tel1')
            ->add('tel2')
            ->add('fax')
            ->add('email')
            ->add('siteWeb')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('gouvernorat')
            ->add('pays')
            ->add('matriculeFiscale')
            ->add('registreCommercie')
            ->add('codeDouane')
            ->add('tva', 'checkbox', array(
                    'label' => 'Assujetti à la tva',
                    'required'=>false
                ))
            ->add('formeJuridique', 'choice', array(
                    'required' => true,
                    'choices' => array(
                        1 => "Groupe de sociétés",
                        2 => "Groupement d'intérêt économique (GEI)",
                        3 => "Société anonyme (SA)",
                        4 => "Société Unipersonnelle à Responsabilité Limitée (SUARL)",
                        5 => "Société en Commandite Simple (SCS)",
                        6 => "Société en Nom Collectif (SNC)",
                        7 => "Société à Responsabilité Limitée (SARL)",
                        8 => "Société en participation"
            )))
                ->add('file', 'file', array('required' => TRUE))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\UserBundle\Entity\Fournisseur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_userbundle_fournisseur';
    }
}
