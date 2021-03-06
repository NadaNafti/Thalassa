<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonArrangement
 *
 * @ORM\Table(name="ost_sht_saison_arrangement")
 * @ORM\Entity
 */
class SaisonArrangement
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
     * @ORM\ManyToOne(targetEntity="Arrangement",fetch="EAGER")
     * @ORM\JoinColumn(name="arrangement_id", referencedColumnName="id")
     */
    protected $arrangement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean",nullable=true)
     */
    private $etat;

    /**
     * @var string
     * @ORM\Column(name="valeur", type="decimal", precision=11, scale=3)
     * @Assert\Range(min = 0)
     */
    private $valeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valeurPour", type="boolean")
     */
    private $valeurPour;

    /**
     * @var string
     * 
     * @ORM\Column(name="marge", type="decimal", precision=11, scale=3,nullable=true)
     * @Assert\Range(min = 0)
     */
    private $marge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margePour", type="boolean")
     */
    private $margePour;

    /**
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="arrangements", fetch="EAGER")
     * @ORM\JoinColumn(name="saison_id", referencedColumnName="id",onDelete="CASCADE")
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
     * Set etat
     *
     * @param boolean $etat
     * @return SaisonArrangement
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
     * Set valeur
     *
     * @param string $valeur
     * @return SaisonArrangement
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
     * @return SaisonArrangement
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
     * @return SaisonArrangement
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
     * @return SaisonArrangement
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
     * Set arrangement
     *
     * @param \Back\HotelTunisieBundle\Entity\Arrangement $arrangement
     * @return SaisonArrangement
     */
    public function setArrangement(\Back\HotelTunisieBundle\Entity\Arrangement $arrangement = null)
    {
        $this->arrangement = $arrangement;

        return $this;
    }

    /**
     * Get arrangement
     *
     * @return \Back\HotelTunisieBundle\Entity\Arrangement 
     */
    public function getArrangement()
    {
        return $this->arrangement;
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonArrangement
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

    public function getReducSuppAchat()
    {
        if ($this->arrangement->getOrdre() > $this->saison->getArrBase()->getOrdre())
            $x = 1;
        else
            $x = -1;
        if ($this->getValeurPour())
            return $x * $this->getSaison()->getPrixConvention() * $this->valeur / 100;
        else
            return $x * $this->valeur;
    }

    public function getReducSuppVente()
    {
        if ($this->margePour)
            return $this->getReducSuppAchat() + abs($this->getReducSuppAchat()) * $this->marge / 100;
        else
            return $this->getReducSuppAchat() + $this->marge;
    }

    public function __clone()
    {
        if ($this->id)
        {
            $this->id = null;
        }
    }

}
