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
                ->add('titreCivilite', 'choice', array(
                    'choices' => array(
                        1 => 'Madame',
                        2 => 'Monsieur',
                        3 => 'Mademoiselle',
                        4 => 'Maître',
                        5 => 'Docteur'
            )))
                ->add('fonction')
                ->add('email')
                ->add('telPro')
                ->add('telPerso')
                ->add('fax')
                ->add('adresse')
                ->add('codePostal')
                ->add('ville')
                ->add('gouvernorat')
                ->add('dateNaissance')
                ->add('pays')
                ->add('client')
                ->add('fournisseur')
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
