<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pointVente')
                ->add('groups', 'entity', array(
                    'class'   =>'Back\UserBundle\Entity\Group',
                    'required'=>true,
                    'expanded'=>true,
                    'multiple'=>true
                ))
                ->add("Enregistrer", "submit",array('attr'=>array('class'=>'btn btn-green btn-block')));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'acme_user_registration';
    }

}
