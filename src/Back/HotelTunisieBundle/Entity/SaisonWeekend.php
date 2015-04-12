<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonWeekend
 *
 * @ORM\Table(name="ost_sht_hotels_saison_weekend")
 * @ORM\Entity
 */
class SaisonWeekend {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendredi", type="boolean",nullable=true)
     */
    private $vendredi;

    /**
     * @var boolean
     *
     * @ORM\Column(name="samedi", type="boolean",nullable=true)
     */
    private $samedi;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dimanche", type="boolean",nullable=true)
     */
    private $dimanche;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="decimal", precision=11, scale=3)
     */
    private $valeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valeurPour", type="boolean",nullable=true)
     */
    private $valeurPour;

    /**
     * @var string
     *
     * @ORM\Column(name="marge", type="decimal", precision=11, scale=3)
     */
    private $marge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margePour", type="boolean",nullable=true)
     */
    private $margePour;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbNuitMin", type="integer")
     */
    private $nbNuitMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbNuitMax", type="integer")
     */
    private $nbNuitMax;

    /**
     * @ORM\ManyToMany(targetEntity="Chambre")
     * @ORM\JoinTable(name="ost_sht_hotels_saison_weekend_chambres",
     *      joinColumns={@ORM\JoinColumn(name="id_saison_weekend", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_chambre", referencedColumnName="id")}
     * )
     */
    protected $chambres;

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
     * Set vendredi
     *
     * @param boolean $vendredi
     * @return SaisonWeekend
     */
    public function setVendredi($vendredi) {
        $this->vendredi = $vendredi;

        return $this;
    }

    /**
     * Get vendredi
     *
     * @return boolean 
     */
    public function getVendredi() {
        return $this->vendredi;
    }

    /**
     * Set samedi
     *
     * @param boolean $samedi
     * @return SaisonWeekend
     */
    public function setSamedi($samedi) {
        $this->samedi = $samedi;

        return $this;
    }

    /**
     * Get samedi
     *
     * @return boolean 
     */
    public function getSamedi() {
        return $this->samedi;
    }

    /**
     * Set dimanche
     *
     * @param boolean $dimanche
     * @return SaisonWeekend
     */
    public function setDimanche($dimanche) {
        $this->dimanche = $dimanche;

        return $this;
    }

    /**
     * Get dimanche
     *
     * @return boolean 
     */
    public function getDimanche() {
        return $this->dimanche;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return SaisonWeekend
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
     * Set valeur
     *
     * @param string $valeur
     * @return SaisonWeekend
     */
    public function setValeur($valeur) {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur() {
        return $this->valeur;
    }

    /**
     * Set valeurPour
     *
     * @param boolean $valeurPour
     * @return SaisonWeekend
     */
    public function setValeurPour($valeurPour) {
        $this->valeurPour = $valeurPour;

        return $this;
    }

    /**
     * Get valeurPour
     *
     * @return boolean 
     */
    public function getValeurPour() {
        return $this->valeurPour;
    }

    /**
     * Set marge
     *
     * @param string $marge
     * @return SaisonWeekend
     */
    public function setMarge($marge) {
        $this->marge = $marge;

        return $this;
    }

    /**
     * Get marge
     *
     * @return string 
     */
    public function getMarge() {
        return $this->marge;
    }

    /**
     * Set margePour
     *
     * @param boolean $margePour
     * @return SaisonWeekend
     */
    public function setMargePour($margePour) {
        $this->margePour = $margePour;

        return $this;
    }

    /**
     * Get margePour
     *
     * @return boolean 
     */
    public function getMargePour() {
        return $this->margePour;
    }

    /**
     * Set nbNuitMin
     *
     * @param integer $nbNuitMin
     * @return SaisonWeekend
     */
    public function setNbNuitMin($nbNuitMin) {
        $this->nbNuitMin = $nbNuitMin;

        return $this;
    }

    /**
     * Get nbNuitMin
     *
     * @return integer 
     */
    public function getNbNuitMin() {
        return $this->nbNuitMin;
    }

    /**
     * Set nbNuitMax
     *
     * @param integer $nbNuitMax
     * @return SaisonWeekend
     */
    public function setNbNuitMax($nbNuitMax) {
        $this->nbNuitMax = $nbNuitMax;

        return $this;
    }

    /**
     * Get nbNuitMax
     *
     * @return integer 
     */
    public function getNbNuitMax() {
        return $this->nbNuitMax;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return SaisonWeekend
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
     * @return SaisonWeekend
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
     * Constructor
     */
    public function __construct() {
        $this->chambres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambres
     * @return SaisonWeekend
     */
    public function addChambre(\Back\HotelTunisieBundle\Entity\Chambre $chambres) {
        $this->chambres[] = $chambres;

        return $this;
    }

    /**
     * Remove chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambres
     */
    public function removeChambre(\Back\HotelTunisieBundle\Entity\Chambre $chambres) {
        $this->chambres->removeElement($chambres);
    }

    /**
     * Get chambres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChambres() {
        return $this->chambres;
    }

}
