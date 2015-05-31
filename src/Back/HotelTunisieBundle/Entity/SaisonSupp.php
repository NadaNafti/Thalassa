<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonSupp
 *
 * @ORM\Table(name="ost_sht_saison_supp")
 * @ORM\Entity
 */
class SaisonSupp
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
     * @ORM\Column(name="suppSingle", type="decimal", precision=11, scale=3)
     */
    private $suppSingle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSinglePour", type="boolean",nullable=true)
     */
    private $suppSinglePour;

    /**
     * @var string
     *
     * @ORM\Column(name="sippSingleMarge", type="decimal", precision=11, scale=3)
     */
    private $sippSingleMarge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSingleMargePour", type="boolean",nullable=true)
     */
    private $suppSingleMargePour;

    /**
     * @var string
     *
     * @ORM\Column(name="supp3Lit", type="decimal", precision=11, scale=3)
     */
    private $supp3Lit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supp3LitPour", type="boolean",nullable=true)
     */
    private $supp3LitPour;

    /**
     * @var string
     *
     * @ORM\Column(name="supp3LitMarge", type="decimal", precision=11, scale=3)
     */
    private $supp3LitMarge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supp3LitMargePour", type="boolean",nullable=true)
     */
    private $supp3LitMargePour;

    /**
     * @var string
     *
     * @ORM\Column(name="supp4Lit", type="decimal", precision=11, scale=3)
     */
    private $supp4Lit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supp4LitPour", type="boolean",nullable=true)
     */
    private $supp4LitPour;

    /**
     * @var string
     *
     * @ORM\Column(name="supp4LitMarge", type="decimal", precision=11, scale=3)
     */
    private $supp4LitMarge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supp4LitMargePour", type="boolean",nullable=true)
     */
    private $supp4LitMargePour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSingleEnfant", type="boolean",nullable=true)
     */
    private $suppSingleEnfant;

    /**
     * @ORM\OneToOne(targetEntity="Saison", mappedBy="saisonSupp")
     * */
    private $saison;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column( type="datetime")
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column( type="datetime")
     */
    private $updated;

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
     * Set suppSingle
     *
     * @param string $suppSingle
     * @return SaisonSupp
     */
    public function setSuppSingle($suppSingle)
    {
        $this->suppSingle = $suppSingle;

        return $this;
    }

    /**
     * Get suppSingle
     *
     * @return string 
     */
    public function getSuppSingle()
    {
        return $this->suppSingle;
    }

    /**
     * Set suppSinglePour
     *
     * @param boolean $suppSinglePour
     * @return SaisonSupp
     */
    public function setSuppSinglePour($suppSinglePour)
    {
        $this->suppSinglePour = $suppSinglePour;

        return $this;
    }

    /**
     * Get suppSinglePour
     *
     * @return boolean 
     */
    public function getSuppSinglePour()
    {
        return $this->suppSinglePour;
    }

    /**
     * Set sippSingleMarge
     *
     * @param string $sippSingleMarge
     * @return SaisonSupp
     */
    public function setSippSingleMarge($sippSingleMarge)
    {
        $this->sippSingleMarge = $sippSingleMarge;

        return $this;
    }

    /**
     * Get sippSingleMarge
     *
     * @return string 
     */
    public function getSippSingleMarge()
    {
        return $this->sippSingleMarge;
    }

    /**
     * Set suppSingleMargePour
     *
     * @param boolean $suppSingleMargePour
     * @return SaisonSupp
     */
    public function setSuppSingleMargePour($suppSingleMargePour)
    {
        $this->suppSingleMargePour = $suppSingleMargePour;

        return $this;
    }

    /**
     * Get suppSingleMargePour
     *
     * @return boolean 
     */
    public function getSuppSingleMargePour()
    {
        return $this->suppSingleMargePour;
    }

    /**
     * Set supp3Lit
     *
     * @param string $supp3Lit
     * @return SaisonSupp
     */
    public function setSupp3Lit($supp3Lit)
    {
        $this->supp3Lit = $supp3Lit;

        return $this;
    }

    /**
     * Get supp3Lit
     *
     * @return string 
     */
    public function getSupp3Lit()
    {
        return $this->supp3Lit;
    }

    /**
     * Set supp3LitPour
     *
     * @param boolean $supp3LitPour
     * @return SaisonSupp
     */
    public function setSupp3LitPour($supp3LitPour)
    {
        $this->supp3LitPour = $supp3LitPour;

        return $this;
    }

    /**
     * Get supp3LitPour
     *
     * @return boolean 
     */
    public function getSupp3LitPour()
    {
        return $this->supp3LitPour;
    }

    /**
     * Set supp3LitMarge
     *
     * @param string $supp3LitMarge
     * @return SaisonSupp
     */
    public function setSupp3LitMarge($supp3LitMarge)
    {
        $this->supp3LitMarge = $supp3LitMarge;

        return $this;
    }

    /**
     * Get supp3LitMarge
     *
     * @return string 
     */
    public function getSupp3LitMarge()
    {
        return $this->supp3LitMarge;
    }

    /**
     * Set supp3LitMargePour
     *
     * @param boolean $supp3LitMargePour
     * @return SaisonSupp
     */
    public function setSupp3LitMargePour($supp3LitMargePour)
    {
        $this->supp3LitMargePour = $supp3LitMargePour;

        return $this;
    }

    /**
     * Get supp3LitMargePour
     *
     * @return boolean 
     */
    public function getSupp3LitMargePour()
    {
        return $this->supp3LitMargePour;
    }

    /**
     * Set supp4Lit
     *
     * @param string $supp4Lit
     * @return SaisonSupp
     */
    public function setSupp4Lit($supp4Lit)
    {
        $this->supp4Lit = $supp4Lit;

        return $this;
    }

    /**
     * Get supp4Lit
     *
     * @return string 
     */
    public function getSupp4Lit()
    {
        return $this->supp4Lit;
    }

    /**
     * Set supp4LitPour
     *
     * @param boolean $supp4LitPour
     * @return SaisonSupp
     */
    public function setSupp4LitPour($supp4LitPour)
    {
        $this->supp4LitPour = $supp4LitPour;

        return $this;
    }

    /**
     * Get supp4LitPour
     *
     * @return boolean 
     */
    public function getSupp4LitPour()
    {
        return $this->supp4LitPour;
    }

    /**
     * Set supp4LitMarge
     *
     * @param string $supp4LitMarge
     * @return SaisonSupp
     */
    public function setSupp4LitMarge($supp4LitMarge)
    {
        $this->supp4LitMarge = $supp4LitMarge;

        return $this;
    }

    /**
     * Get supp4LitMarge
     *
     * @return string 
     */
    public function getSupp4LitMarge()
    {
        return $this->supp4LitMarge;
    }

    /**
     * Set supp4LitMargePour
     *
     * @param boolean $supp4LitMargePour
     * @return SaisonSupp
     */
    public function setSupp4LitMargePour($supp4LitMargePour)
    {
        $this->supp4LitMargePour = $supp4LitMargePour;

        return $this;
    }

    /**
     * Get supp4LitMargePour
     *
     * @return boolean 
     */
    public function getSupp4LitMargePour()
    {
        return $this->supp4LitMargePour;
    }

    /**
     * Set suppSingleEnfant
     *
     * @param boolean $suppSingleEnfant
     * @return SaisonSupp
     */
    public function setSuppSingleEnfant($suppSingleEnfant)
    {
        $this->suppSingleEnfant = $suppSingleEnfant;

        return $this;
    }

    /**
     * Get suppSingleEnfant
     *
     * @return boolean 
     */
    public function getSuppSingleEnfant()
    {
        return $this->suppSingleEnfant;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return SaisonSupp
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return SaisonSupp
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

//    public function getSuppSingleAchat()
//    {
//        if($this->suppSinglePour)
//            return $this->;
//    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonSupp
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

    public function getSuppSingleAchat($arrangement = null)
    {
        if ($this->suppSinglePour)
            $supp = $this->saison->prixBaseAchat($arrangement) * $this->suppSingle / 100;
        else
            $supp = $this->suppSingle;
        return number_format($supp, 3, '.', '');
    }

    public function getSuppSingleVente($arrangement = null)
    {
        if ($this->suppSinglePour)
            $supp = $this->saison->prixBaseVente($arrangement) * $this->suppSingle / 100;
        else
            $supp = $this->suppSingle;

        if ($this->suppSingleMargePour)
            $marge = $supp * $this->sippSingleMarge / 100;
        else
            $marge = $this->sippSingleMarge;

        return number_format($marge + $supp, 3, '.', '');
    }

    public function getSupp3LitAchat($arrangement = null)
    {
        if ($this->supp3LitPour)
            $supp = $this->saison->prixBaseAchat($arrangement) * $this->supp3Lit / 100;
        else
            $supp = $this->supp3Lit;
        return number_format($supp, 3, '.', '');
    }

    public function getSupp3LitVente($arrangement = null)
    {
        if ($this->supp3LitPour)
            $supp = $this->saison->prixBaseVente($arrangement) * $this->supp3Lit / 100;
        else
            $supp = $this->supp3Lit;
        if ($this->supp3LitMargePour)
            $marge = $supp * $this->supp3LitMarge / 100;
        else
            $marge = $this->supp3LitMarge;
        return number_format($marge + $supp, 3, '.', '');
    }

    public function getSupp4LitAchat($arrangement = null)
    {
        if ($this->supp4LitPour)
            $supp = $this->saison->prixBaseAchat($arrangement) * $this->supp4Lit / 100;
        else
            $supp = $this->supp4Lit;
        return number_format($supp, 3, '.', '');
    }

    public function getSupp4LitVente($arrangement = null)
    {
        if ($this->supp4LitPour)
            $supp = $this->saison->prixBaseVente($arrangement) * $this->supp4Lit / 100;
        else
            $supp = $this->supp4Lit;
        
        if ($this->supp4LitMargePour)
            $marge = $supp * $this->supp4LitMarge / 100;
        else
            $marge = $this->supp4LitMarge;
        
        return number_format($marge +$supp, 3, '.', '');
    }

    public function getSuppSingleEnfantAchat($arrangement = null)
    {
        if (!$this->suppSingleEnfant)
            return 0;
        return $this->getSuppSingleAchat($arrangement);
    }

    public function getSuppSingleEnfantVente($arrangement = null)
    {
        if (!$this->suppSingleEnfant)
            return 0;
        return $this->getSuppSingleVente($arrangement);
    }

    public function __clone()
    {
        if ($this->id)
        {
            $this->id = NULL;
        }
    }

}
