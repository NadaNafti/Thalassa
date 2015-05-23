<?php

namespace Back\HotelTunisieBundle\Services ;

use Doctrine\ORM\EntityManager ;
use Symfony\Component\HttpFoundation\Session\Session ;
use Symfony\Component\DependencyInjection\Container ;
use Back\HotelTunisieBundle\Entity\Saison ;

class Lignes
{

    public function __construct(EntityManager $em , Session $session , Container $container)
    {
        $this->em = $em ;
        $this->session = $session ;
        $this->container = $container ;
    }

    public function lignePrixBase(Saison $saison)
    {
        return array (
            'type' => 'prixBase' ,
            'achat' => $saison->prixBaseAchat() ,
            'vente' => $saison->prixBaseVente() ,
                ) ;
    }

    public function ligneArrangement(Saison $saison , $arr)
    {
        if ($saison->getArrBase()->getId() == $arr)
            return array ('type' => 'Arrangement ' . $saison->getArrBase()->getLibelle() , 'achat' => 0 , 'vente' => 0) ;
        else
        {
            foreach ($saison->getArrangements() as $arrangement)
            {
                if ($arrangement->getArrangement()->getId())
                    return array (
                        'type' => 'Arrangement ' . $arrangement->getArrangement()->getLibelle() ,
                        'achat' => $arrangement->getReducSuppAchat() ,
                        'vente' => $arrangement->getReducSuppVente() ,
                            ) ;
            }
        }
    }

    public function ligneChambre(Saison $saison , $id)
    {
        $chambre = $this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($id) ;
        if ($chambre->getType() == 2)
            return array ('type' => 'Chambre double' , 'achat' => 0 , 'vente' => 0) ;
        if ($chambre->getType() == 1)
            return array ('type' => 'Supp single' , 'achat' => $saison->getSaisonSupp()->getSuppSingleAchat() , 'vente' => $saison->getSaisonSupp()->getSuppSingleVente()) ;
        if ($chambre->getType() == 3)
            return array (
                'type' => 'Reduc/Supp 3eme lit' ,
                'achat' => $saison->getSaisonSupp()->getSupp3LitAchat() + $saison->getSaisonReduc()->getReduc3LitAchat() ,
                'vente' => $saison->getSaisonSupp()->getSupp3LitVente() + $saison->getSaisonReduc()->getReduc3LitVente() ,
                    ) ;
        if ($chambre->getType() == 4)
            return array (
                'type' => 'Reduc/Supp 4eme lit' ,
                'achat' => $saison->getSaisonSupp()->getSupp4LitAchat() + $saison->getSaisonReduc()->getReduc4LitAchat() ,
                'vente' => $saison->getSaisonSupp()->getSupp4LitVente() + $saison->getSaisonReduc()->getReduc4LitVente() ,
                    ) ;
        if ($chambre->getType() == 0)
        {
            foreach ($saison->getSuppChambres() as $ch)
            {
                if($ch->getChambre()->getId()==$id)
                    return array ('type' => 'Supp '.$ch->getChambre()->getLibelle() , 'achat' => $ch->getSuppAchat() , 'vente' => $ch->getSuppVente()) ;
            }
        }
    }

}
