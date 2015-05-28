<?php

namespace Back\HotelTunisieBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\HotelTunisieBundle\Entity\Saison;

class Lignes
{

    public function __construct(EntityManager $em, Session $session, Container $container)
    {
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
    }

    public function lignePrixBase(Saison $saison)
    {
        return array(
            'Code' => 'PB',
            'name' => 'prixBase',
            'achat' => $saison->prixBaseAchat(),
            'vente' => $saison->prixBaseVente(),
        );
    }

    public function ligneArrangement(Saison $saison, $arr)
    {
        if ($saison->getArrBase()->getId() != $arr)
        {
            foreach ($saison->getArrangements() as $arrangement)
            {
                if ($arrangement->getArrangement()->getId())
                    return array(
                        'Code' => 'ARR',
                        'type' => 'Arrangement ' . $arrangement->getArrangement()->getLibelle(),
                        'achat' => $arrangement->getReducSuppAchat(),
                        'vente' => $arrangement->getReducSuppVente(),
                    );
            }
        }
    }

    public function ligneSuppSingle(Saison $saison, $id)
    {
        $chambre = $this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($id);
        if ($chambre->getType() == 1)
            return array(
                'Code' => 'SUPP-SINGLE',
                'type' => 'Supp single',
                'achat' => $saison->getSaisonSupp()->getSuppSingleAchat(),
                'vente' => $saison->getSaisonSupp()->getSuppSingleVente()
            );
    }

    public function ligneSuppReduc3Lit(Saison $saison, $k)
    {
        if ($k == 3)
            return array(
                'Code' => 'SUPP-REDUC-3LIT',
                'type' => 'Reduc ou Supp 3eme lit',
                'achat' => $saison->getSaisonSupp()->getSupp3LitAchat() + $saison->getSaisonReduc()->getReduc3LitAchat(),
                'vente' => $saison->getSaisonSupp()->getSupp3LitVente() + $saison->getSaisonReduc()->getReduc3LitVente(),
            );
    }

    public function ligneSuppReduc4Lit(Saison $saison, $k)
    {
        if ($k == 4)
            return array(
                'Code' => 'SUPP-REDUC-4LIT',
                'type' => 'Reduc ou Supp 4eme lit',
                'achat' => $saison->getSaisonSupp()->getSupp4LitAchat() + $saison->getSaisonReduc()->getReduc4LitAchat(),
                'vente' => $saison->getSaisonSupp()->getSupp4LitVente() + $saison->getSaisonReduc()->getReduc4LitVente(),
            );
    }

    public function ligneSuppAutreChambre(Saison $saison, $id)
    {
        $chambre = $this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($id);
        if ($chambre->getType() == 0)
        {
            foreach ($saison->getSuppChambres() as $ch)
            {
                if ($ch->getChambre()->getId() == $id)
                    return array(
                        'Code' => 'SUPP-AUTRE-CHAMBRE',
                        'type' => 'Supp ' . $ch->getChambre()->getLibelle(),
                        'achat' => $ch->getSuppAchat(),
                        'vente' => $ch->getSuppVente()
                    );
            }
        }
    }

    public function ligneSuppVue(Saison $saison, $id)
    {
        foreach ($saison->getVues() as $vue)
        {
            if ($vue->getVue()->getId() == $id)
                return array(
                    'Code' => 'SUPP-VUE',
                    'type' => 'Supp ' . $vue->getVue()->getLibelle(),
                    'achat' => $vue->getSuppAchat(),
                    'vente' => $vue->getSuppVente()
                );
        }
    }

    public function ligneSuppWeekend(Saison $saison, $ch, $date)
    {
        $saisonWeekend = $saison->getSaisonWeekend();
        if (!is_null($saisonWeekend))
        {
            $date = \DateTime::createFromFormat('Y-m-d', $date);
            if (($date->format("w") == 5 && $saisonWeekend->getVendredi()) || ($date->format("w") == 6 && $saisonWeekend->getSamedi()) || ($date->format("w") == 0 && $saisonWeekend->getDimanche()))
            {
                foreach ($saisonWeekend->getChambres() as $chambre)
                {
                    if ($ch == $chambre->getId())
                    {
                        return array(
                            'Code' => 'SUPP-REDUC-WEEKEND',
                            'type' => 'Supp ou reduction Weekend '.$date->format("l"),
                            'achat' => $saisonWeekend->getReducSuppAchat(),
                            'vente' => $saisonWeekend->getReducSuppVente()
                        );
                    }
                }
            }
        }
    }

}
