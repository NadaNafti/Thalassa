<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonSuppChambre
 *
 * @ORM\Table(name="ost_sht_saison_suppchambres")
 * @ORM\Entity
 */
class SaisonSuppChambre
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
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean",nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="decimal", precision=11, scale=3)
     * @Assert\Range(min = 0)
     */
    private $valeur;

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
     * @ORM\ManyToOne(targetEntity="Chambre",fetch="EAGER")
     * @ORM\JoinColumn(name="chambre_id", referencedColumnName="id")
     */
    protected $chambre;
    
    /**
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="suppChambres", fetch="EAGER")
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
     * Set valeur
     *
     * @param string $valeur
     * @return SaisonSuppChambre
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set valeurPour
     *
     * @param boolean $valeurPour
     * @return SaisonSuppChambre
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
     * @return SaisonSuppChambre
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
     * @return SaisonSuppChambre
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
     * Set etat
     *
     * @param boolean $etat
     * @return SaisonSuppChambre
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set chambre
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambre
     * @return SaisonSuppChambre
     */
    public function setChambre(\Back\HotelTunisieBundle\Entity\Chambre $chambre = null)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return \Back\HotelTunisieBundle\Entity\Chambre 
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonSuppChambre
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

    public function getSuppAchat()
    {
        if($this->valeurPour)
            return $this->getSaison()->prixBaseAchat()*$this->valeur/100;
        else 
            return $this->valeur;
    }
    
    public function getSuppVente()
    {
        if($this->margePour)
            return $this->getSuppAchat()+ abs($this->getSuppAchat())*$this->marge/100 ;
        else
            return $this->getSuppAchat()+$this->marge;
    }
    
    public function __clone()
    {
        if ($this->id)
        {
            $this->id = null ;
        }
    }
}
