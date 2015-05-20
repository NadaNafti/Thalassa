<?php

namespace Back\HotelTunisieBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class NamesExtension extends \Twig_Extension
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em=$em;
    }

    public function getFunctions()
    {
        return array(
            'getNameChambre'=>new \Twig_Function_Method($this, 'getNameChambre'),
        );
    }

    public function getNameChambre($id)
    {
        $chambre=$this->em->getRepository("BackHotelTunisieBundle:Chambre")->find($id);
        return $chambre->getLibelle();
    }


    public function getName()
    {
        return 'NamesExtension';
    }

}
