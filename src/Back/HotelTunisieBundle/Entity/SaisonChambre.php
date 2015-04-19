<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonChambres
 *
 * @ORM\Table(name="ost_sht_hotels_saison_chambres")
 * @ORM\Entity
 */
class SaisonChambre
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
     * @ORM\Column(name="etat", type="boolean", nullable=true)
     */
    private $etat;
    
    /**
     * @var integer
     * @Assert\Range(min = 0)
     * @ORM\Column(name="minAdulte", type="integer")
     */
    private $minAdulte;

    /**
     * @var integer
     * @Assert\Range(min = 0)
     * @ORM\Column(name="maxAdulte", type="integer")
     */
    private $maxAdulte;

    /**
     * @var integer
     * @Assert\Range(min = 0)
     * @ORM\Column(name="minEnfant", type="integer")
     */
    private $minEnfant;

    /**
     * @var integer
     * @Assert\Range(min = 0)
     * @ORM\Column(name="maxEnfant", type="integer")
     */
    private $maxEnfant;

    /**
     * @var integer
     *
     * @ORM\Column(name="contingent", type="integer")
     */
    private $contingent;
    
    /**
     * @ORM\ManyToOne(targetEntity="Chambre",fetch="EAGER")
     * @ORM\JoinColumn(name="chambre_id", referencedColumnName="id")
     */
    protected $chambre;
    
    /**
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="chambres", fetch="EAGER")
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
     * Set minAdulte
     *
     * @param integer $minAdulte
     * @return SaisonChambres
     */
    public function setMinAdulte($minAdulte)
    {
        $this->minAdulte = $minAdulte;

        return $this;
    }

    /**
     * Get minAdulte
     *
     * @return integer 
     */
    public function getMinAdulte()
    {
        return $this->minAdulte;
    }

    /**
     * Set maxAdulte
     *
     * @param integer $maxAdulte
     * @return SaisonChambres
     */
    public function setMaxAdulte($maxAdulte)
    {
        $this->maxAdulte = $maxAdulte;

        return $this;
    }

    /**
     * Get maxAdulte
     *
     * @return integer 
     */
    public function getMaxAdulte()
    {
        return $this->maxAdulte;
    }

    /**
     * Set minEnfant
     *
     * @param integer $minEnfant
     * @return SaisonChambres
     */
    public function setMinEnfant($minEnfant)
    {
        $this->minEnfant = $minEnfant;

        return $this;
    }

    /**
     * Get minEnfant
     *
     * @return integer 
     */
    public function getMinEnfant()
    {
        return $this->minEnfant;
    }

    /**
     * Set maxEnfant
     *
     * @param integer $maxEnfant
     * @return SaisonChambres
     */
    public function setMaxEnfant($maxEnfant)
    {
        $this->maxEnfant = $maxEnfant;

        return $this;
    }

    /**
     * Get maxEnfant
     *
     * @return integer 
     */
    public function getMaxEnfant()
    {
        return $this->maxEnfant;
    }

    /**
     * Set contingent
     *
     * @param integer $contingent
     * @return SaisonChambres
     */
    public function setContingent($contingent)
    {
        $this->contingent = $contingent;

        return $this;
    }

    /**
     * Get contingent
     *
     * @return integer 
     */
    public function getContingent()
    {
        return $this->contingent;
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonChambres
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

    /**
     * Set chambre
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambre
     * @return SaisonChambre
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
    
    public function __toString()
    {
        return"";
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     * @return SaisonChambre
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
    
    public function clearId()
    {
        $this->id=NULL;
        return $this;
    }
}
