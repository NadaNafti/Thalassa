<?php

namespace Back\ProgrammeBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class NamesExtension extends \Twig_Extension
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            'getNameSuppPR' => new \Twig_Function_Method($this, 'getNameSuppPR'),
        );
    }

    public function getNameSuppPR($id)
    {
        $supp = $this->em->find('BackProgrammeBundle:Ligne',$id);
        return $supp->getLibelle();
    }


    public function getName()
    {
        return 'NamesExtensionPR';
    }

}
