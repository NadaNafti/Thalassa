<?php

namespace Back\BienEtreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Pack
 *
 * @ORM\Table(name="ost_be_produit")
 * @ORM\Entity(repositoryClass="Back\BienEtreBundle\Entity\Repository\ProduitRepository")
 */
class Produit {

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
     * @var integer
     *
     * 1:Pack
     * 2:Cure
     * 3:Soin
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionCourte", type="text", nullable=true)
     */
    private $descriptionCourte;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionLongue", type="text", nullable=true)
     */
    private $descriptionLongue;

    /**
     * @ORM\ManyToMany(targetEntity="Back\BienEtreBundle\Entity\Centre")
     * @ORM\JoinTable(name="ost_be_produit_centre",
     *      joinColumns={@ORM\JoinColumn(name="produit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="centre_id", referencedColumnName="id")}
     * )
     */
    protected $centres;

    /**
     * @ORM\OneToMany(targetEntity="Tarif", mappedBy="produit")
     */
    protected $tarifs;

    /**
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(name="slug", length=128,unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="produit", cascade={"remove"})
     */
    private $photos;

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
    public function __construct() {
        $this->tarifs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Produit
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Produit
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set descriptionCourte
     *
     * @param string $descriptionCourte
     * @return Produit
     */
    public function setDescriptionCourte($descriptionCourte) {
        $this->descriptionCourte = $descriptionCourte;

        return $this;
    }

    /**
     * Get descriptionCourte
     *
     * @return string 
     */
    public function getDescriptionCourte() {
        return $this->descriptionCourte;
    }

    /**
     * Set descriptionLongue
     *
     * @param string $descriptionLongue
     * @return Produit
     */
    public function setDescriptionLongue($descriptionLongue) {
        $this->descriptionLongue = $descriptionLongue;

        return $this;
    }

    /**
     * Get descriptionLongue
     *
     * @return string 
     */
    public function getDescriptionLongue() {
        return $this->descriptionLongue;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Produit
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Produit
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Add tarifs
     *
     * @param \Back\BienEtreBundle\Entity\Tarif $tarifs
     * @return Produit
     */
    public function addTarif(\Back\BienEtreBundle\Entity\Tarif $tarifs) {
        $this->tarifs[] = $tarifs;

        return $this;
    }

    /**
     * Remove tarifs
     *
     * @param \Back\BienEtreBundle\Entity\Tarif $tarifs
     */
    public function removeTarif(\Back\BienEtreBundle\Entity\Tarif $tarifs) {
        $this->tarifs->removeElement($tarifs);
    }

    /**
     * Get tarifs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTarifs() {
        return $this->tarifs;
    }

    /**
     * Add photos
     *
     * @param \Back\BienEtreBundle\Entity\Photo $photos
     * @return Produit
     */
    public function addPhoto(\Back\BienEtreBundle\Entity\Photo $photos) {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \Back\BienEtreBundle\Entity\Photo $photos
     */
    public function removePhoto(\Back\BienEtreBundle\Entity\Photo $photos) {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos() {
        return $this->photos;
    }

    public function __toString() {
        return $this->libelle;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Produit
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() {
        return $this->slug;
    }

    public function getPhotoPrincipal() {
        if (count($this->photos) == 0)
            return NULL;
        foreach ($this->photos as $image) {
            if ($image->getType() == 1)
                return $image;
        }
        return NULL;
    }

    public function getPhotosAlbum() {
        $album = array();
        foreach ($this->photos as $image) {
            if ($image->getType() == 2)
                $album[] = $image;
        }
        return $album;
    }

    public function getTarifByDate($date) {
        foreach ($this->tarifs as $tarif) {
            if ($tarif->isValideByDate($date))
                return $tarif;
        }
        return null;
    }

    public function showType() {
        if ($this->type == 1)
            return 'Pack';
        if ($this->type == 2)
            return 'Soin';
        if ($this->type == 3)
            return 'Cure';
    }

    public function getAPartieDe()
    {
        foreach ($this->tarifs as $tarif)
        {
            if($tarif->isValide())
                return $tarif->getPrixVente();
        }
        return null;
    }

    /**
     * Add centres
     *
     * @param \Back\BienEtreBundle\Entity\Centre $centres
     * @return Produit
     */
    public function addCentre(\Back\BienEtreBundle\Entity\Centre $centres) {
        $this->centres[] = $centres;

        return $this;
    }

    /**
     * Remove centres
     *
     * @param \Back\BienEtreBundle\Entity\Centre $centres
     */
    public function removeCentre(\Back\BienEtreBundle\Entity\Centre $centres) {
        $this->centres->removeElement($centres);
    }

    /**
     * Get centres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCentres() {
        return $this->centres;
    }

}
