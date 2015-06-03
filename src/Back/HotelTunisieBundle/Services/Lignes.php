<?php

namespace Back\HotelTunisieBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\HotelTunisieBundle\Entity\Saison;

class Lignes {

    public function __construct(EntityManager $em, Session $session, Container $container) {
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
    }

    public function lignePrixBase(Saison $saison) {
        return array(
            'code' => 'PRIX-BASE',
            'name' => 'Prix de Base (' . $saison->getArrBase()->getLibelle() . ', Chambre double)',
            'achat' => $saison->prixBaseAchat(),
            'vente' => $saison->prixBaseVente(),
        );
    }

    public function ligneArrangement(Saison $saison, $arr) {
        if ($saison->getArrBase()->getId() != $arr) {
            foreach ($saison->getArrangements() as $arrangement) {
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

    public function ligneSuppSingle(Saison $saison, $arr, $ch, $nbrAdulte, $nbrEnfant, $type) {
        $chambre = $this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($ch);
        if (( $type == 'enfant' && $saison->getSaisonSupp()->getSuppSingleEnfant() && $nbrAdulte == 0 && $nbrEnfant == 1 ) || ( $type == 'adulte' && ( $chambre->getType() == 1 || ($chambre->getType() == 2 && $nbrEnfant == 1 && $nbrAdulte == 1 && $saison->getHotel()->getFicheTechnique()->getSuppSingle1Adulte1EnfantChDouble()) || ($chambre->getType() == 3 && $nbrEnfant == 2 && $nbrAdulte == 1 && $saison->getHotel()->getFicheTechnique()->getSuppSingle1Adulte2EnfantChDouble())) ))
            return array(
                'code' => 'SUPP-SINGLE',
                'name' => 'Supp single',
                'achat' => $saison->getSaisonSupp()->getSuppSingleAchat($arr),
                'vente' => $saison->getSaisonSupp()->getSuppSingleVente($arr)
            );
    }

    public function ligneSuppReduc3Lit(Saison $saison, $arr, $k) {
        if ($k == 3)
            return array(
                'code' => 'SUPP-REDUC-3LIT',
                'name' => 'Reduc ou Supp 3eme lit',
                'achat' => $saison->getSaisonSupp()->getSupp3LitAchat($arr) + $saison->getSaisonReduc()->getReduc3LitAchat($arr),
                'vente' => $saison->getSaisonSupp()->getSupp3LitVente($arr) + $saison->getSaisonReduc()->getReduc3LitVente($arr),
            );
    }

    public function ligneSuppReduc4Lit(Saison $saison, $arr, $k) {
        if ($k == 4)
            return array(
                'code' => 'SUPP-REDUC-4LIT',
                'name' => 'Reduc ou Supp 4eme lit',
                'achat' => $saison->getSaisonSupp()->getSupp4LitAchat($arr) + $saison->getSaisonReduc()->getReduc4LitAchat($arr),
                'vente' => $saison->getSaisonSupp()->getSupp4LitVente($arr) + $saison->getSaisonReduc()->getReduc4LitVente($arr),
            );
    }

    public function ligneSuppAutreChambre(Saison $saison, $arr, $id) {
        $chambre = $this->em->getRepository('BackHotelTunisieBundle:Chambre')->find($id);
        if ($chambre->getType() == 0) {
            foreach ($saison->getSuppChambres() as $ch) {
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

    public function ligneSuppVue(Saison $saison, $arr, $id) {
        foreach ($saison->getVues() as $vue) {
            if ($vue->getVue()->getId() == $id)
                return array(
                    'code' => 'SUPP-VUE',
                    'name' => 'Supp ' . $vue->getVue()->getLibelle(),
                    'achat' => $vue->getSuppAchat($arr),
                    'vente' => $vue->getSuppVente($arr)
                );
        }
    }

    public function ligneSuppWeekend(Saison $saison, $arr, $ch, $date, $nuitee) {
        $saisonWeekend = $saison->getSaisonWeekend();
        if (!is_null($saisonWeekend)) {
            $date = \DateTime::createFromFormat('Y-m-d', $date);
            if ($nuitee >= $saisonWeekend->getNbNuitMin() && $nuitee <= $saisonWeekend->getNbNuitMax() && ($date->format("w") == 5 && $saisonWeekend->getVendredi()) || ($date->format("w") == 6 && $saisonWeekend->getSamedi()) || ($date->format("w") == 0 && $saisonWeekend->getDimanche())) {
                foreach ($saisonWeekend->getChambres() as $chambre) {
                    if ($ch == $chambre->getId()) {
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

    public function ligneReduc1Enf1Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age) {
        if ($ordre == 1 && $nbrAdulte == 1) {
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant())
                return array(
                    'code' => 'REDUC-1ENF-1ADULTE',
                    'name' => 'Réduction 1er enfant avec 1 adulte dans une même chambre  ',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age1Vente($arr)
                );
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant())
                return array(
                    'code' => 'REDUC-1ENF-1ADULTE',
                    'name' => 'Réduction 1er enfant avec 1 adulte dans une même chambre  ',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc1Enf2Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age) {
        if ($ordre == 1 && $nbrAdulte == 2) {
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant())
                return array(
                    'code' => 'REDUC-1ENF-2ADULTES',
                    'name' => 'Réduction 1er enfant avec 2 adultes dans une même chambre  ',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age1Vente($arr)
                );
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant())
                return array(
                    'code' => 'REDUC-1ENF-2ADULTES',
                    'name' => 'Réduction 1er enfant avec 2 adultes dans une même chambre  ',
                    'achat' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReducEnfant1Adulte2Age2Vente($arr)
                );
        }
    }

    public function ligneReduc1EnfSeparer(Saison $saison, $arr, $ordre, $nbrAdulte, $age) {
        if ($ordre == 1 && $nbrAdulte == 0) {
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant())
                return array(
                    'code' => 'REDUC-1ENF-SEPARER',
                    'name' => 'Réduction 1er enfant dans une chambre séparée',
                    'achat' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age1Vente($arr)
                );
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant())
                return array(
                    'code' => 'REDUC-1ENF-SEPARER',
                    'name' => 'Réduction 1er enfant dans une chambre séparée',
                    'achat' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc1EnfantSepare1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc2Enf1Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age) {
        if ($ordre > 1 && $nbrAdulte == 1) {
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant())
                return array(
                    'code' => 'REDUC-2ENF-1ADULTE',
                    'name' => 'Réduction 2eme enfant ou plus avec 1 adulte dans une même chambre',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age1Vente($arr)
                );
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant())
                return array(
                    'code' => 'REDUC-2ENF-1ADULTE',
                    'name' => 'Réduction 2eme enfant ou plus avec 1 adulte dans une même chambre',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant1Adulte1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc2Enf2Adu(Saison $saison, $arr, $ordre, $nbrAdulte, $age) {
        if ($ordre > 1 && $nbrAdulte == 2) {
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant())
                return array(
                    'code' => 'REDUC-2ENF-2ADULTES',
                    'name' => 'Réduction 2eme enfant ou plus avec 2 adultes dans une même chambre',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age1Vente($arr)
                );
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant())
                return array(
                    'code' => 'REDUC-2ENF-2ADULTES',
                    'name' => 'Réduction 2eme enfant ou plus avec 2 adultes dans une même chambre',
                    'achat' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2Enfant2Adulte1Age2Vente($arr)
                );
        }
    }

    public function ligneReduc2EnfSeparer(Saison $saison, $arr, $ordre, $nbrAdulte, $age) {
        if ($ordre > 1 && $nbrAdulte == 0) {
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin1AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax1AgeEnfant())
                return array(
                    'code' => 'REDUC-1ENF-SEPARER',
                    'name' => '2eme enfant ou plus dans une chambre séparée',
                    'achat' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age1Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age1Vente($arr)
                );
            if ($age >= $saison->getHotel()->getFicheTechnique()->getMin2AgeEnfant() && $age <= $saison->getHotel()->getFicheTechnique()->getMax2AgeEnfant())
                return array(
                    'code' => 'REDUC-2ENF-SEPARER',
                    'name' => '2eme enfant ou plus dans une chambre séparée',
                    'achat' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age2Achat($arr),
                    'vente' => $saison->getSaisonReduc()->getReduc2EnfantOuPlusSepare1Age2Vente($arr)
                );
        }
    }

}
