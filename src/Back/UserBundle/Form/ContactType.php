<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nomPrenom')
                ->add('titreCivilite', 'choice', array(
                    'choices' => array(
                        1 => 'Madame',
                        2 => 'Monsieur',
                        3 => 'Mademoiselle',
                        4 => 'Maître',
                        5 => 'Docteur'
                    ), 'required' => true,
                    'empty_value' => 'choisir titre de civilité'))
                ->add('fonction')
                ->add('email')
                ->add('telPro')
                ->add('telPerso')
                ->add('fax')
                ->add('adresse')
                ->add('codePostal')
                ->add('ville')
                ->add('gouvernorat')
                ->add('dateNaissance','date', array(
                    'required' => FALSE,
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('pays')
                ->add('client', 'entity', array(
                    'class' => 'BackUserBundle:Client',
                    'required' => true,
                    'empty_value' => 'choisir client',
                    'empty_data' => null
                ))
                ->add('fournisseur', 'entity', array(
                    'class' => 'BackUserBundle:Fournisseur',
                    'required' => true,
                    'empty_value' => 'choisir fournisseur',
                    'empty_data' => null
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Back\UserBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'back_userbundle_contact';
    }

}
