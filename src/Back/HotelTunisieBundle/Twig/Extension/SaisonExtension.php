<?php

namespace Back\HotelTunisieBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Back\HotelTunisieBundle\Entity\SaisonAutreSupp;

class SaisonExtension extends \Twig_Extension
{

    protected $em;
    protected $container;

    public function __construct(EntityManager $em,Container $container)
    {
        $this->em=$em;
        $this->container=$container;
    }

    public function getFunctions()
    {
        return array(
            'verifSuppReducDate'=>new \Twig_Function_Method($this, 'verifSuppReducDate'),
        );
    }

    public function verifSuppReducDate($suppReduc,$date1,$date2)
    {
        $dates=$this->container->get('Library')->getDatesBetween($date1->format('Y-m-d') , $date2->format('Y-m-d'));
        $dates2=$this->container->get('Library')->getDatesBetween($date1->format('Y').'-'.$suppReduc->getMoisDebut().'-'.$suppReduc->getJourDebut(),$date1->format('Y').'-'.$suppReduc->getMoisFin().'-'.$suppReduc->getJourFin());
        foreach($dates as $date)
        {
            foreach($dates2 as $date2)
            {
                if($date==$date2)
                    return true;
            }
        }
        return false;
    }



    public function getName()
    {
        return 'FunctionExtension';
    }

}
