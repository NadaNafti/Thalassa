<?php

namespace Back\HotelTunisieBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\HotelTunisieBundle\Entity\Saison;
use Back\HotelTunisieBundle\Entity\SaisonAutreSupp;
use Back\HotelTunisieBundle\Entity\SaisonAutreReduc;

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
            'code' => 'PRIX-BASE',
            'name' => 'Prix de Base (' . $saison->getArrBase()->getLibelle() . ', Chambre double)',
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
                if ($arrangement->getArrangement()->getId() == $arr)
                    return array(
                        'code' => 'ARRANGEMENT',
                        'name' => 'Arrangement ' . $arrangement->getArrangement()->getLibelle(),
                        'achat' => $arrangement->getReducSuppAchat(),
                        'vente' => $arrangement->getReducSuppVente(),
                    );
            }
        }
    }

    public function ligneSuppSingle(Saison $saison, $arr, $ch, $nbrAdulte, $nbrEnfant, $type)
    {
        $chambre = $this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($ch);
        if (( $type == 'enfant' && $saison->getSaisonSupp()->getSuppSingleEnfant() && $nbrAdulte == 0 && $nbrEnfant == 1 ) || ( $type == 'adulte' && ( ($nbrAdulte == 1 && $nbrEnfant==0) || ( /*$chambre->getType() == 2 &&*/ $nbrEnfant == 1 && $nbrAdulte == 1 && $saison->getHotel()->getFicheTechnique()->getSuppSingle1Adulte1EnfantChDouble()) || ( /*$chambre->getType() == 3 &&*/ $nbrEnfant == 2 && $nbrAdulte == 1 && $saison->getHotel()->getFicheTechnique()->getSuppSingle1Adulte2EnfantChDouble())) ))
            return array(
                'code' => 'SUPP-SINGLE',
                'name' => 'Supp single',
                'achat' => $saison->getSaisonSupp()->getSuppSingleAchat($arr),
                'vente' => $saison->getSaisonSupp()->getSuppSingleVente($arr)
            );
    }

    public function ligneSuppReduc3Lit(Saison $saison, $arr, $k)
    {
        if ($k == 3)
            return array(
                'code' => 'SUPP-REDUC-3LIT',
                'name' => 'Reduc ou Supp 3eme lit',
                'achat' => $saison->getSaisonSupp()->getSupp3LitAchat($arr) + $saison->getSaisonReduc()->getReduc3LitAchat($arr),
                'vente' => $saison->getSaisonSupp()->getSupp3LitVente($arr) + $saison->getSaisonReduc()->getReduc3LitVente($arr),
            );
    }

    public function ligneSuppReduc4Lit(Saison $saison, $arr, $k)
    {
        if ($k == 4)
            return array(
                'code' => 'SUPP-REDUC-4LIT',
                'name' => 'Reduc ou Supp 4eme lit',
                'achat' => $saison->getSaisonSupp()->getSupp4LitAchat($arr) + $saison->getSaisonReduc()->getReduc4LitAchat($arr),
                'vente' => $saison->getSaisonSupp()->getSupp4LitVente($arr) + $saison->getSaisonReduc()->getReduc4LitVente($arr),
            );
    }

    public function ligneSuppAutreChambre(Saison $saison, $arr, $id)
    {
        $chambre = $this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($id);
        if ($chambre->getType() == 0)
        {
            foreach ($saison->getSuppChambres() as $ch)
            {
                if ($ch->getChambre()->getId() == $id)
                    return array(
                        'code' => 'SUPP-AUTRE-CHAMBRE',
                        'name' => 'Supp ' . $ch->getChambre()->getLibelle(),
                        'achat' => $ch->getSuppAchat($arr),
                        'vente' => $ch->getSuppVente($arr)
                    );
            }
        }
    }

    public function ligneSuppVue(Saison $saison, $arr, $id)
    {
        foreach ($saison->getVues() as $vue)
        {
            if ($vue->getVue()->getId() == $id)
                return array(
                    'code' => 'SUPP-VUE',
                    'name' => 'Supp ' . $vue->getVue()->getLibelle(),
                    'achat' => $vue->getSuppAchat($arr),
                    'vente' => $vue->getSuppVente($arr)
                );
        }
    }

    public function ligneSuppVueEnfant(Saison $saison, $arr, $ordre, $nbrAdulte, $age, $id)
    {
        $ligneVue = $this->ligneSuppVue($saison, $arr, $id);
        if (!is_null($ligneVue))
        {
            $reducAchat=$saison->getSaisonReduc()->getReductionEnfantAchat($ligneVue['achat'], $ordre, $nbrAdulte, $age);
            $reducVente=$saison->getSaisonReduc()->getReductionEnfantVente($ligneVue['vente'], $ordre, $nbrAdulte, $age);
            return array(
                'code' => 'SUPP-VUE-ENF',
                'name' => $ligneVue['name'],
                'achat' => $ligneVue['achat']+$reducAchat,
                'vente' => $ligneVue['vente']+$reducVente
            );
        }
    }

    public function ligneSuppWeekend(Saison $saison, $arr, $ch, $date, $nuitee)
    {
        $saisonWeekend = $saison->getSaisonWeekend();
        if (!is_null($saisonWeekend))
        {
            $date = \DateTime::createFromFormat('Y-m-d', $date);
            if ($nuitee >= $saisonWeekend->getNbNuitMin() && $nuitee <= $saisonWeekend->getNbNuitMax() && ($date->format("w") == 5 && $saisonWeekend->getVendredi()) || ($date->format("w") == 6 && $saisonWeekend->getSamedi()) || ($date->format("w") == 0 && $saisonWeekend->getDimanche()))
            {
                foreach ($saisonWeekend->getChambres() as $chambre)
                {
                    if ($ch == $chambre->getId())
                    {
                        return array(
                            'code' => 'SUPP-REDUC-WEEKEND',
                            'name' => 'Supp ou reduction Weekend ' . $date->format("l"),
                            'achat' => $saisonWeekend->getReducSuppAchat($arr),
                            'vente' => $saisonWeekend->getReducSuppVente($arr)
                        );
                    }
                }
            }
        }
    }

    public function ligneReduc1Enf1Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age)
    {
        $minAge1 = $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant();
        $maxAge1 = $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant();
        $minAge2 = $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant();
        $maxAge2 = $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant();
        if ($ordre == 1 && $nbrAdulte == 1)
        {
            if ($age >= $minAge1 && $age <= $maxAge1)
                return array(
                    'code' => 'REDUC-1ENF-1ADULTE-AGE-1',
                    'name' => 'Réduction 1er enfant avec 1 adulte dans une même chambre  [' . $minAge1 . ',' . $maxAge1 . ']',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age1Vente($arr)
                );
            if ($age >= $minAge2 && $age <= $maxAge2)
                return array(
                    'code' => 'REDUC-1ENF-1ADULTE-AGE-2',
                    'name' => 'Réduction 1er enfant avec 1 adulte dans une même chambre   [' . $minAge2 . ',' . $maxAge2 . ']',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc1Enf2Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age)
    {
        $minAge1 = $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant();
        $maxAge1 = $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant();
        $minAge2 = $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant();
        $maxAge2 = $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant();
        if ($ordre == 1 && $nbrAdulte == 2)
        {
            if ($age >= $minAge1 && $age <= $maxAge1)
                return array(
                    'code' => 'REDUC-1ENF-2ADULTES-AGE-1',
                    'name' => 'Réduction 1er enfant avec 2 adultes dans une même chambre   [' . $minAge1 . ',' . $maxAge1 . ']',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age1Vente($arr)
                );
            if ($age >= $minAge2 && $age <= $maxAge2)
                return array(
                    'code' => 'REDUC-1ENF-2ADULTES-AGE-2',
                    'name' => 'Réduction 1er enfant avec 2 adultes dans une même chambre   [' . $minAge2 . ',' . $maxAge2 . ']',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age2Vente($arr)
                );
        }
    }

    public function ligneReduc1EnfSeparer(Saison $saison, $arr, $ordre, $nbrAdulte, $age)
    {
        $minAge1 = $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant();
        $maxAge1 = $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant();
        $minAge2 = $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant();
        $maxAge2 = $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant();
        if ($ordre == 1 && $nbrAdulte == 0)
        {
            if ($age >= $minAge1 && $age <= $maxAge1)
                return array(
                    'code' => 'REDUC-1ENF-SEPARER-AGE-1',
                    'name' => 'Réduction 1er enfant dans une chambre séparée [' . $minAge1 . ',' . $maxAge1 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age1Vente($arr)
                );
            if ($age >= $minAge2 && $age <= $maxAge2)
                return array(
                    'code' => 'REDUC-1ENF-SEPARER-AGE-2',
                    'name' => 'Réduction 1er enfant dans une chambre séparée   [' . $minAge2 . ',' . $maxAge2 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc2Enf1Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age)
    {
        $minAge1 = $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant();
        $maxAge1 = $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant();
        $minAge2 = $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant();
        $maxAge2 = $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant();
        if ($ordre > 1 && $nbrAdulte == 1)
        {
            if ($age >= $minAge1 && $age <= $maxAge1)
                return array(
                    'code' => 'REDUC-2ENF-1ADULTE-AGE-1',
                    'name' => 'Réduction 2eme enfant ou plus avec 1 adulte dans une même chambre [' . $minAge1 . ',' . $maxAge1 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age1Vente($arr)
                );
            if ($age >= $minAge2 && $age <= $maxAge2)
                return array(
                    'code' => 'REDUC-2ENF-1ADULTE-AGE-2',
                    'name' => 'Réduction 2eme enfant ou plus avec 1 adulte dans une même chambre   [' . $minAge2 . ',' . $maxAge2 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc2Enf2Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age)
    {
        $minAge1 = $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant();
        $maxAge1 = $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant();
        $minAge2 = $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant();
        $maxAge2 = $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant();
        if ($ordre > 1 && $nbrAdulte == 2)
        {
            if ($age >= $minAge1 && $age <= $maxAge1)
                return array(
                    'code' => 'REDUC-2ENF-2ADULTES-AGE-1',
                    'name' => 'Réduction 2eme enfant ou plus avec 2 adultes dans une même chambre [' . $minAge1 . ',' . $maxAge1 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age1Vente($arr)
                );
            if ($age >= $minAge2 && $age <= $maxAge2)
                return array(
                    'code' => 'REDUC-2ENF-2ADULTES-AGE-2',
                    'name' => 'Réduction 2eme enfant ou plus avec 2 adultes dans une même chambre   [' . $minAge2 . ',' . $maxAge2 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc2EnfSeparer(Saison $saison, $arr, $ordre, $nbrAdulte, $age)
    {
        $minAge1 = $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant();
        $maxAge1 = $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant();
        $minAge2 = $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant();
        $maxAge2 = $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant();
        if ($ordre > 1 && $nbrAdulte == 0)
        {
            if ($age >= $minAge1 && $age <= $maxAge1)
                return array(
                    'code' => 'REDUC-1ENF-SEPARER-AGE-1',
                    'name' => '2eme enfant ou plus dans une chambre séparée [' . $minAge1 . ',' . $maxAge1 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age1Vente($arr)
                );
            if ($age >= $minAge2 && $age <= $maxAge2)
                return array(
                    'code' => 'REDUC-2ENF-SEPARER-AGE-2',
                    'name' => '2eme enfant ou plus dans une chambre séparée  [' . $minAge2 . ',' . $maxAge2 . ']',
                    'achat' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age2Vente($arr)
                );
        }
    }

    public function ligneAutresSupplement(Saison $saison, $arr, $idSupp, $debutRes, $finRes)
    {
        $supplement = new SaisonAutreSupp();
        $date = \DateTime::createFromFormat('Y-m-d', $debutRes);
        foreach ($saison->getAutresSupplements() as $supplement)
        {
            if ($idSupp == $supplement->getSupp()->getId() && $supplement->getSupp()->getParChambre())
            {
                if ($supplement->getSupp()->getParNuit())
                    $x = $this->container->get('Library')->getNbrNuittes($debutRes, $finRes, $supplement->getSupp()->getDateDebut($date->format('Y')), $supplement->getSupp()->getDateFin($date->format('Y')));
                else
                    $x = 1;
                return array(
                    'code' => 'AUTRE-SUPP-CHAMBRE',
                    'name' => $supplement->getSupp()->__toString() . ' ( x ' . $x . ' nuitées )',
                    'achat' => number_format($supplement->getSuppAdulteAchat($arr) * $x, 3, '.', ''),
                    'vente' => number_format($supplement->getSuppAdulteVente($arr) * $x, 3, '.', ''),
                );
            }
        }
    }

    public function ligneAutresReduction(Saison $saison, $arr, $idReduc, $debutRes, $finRes)
    {
        $reduction = new SaisonAutreReduc();
        $date = \DateTime::createFromFormat('Y-m-d', $debutRes);
        foreach ($saison->getAutresReductions() as $reduction)
        {
            if ($idReduc == $reduction->getReduc()->getId() && $reduction->getReduc()->getParChambre())
            {
                if ($reduction->getReduc()->getParNuit())
                    $x = $this->container->get('Library')->getNbrNuittes($debutRes, $finRes, $reduction->getReduc()->getDateDebut($date->format('Y')), $reduction->getReduc()->getDateFin($date->format('Y')));
                else
                    $x = 1;
                return array(
                    'code' => 'AUTRE-REDUC-CHAMBRE',
                    'name' => $reduction->getReduc()->__toString() . ' ( x ' . $x . ' nuitées )',
                    'achat' => number_format($reduction->getSuppAdulteAchat($arr) * $x, 3, '.', ''),
                    'vente' => number_format($reduction->getSuppAdulteVente($arr) * $x, 3, '.', ''),
                );
            }
        }
    }

    public function ligneAutresSupplementParNuitees(Saison $saison, $arr, $type, $idSupp, $date, $ordre)
    {
        $supplement = new SaisonAutreSupp();
        $totalVente = 0;
        $totalAchat = 0;
        foreach ($saison->getAutresSupplements() as $supplement)
        {
            if ($idSupp == $supplement->getSupp()->getId() && !$supplement->getSupp()->getParChambre() && $this->container->get('Library')->verifIntersectionDate($date->format('Y-m-d'), $supplement->getSupp()->getDateDebut($date->format('Y')), $supplement->getSupp()->getDateFin($date->format('Y'))))
            {
                $verif = true;
                if ($type == 'adulte')
                {
                    $achat = $supplement->getSuppAdulteAchat($arr);
                    $vente = $supplement->getSuppAdulteVente($arr);
                }
                else
                {
                    $achat = $supplement->getSuppEnfantAchat($arr);
                    $vente = $supplement->getSuppEnfantVente($arr);
                }
                if (!$supplement->getSupp()->getParNuit() && ($ordre == 1 || $date->format('Y-m-d') == $supplement->getSupp()->getDateDebut($date->format('Y'))))
                    $verif = true;
                elseif (!$supplement->getSupp()->getParNuit())
                    $verif = false;
                if ($verif)
                    return array(
                        'code' => 'AUTRE-SUPP',
                        'name' => $supplement->getSupp()->__toString() . ' ' . $type,
                        'achat' => number_format($achat, 3, '.', ''),
                        'vente' => number_format($vente, 3, '.', ''),
                    );
            }
        }
    }

    public function ligneAutresReductionParNuitees(Saison $saison, $arr, $type, $idReduc, $date, $ordre)
    {
        $reduction = new SaisonAutreReduc();
        $totalVente = 0;
        $totalAchat = 0;
        foreach ($saison->getAutresReductions() as $reduction)
        {
            if ($idReduc == $reduction->getReduc()->getId() && !$reduction->getReduc()->getParChambre() && $this->container->get('Library')->verifIntersectionDate($date->format('Y-m-d'), $reduction->getReduc()->getDateDebut($date->format('Y')), $reduction->getReduc()->getDateFin($date->format('Y'))))
            {
                $verif = true;
                if ($type == 'adulte')
                {
                    $achat = $reduction->getSuppAdulteAchat($arr);
                    $vente = $reduction->getSuppAdulteVente($arr);
                }
                else
                {
                    $achat = $reduction->getSuppEnfantAchat($arr);
                    $vente = $reduction->getSuppEnfantVente($arr);
                }
                if (!$reduction->getReduc()->getParNuit() && ($ordre == 1 || $date->format('Y-m-d') == $reduction->getReduc()->getDateDebut($date->format('Y'))))
                    $verif = true;
                elseif (!$reduction->getReduc()->getParNuit())
                    $verif = false;
                if ($verif)
                    return array(
                        'code' => 'AUTRE-SUPP',
                        'name' => $reduction->getReduc()->__toString() . ' ' . $type,
                        'achat' => number_format($achat, 3, '.', ''),
                        'vente' => number_format($vente, 3, '.', ''),
                    );
            }
        }
    }

}
