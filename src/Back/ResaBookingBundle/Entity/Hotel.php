<?php

namespace Back\ResaBookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_resa", type="integer")
     */
    private $idResa;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_resa", type="string", length=255)
     */
    private $libelleResa;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="text",nullable=true)
     */
    private $info;


    /**
     * @ORM\OneToOne(targetEntity="Back\HotelTunisieBundle\Entity\Hotel")
     *
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id", nullable=true)
     */
    private $hotel;

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
     * Set idResa
     *
     * @param integer $idResa
     * @return Hotel
     */
    public function setIdResa($idResa)
    {
        $this->idResa = $idResa;

        return $this;
    }

    /**
     * Get idResa
     *
     * @return integer
     */
    public function getIdResa()
    {
        return $this->idResa;
    }

    /**
     * Set libelleResa
     *
     * @param string $libelleResa
     * @return Hotel
     */
    public function setLibelleResa($libelleResa)
    {
        $this->libelleResa = $libelleResa;

        return $this;
    }

    /**
     * Get libelleResa
     *
     * @return string
     */
    public function getLibelleResa()
    {
        return $this->libelleResa;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Hotel
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Hotel
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set idHotel
     *
     * @param integer $idHotel
     * @return Hotel
     */
    public function setIdHotel($idHotel)
    {
        $this->idHotel = $idHotel;

        return $this;
    }

    /**
     * Get idHotel
     *
     * @return integer
     */
    public function getIdHotel()
    {
        return $this->idHotel;
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
     * Set info
     *
     * @param string $info
     * @return Hotel
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }
}
