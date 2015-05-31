<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonAutreSupp
 *
 * @ORM\Table(name="ost_sht_saison_autressupp")
 * @ORM\Entity
 */
class SaisonAutreSupp
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valeurAdulte", type="decimal", precision=11, scale=3)
     */
    private $valeurAdulte;

    /**
     * @var string
     *
     * @ORM\Column(name="valeurEnfant", type="decimal", precision=11, scale=3)
     */
    private $valeurEnfant;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valeurPour", type="boolean",nullable=true)
     */
    private $valeurPour;

    /**
     * @var string
     *
     * @ORM\Column(name="marge", type="decimal", precision=11, scale=3)
     */
    private $marge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margePour", type="boolean",nullable=true)
     */
    private $margePour;

    /**
     * @ORM\ManyToOne(targetEntity="Supplement",fetch="EAGER")
     * @ORM\JoinColumn(name="supplement_id", referencedColumnName="id")
     */
    protected $supp;

    /**
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="autresSupplements", fetch="EAGER")
     * @ORM\JoinColumn(name="saison_id", referencedColumnName="id")
     */
    protected $saison;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valeurAdulte
     *
     * @param string $valeurAdulte
     * @return SaisonAutreSupp
     */
    public function setValeurAdulte($valeurAdulte)
    {
        $this->valeurAdulte = $valeurAdulte;

        return $this;
    }

    /**
     * Get valeurAdulte
     *
     * @return string 
     */
    public function getValeurAdulte()
    {
        return $this->valeurAdulte;
    }

    /**
     * Set valeurEnfant
     *
     * @param string $valeurEnfant
     * @return SaisonAutreSupp
     */
    public function setValeurEnfant($valeurEnfant)
    {
        $this->valeurEnfant = $valeurEnfant;

        return $this;
    }

    /**
     * Get valeurEnfant
     *
     * @return string 
     */
    public function getValeurEnfant()
    {
        return $this->valeurEnfant;
    }

    /**
     * Set valeurPour
     *
     * @param boolean $valeurPour
     * @return SaisonAutreSupp
     */
    public function setValeurPour($valeurPour)
    {
        $this->valeurPour = $valeurPour;

        return $this;
    }

    /**
     * Get valeurPour
     *
     * @return boolean 
     */
    public function getValeurPour()
    {
        return $this->valeurPour;
    }

    /**
     * Set marge
     *
     * @param string $marge
     * @return SaisonAutreSupp
     */
    public function setMarge($marge)
    {
        $this->marge = $marge;

        return $this;
    }

    /**
     * Get marge
     *
     * @return string 
     */
    public function getMarge()
    {
        return $this->marge;
    }

    /**
     * Set margePour
     *
     * @param boolean $margePour
     * @return SaisonAutreSupp
     */
    public function setMargePour($margePour)
    {
        $this->margePour = $margePour;

        return $this;
    }

    /**
     * Get margePour
     *
     * @return boolean 
     */
    public function getMargePour()
    {
        return $this->margePour;
    }

    /**
     * Set supp
     *
     * @param \Back\HotelTunisieBundle\Entity\Supplement $supp
     * @return SaisonAutreSupp
     */
    public function setSupp(\Back\HotelTunisieBundle\Entity\Supplement $supp = null)
    {
        $this->supp = $supp;

        return $this;
    }

    /**
     * Get supp
     *
     * @return \Back\HotelTunisieBundle\Entity\Supplement 
     */
    public function getSupp()
    {
        return $this->supp;
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonAutreSupp
     */
    public function setSaison(\Back\HotelTunisieBundle\Entity\Saison $saison = null)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return \Back\HotelTunisieBundle\Entity\Saison 
     */
    public function getSaison()
    {
        return $this->saison;
    }

    public function getSuppAdulteAchat($arrangement = null)
    {
        if ($this->valeurPour)
            $reduc = $this->getSaison()->prixBaseAchat($arrangement) * $this->valeurAdulte / 100;
        else
            $reduc = $this->valeurAdulte;
        return number_format($reduc, 3, '.', '');
    }

    public function getSuppAdulteVente($arrangement = null)
    {
        if ($this->valeurPour)
            $reduc = $this->getSaison()->prixBaseVente($arrangement) * $this->valeurAdulte / 100;
        else
            $reduc = $this->valeurAdulte;
        if ($this->margePour)
            $marge = abs($reduc) * $this->marge / 100;
        else
            $marge = $this->marge;
        return number_format($reduc + $marge, 3, '.', '');
    }

    public function getSuppEnfantAchat($arrangement = null)
    {
        if ($this->valeurPour)
            $reduc = $this->getSaison()->prixBaseAchat($arrangement) * $this->valeurEnfant / 100;
        else
            $reduc = $this->valeurEnfant;
        return number_format($reduc, 3, '.', '');
    }

    public function getSuppEnfantVente($arrangement = null)
    {
        if ($this->valeurPour)
            $reduc = $this->getSaison()->prixBaseVente($arrangement) * $this->valeurEnfant / 100;
        else
            $reduc = $this->valeurEnfant;
        if ($this->margePour)
            $marge = abs($reduc) * $this->marge / 100;
        else
            $marge = $this->marge;
        return number_format($reduc + $marge, 3, '.', '');
    }

    public function __clone()
    {
        if ($this->id)
        {
            $this->id = null;
        }
    }

    public function __toString()
    {
        $string = $this->supp->getLibelle();
        if ($this->supp->getObligatoire())
            $string.=" (Obligatoire)";
        if ($this->supp->getParNuit())
            $string.=" Paiement par nuitée";
        else
            $string.=" paiement une seul fois";
        if ($this->supp->getParChambre())
            $string.=" et par chambre";
        else
            $string.=" et par personne";
        return $string;
    }

}
