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
            'getNameArrangement'=>new \Twig_Function_Method($this, 'getNameArrangement'),
            'getNameVue'=>new \Twig_Function_Method($this, 'getNameVue'),
            'getNameSupp'=>new \Twig_Function_Method($this, 'getNameSupp'),
        );
    }

    public function getNameChambre($id)
    {
        $chambre=$this->em->getRepository("BackHotelTunisieBundle:Chambre")->find($id);
        return $chambre->getLibelle();
    }
    
    public function getNameArrangement($id)
    {
        $arrangement=$this->em->getRepository("BackHotelTunisieBundle:Arrangement")->find($id);
        return $arrangement->getLibelle();
    }
    public function getNameVue($id)
    {
        $arrangement=$this->em->getRepository("BackHotelTunisieBundle:Vue")->find($id);
        return $arrangement->getLibelle();
    }
    public function getNameSupp($id)
    {
        $arrangement=$this->em->getRepository("BackHotelTunisieBundle:Supplement")->find($id);
        return $arrangement->getLibelle();
    }


    public function getName()
    {
        return 'NamesExtension';
    }

}
