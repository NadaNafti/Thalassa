<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Categorie
 *
 * @ORM\Table(name="ost_sht_categorie")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity
 */
class Categorie
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
     * @ORM\Column(name="nombre_etoiles", type="integer", nullable=true)
     */
    private $nombreEtoiles;
    
    /**
     * @ORM\OneToMany(targetEntity="Hotel", mappedBy="categorie")
     */
    protected $hotels;
    
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
     * @ORM\Column( name="deletedAt",type="datetime",nullable=true)
     */
    private $deletedAt;
    

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
     * @return Categorie
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
    
    
    public function showEtat()
    {
        return "Active";
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Categorie
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * @return Categorie
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
     * @return Categorie
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
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Categorie
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Set nombreEtoiles
     *
     * @param integer $nombreEtoiles
     * @return Categorie
     */
    public function setNombreEtoiles($nombreEtoiles)
    {
        $this->nombreEtoiles = $nombreEtoiles;

        return $this;
    }

    /**
     * Get nombreEtoiles
     *
     * @return integer 
     */
    public function getNombreEtoiles()
    {
        return $this->nombreEtoiles;
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
     * @return Categorie
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

    public function hasHotelsValide()
    {
        foreach ($this->hotels as $hotel) {
            if ($hotel->getEtat())
                return true;
        }
        return false;
    }
}
