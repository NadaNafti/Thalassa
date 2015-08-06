<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationChambre
 *
 * @ORM\Table(name="ost_vo_reservations_chambres")
 * @ORM\Entity
 */
class ReservationChambre
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
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="chambres",cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $reservation;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;
    
    /**
     * @ORM\OneToMany(targetEntity="ReservationPersonne", mappedBy="chambre")
     */
    protected $occupants;

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
     * Set type
     *
     * @param integer $type
     * @return ReservationChambre
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->occupants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set reservation
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Reservation $reservation
     * @return ReservationChambre
     */
    public function setReservation(\Back\VoyageOrganiseBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Add occupants
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationPersonne $occupants
     * @return ReservationChambre
     */
    public function addOccupant(\Back\VoyageOrganiseBundle\Entity\ReservationPersonne $occupants)
    {
        $this->occupants[] = $occupants;

        return $this;
    }

    /**
     * Remove occupants
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationPersonne $occupants
     */
    public function removeOccupant(\Back\VoyageOrganiseBundle\Entity\ReservationPersonne $occupants)
    {
        $this->occupants->removeElement($occupants);
    }

    /**
     * Get occupants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOccupants()
    {
        return $this->occupants;
    }
}
