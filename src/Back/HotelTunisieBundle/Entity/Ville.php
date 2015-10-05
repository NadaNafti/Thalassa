<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ville
 *
 * @ORM\Table("ost_sht_ville")
 * @ORM\Entity
 */
class Ville
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
     * @Assert\NotBlank()
     */
    private $libelle;

    /**
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="villes", fetch="EAGER")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $region;

    /**
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="villes", fetch="EAGER")
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     * @ORM\OrderBy({"libelle" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $pays;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="ville")
     * @ORM\OrderBy({"ordre" = "ASC"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="Hotel", mappedBy="ville")
     */
    protected $hotels;

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
     * @return Ville
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
     * Set region
     *
     * @param \Back\HotelTunisieBundle\Entity\Region $region
     * @return Ville
     */
    public function setRegion(\Back\HotelTunisieBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Back\HotelTunisieBundle\Entity\Region 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set pays
     *
     * @param \Back\HotelTunisieBundle\Entity\Pays $pays
     * @return Ville
     */
    public function setPays(\Back\HotelTunisieBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \Back\HotelTunisieBundle\Entity\Pays 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Ville
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
     * @return Ville
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
     * @return Ville
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
     * Constructor
     */
    public function __construct()
    {

        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add images
     *
     * @param \Back\HotelTunisieBundle\Entity\Media $images
     * @return Ville
     */
    public function addImage(\Back\HotelTunisieBundle\Entity\Media $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Back\HotelTunisieBundle\Entity\Media $images
     */
    public function removeImage(\Back\HotelTunisieBundle\Entity\Media $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Add hotels
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotels
     * @return Ville
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
