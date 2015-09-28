<?php

namespace Back\BienEtreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Cure
 *
 * @ORM\Table(name="os_be_cure")
 * @ORM\Entity
 */
class Cure
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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Back\BienEtreBundle\Entity\Centre")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $centre;
    
    /**
     * @ORM\OneToMany(targetEntity="Tarif", mappedBy="cure")
     */
    protected $tarifs;
    
    /**
    * @ORM\OneToMany(targetEntity="Photo", mappedBy="cure", cascade={"remove"})
    */
    private $photos;
    
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
     * Constructor
     */
    public function __construct()
    {
        $this->tarifs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Cure
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
     * Set description
     *
     * @param string $description
     * @return Cure
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Cure
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
     * @return Cure
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
     * @return Cure
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
     * Set centre
     *
     * @param \Back\BienEtreBundle\Entity\Centre $centre
     * @return Cure
     */
    public function setCentre(\Back\BienEtreBundle\Entity\Centre $centre = null)
    {
        $this->centre = $centre;

        return $this;
    }

    /**
     * Get centre
     *
     * @return \Back\BienEtreBundle\Entity\Centre 
     */
    public function getCentre()
    {
        return $this->centre;
    }

    /**
     * Add tarifs
     *
     * @param \Back\BienEtreBundle\Entity\Tarif $tarifs
     * @return Cure
     */
    public function addTarif(\Back\BienEtreBundle\Entity\Tarif $tarifs)
    {
        $this->tarifs[] = $tarifs;

        return $this;
    }

    /**
     * Remove tarifs
     *
     * @param \Back\BienEtreBundle\Entity\Tarif $tarifs
     */
    public function removeTarif(\Back\BienEtreBundle\Entity\Tarif $tarifs)
    {
        $this->tarifs->removeElement($tarifs);
    }

    /**
     * Get tarifs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTarifs()
    {
        return $this->tarifs;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Add photos
     *
     * @param \Back\BienEtreBundle\Entity\Photo $photos
     * @return Cure
     */
    public function addPhoto(\Back\BienEtreBundle\Entity\Photo $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \Back\BienEtreBundle\Entity\Photo $photos
     */
    public function removePhoto(\Back\BienEtreBundle\Entity\Photo $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
