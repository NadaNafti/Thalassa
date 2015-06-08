<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationJour
 *
 * @ORM\Table(name="ost_sht_reservation_jour")
 * @ORM\Entity
 */
class ReservationJour
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
     * @ORM\ManyToOne(targetEntity="Saison")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $saison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour", type="date")
     */
    private $jour;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationPersonne", inversedBy="jours")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $personne;
    
    /**
     * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="jour")
     */
    protected $lignes;

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
     * Set jour
     *
     * @param \DateTime $jour
     * @return ReservationJour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return \DateTime 
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return ReservationJour
     */
    public function setSaison(\Back\HotelTunisieBundle\Entity\Saison $saison = null)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return \Back\HotelTunisieBundle\Entity\Saison 
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set personne
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationPersonne $personne
     * @return ReservationJour
     */
    public function setPersonne(\Back\HotelTunisieBundle\Entity\ReservationPersonne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \Back\HotelTunisieBundle\Entity\ReservationPersonne 
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Add lignes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationLigne $lignes
     * @return ReservationJour
     */
    public function addLigne(\Back\HotelTunisieBundle\Entity\ReservationLigne $lignes)
    {
        $this->lignes[] = $lignes;

        return $this;
    }

    /**
     * Remove lignes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationLigne $lignes
     */
    public function removeLigne(\Back\HotelTunisieBundle\Entity\ReservationLigne $lignes)
    {
        $this->lignes->removeElement($lignes);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLignes()
    {
        return $this->lignes;
    }
}
