<?php

namespace Back\VoyageOrganiseBundle\Twig\Extension;

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
            'getNameSuppPack' => new \Twig_Function_Method($this, 'getNameSuppPack'),
        );
    }

    public function getNameSuppPack($id)
    {
        $supp = $this->em->getRepository("BackVoyageOrganiseBundle:Ligne")->find($id);
        return $supp->getLibelle();
    }


    public function getName()
    {
        return 'NamesExtensionVO';
    }

}
