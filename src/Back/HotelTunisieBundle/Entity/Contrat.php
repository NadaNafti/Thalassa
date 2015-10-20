<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Contrat
 *
 * @ORM\Table(name="ost_sht_contrat")
 * @ORM\Entity
 */
class Contrat
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
    
    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="contrats")
     */
    protected $hotel;
    
    /**
     * @ORM\OneToMany(targetEntity="Saison", mappedBy="contrat")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    private $saisons;

    /**
     * @ORM\OneToMany(targetEntity="ContratMedia", mappedBy="contrat")
     */
    private $medias;


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
     * Set libelle
     *
     * @param string $libelle
     * @return Contrat
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->saisons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set hotel
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotel
     * @return Contrat
     */
    public function setHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Back\HotelTunisieBundle\Entity\Hotel 
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Add saisons
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saisons
     * @return Contrat
     */
    public function addSaison(\Back\HotelTunisieBundle\Entity\Saison $saisons)
    {
        $this->saisons[] = $saisons;

        return $this;
    }

    /**
     * Remove saisons
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saisons
     */
    public function removeSaison(\Back\HotelTunisieBundle\Entity\Saison $saisons)
    {
        $this->saisons->removeElement($saisons);
    }

    /**
     * Get saisons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSaisons()
    {
        return $this->saisons;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Add medias
     *
     * @param \Back\HotelTunisieBundle\Entity\ContratMedia $medias
     * @return Contrat
     */
    public function addMedia(\Back\HotelTunisieBundle\Entity\ContratMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Back\HotelTunisieBundle\Entity\ContratMedia $medias
     */
    public function removeMedia(\Back\HotelTunisieBundle\Entity\ContratMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }
}
