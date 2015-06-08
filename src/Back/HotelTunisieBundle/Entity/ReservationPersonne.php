<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationPersonne
 *
 * @ORM\Table(name="ost_sht_reservation_personne")
 * @ORM\Entity
 */
class ReservationPersonne
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
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;
    
    /**
     * @ORM\OneToMany(targetEntity="ReservationJour", mappedBy="personne")
     */
    protected $jours;


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
     * Set ordre
     *
     * @param integer $ordre
     * @return ReservationPersonne
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

    /**
     * Set nom
     *
     * @param string $nom
     * @return ReservationPersonne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return ReservationPersonne
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add jours
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationJour $jours
     * @return ReservationPersonne
     */
    public function addJour(\Back\HotelTunisieBundle\Entity\ReservationJour $jours)
    {
        $this->jours[] = $jours;

        return $this;
    }

    /**
     * Remove jours
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationJour $jours
     */
    public function removeJour(\Back\HotelTunisieBundle\Entity\ReservationJour $jours)
    {
        $this->jours->removeElement($jours);
    }

    /**
     * Get jours
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJours()
    {
        return $this->jours;
    }
}
