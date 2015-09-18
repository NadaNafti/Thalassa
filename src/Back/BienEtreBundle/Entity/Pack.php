<?php

namespace Back\BienEtreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Pack
 *
 * @ORM\Table(name="ost_be_pack")
 * @ORM\Entity
 */
class Pack {

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
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

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
     * @ORM\ManyToMany(targetEntity="Soin")
     * @ORM\JoinTable(name="ost_be_pack_soin",
     *      joinColumns={@ORM\JoinColumn(name="id_pack", referencedColumnName="id",onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_soin", referencedColumnName="id",onDelete="CASCADE")}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $soins;

    /**
     * @ORM\ManyToMany(targetEntity="Cure")
     * @ORM\JoinTable(name="ost_be_pack_cure",
     *      joinColumns={@ORM\JoinColumn(name="id_pack", referencedColumnName="id",onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_cure", referencedColumnName="id",onDelete="CASCADE")}
     * )
     */
    protected $cures;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Pack
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
     * Set prix
     *
     * @param integer $prix
     * @return Pack
     */
    public function setPrix($prix) {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Pack
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Pack
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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Pack
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
     * @return Pack
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
     * Set centre
     *
     * @param \Back\BienEtreBundle\Entity\Centre $centre
     * @return Pack
     */
    public function setCentre(\Back\BienEtreBundle\Entity\Centre $centre = null) {
        $this->centre = $centre;

        return $this;
    }

    /**
     * Get centre
     *
     * @return \Back\BienEtreBundle\Entity\Centre 
     */
    public function getCentre() {
        return $this->centre;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->soins = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add soins
     *
     * @param \Back\BienEtreBundle\Entity\Soin $soins
     * @return Pack
     */
    public function addSoin(\Back\BienEtreBundle\Entity\Soin $soins) {
        $this->soins[] = $soins;

        return $this;
    }

    /**
     * Remove soins
     *
     * @param \Back\BienEtreBundle\Entity\Soin $soins
     */
    public function removeSoin(\Back\BienEtreBundle\Entity\Soin $soins) {
        $this->soins->removeElement($soins);
    }

    /**
     * Get soins
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSoins() {
        return $this->soins;
    }

    /**
     * Add cures
     *
     * @param \Back\BienEtreBundle\Entity\Cure $cures
     * @return Pack
     */
    public function addCure(\Back\BienEtreBundle\Entity\Cure $cures) {
        $this->cures[] = $cures;

        return $this;
    }

    /**
     * Remove cures
     *
     * @param \Back\BienEtreBundle\Entity\Cure $cures
     */
    public function removeCure(\Back\BienEtreBundle\Entity\Cure $cures) {
        $this->cures->removeElement($cures);
    }

    /**
     * Get cures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCures() {
        return $this->cures;
    }

}
