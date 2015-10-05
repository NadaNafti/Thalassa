<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Arrangement
 *
 * @ORM\Table(name="ost_sht_arrangement")
 * @ORM\Entity
 */
class Arrangement
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
     * @ORM\Column(name="libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="coode", type="string", length=5)
     */
    private $code;

    /**
     * @ORM\ManyToMany(targetEntity="Hotel", mappedBy="arrangements")
     */
    private $hotels;

    /**
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

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
     * Set libelle
     *
     * @param string $libelle
     * @return Arrangement
     */
    public function setLibelle($libelle)
    {
        $this->libelle=$libelle;

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
     * Set slug
     *
     * @param string $slug
     * @return Arrangement
     */
    public function setSlug($slug)
    {
        $this->slug=$slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Arrangement
     */
    public function setCreated($created)
    {
        $this->created=$created;

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
     * @return Arrangement
     */
    public function setUpdated($updated)
    {
        $this->updated=$updated;

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
     * Set code
     *
     * @param string $code
     * @return Arrangement
     */
    public function setCode($code)
    {
        $this->code=$code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add hotels
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotels
     * @return Arrangement
     */
    public function addHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotels)
    {
        $this->hotels[] = $hotels;

        return $this;
    }

    /**
     * Remove hotels
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotels
     */
    public function removeHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotels)
    {
        $this->hotels->removeElement($hotels);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Arrangement
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
    
    public function __clone()
    {
        if ($this->id)
        {
            $this->id = NULL ;
        }
    }
}
