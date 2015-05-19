<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TypeAmenagement
 *
 * @ORM\Table(name="ost_sht_type_amenagement")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity
 */
class TypeAmenagement
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
     * @ORM\OneToMany(targetEntity="Amenagement", mappedBy="typeAmenagement")
     */
    protected $amenagements;
    
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
     * @return TypeAmenagement
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
     * Set slug
     *
     * @param string $slug
     * @return TypeAmenagement
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
     * @return TypeAmenagement
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
     * @return TypeAmenagement
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
     * @return TypeAmenagement
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->amenagements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add amenagements
     *
     * @param \Back\HotelTunisieBundle\Entity\Amenagement $amenagements
     * @return TypeAmenagement
     */
    public function addAmenagement(\Back\HotelTunisieBundle\Entity\Amenagement $amenagements)
    {
        $this->amenagements[] = $amenagements;

        return $this;
    }

    /**
     * Remove amenagements
     *
     * @param \Back\HotelTunisieBundle\Entity\Amenagement $amenagements
     */
    public function removeAmenagement(\Back\HotelTunisieBundle\Entity\Amenagement $amenagements)
    {
        $this->amenagements->removeElement($amenagements);
    }

    /**
     * Get amenagements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAmenagements()
    {
        return $this->amenagements;
    }
    
    
    public function __toString()
    {
        return $this->libelle;
    }
}
