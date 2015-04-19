<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonAutreSupp
 *
 * @ORM\Table(name="ost_sht_hotels_saison_autressupp")
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
    
    public function getSuppAdulteAchat()
    {
        if($this->valeurPour)
            return $this->getSaison()->prixBaseAchat()*$this->valeurAdulte/100;
        else 
            return $this->valeurAdulte;
    }
    
    public function getSuppAdulteVente()
    {
        if($this->margePour)
            return $this->getSuppAdulteAchat()+ abs($this->getSuppAdulteAchat())*$this->marge/100 ;
        else
            return $this->getSuppAdulteAchat()+$this->marge;
    }
    
    public function getSuppEnfantAchat()
    {
        if($this->valeurPour)
            return $this->getSaison()->prixBaseAchat()*$this->valeurEnfant/100;
        else 
            return $this->valeurEnfant;
    }
    
    public function getSuppEnfantVente()
    {
        if($this->margePour)
            return $this->getSuppEnfantAchat()+ abs($this->getSuppEnfantAchat())*$this->marge/100 ;
        else
            return $this->getSuppEnfantAchat()+$this->marge;
    }
    
    public function clearId()
    {
        $this->id=NULL;
        return $this;
    }
}
