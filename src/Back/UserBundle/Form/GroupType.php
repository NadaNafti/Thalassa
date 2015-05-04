<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupType extends AbstractType
{

    public function getParent()
    {
        return 'fos_user_group';
    }

    public function getName()
    {
        return 'back_group';
    }

}
