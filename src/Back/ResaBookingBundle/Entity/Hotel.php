<?php

namespace Back\ResaBookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Hotel
 *
 * @ORM\Table(name="ost_resa_hotels")
 * @ORM\Entity
 */

class Hotel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Back\HotelTunisieBundle\Entity\Hotel")
     */
    private $hotel;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var array
     *
     * @ORM\Column(name="produit", type="json_array")
     */
    private $produit;

    /**
     * @var array
     *
     * @ORM\Column(name="prix", type="json_array")
     */
    private $prix;

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

    public function __construct()
    {
        $this->produit=array();
        $this->prix=array();
    }


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
     * @return Hotel
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
     * Set id
     *
     * @param integer $id
     * @return Hotel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Hotel
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
     * @return Hotel
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

    /**
     * Set hotel
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotel
     * @return Hotel
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
     * Set produit
     *
     * @param array $produit
     * @return Hotel
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return array 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set prix
     *
     * @param array $prix
     * @return Hotel
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return array 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    public function __toString()
    {
        return $this->libelle;
    }
}
