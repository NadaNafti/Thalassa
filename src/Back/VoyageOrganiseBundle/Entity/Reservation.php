<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="ost_vo_reservations")
 * @ORM\Entity()
 */
class Reservation
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
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="VoyageOrganise", inversedBy="reservationsVo")
     * @Assert\NotBlank()
     */
    private $voyage;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client")
     * @Assert\NotBlank()
     */
    protected $client;

    /**
     * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="reservationA",cascade={"remove","persist"})
     */
    protected $adultes;
    

    /**
     * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="reservationE",cascade={"remove","persist"})
     */
    protected $enfants;

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
     * Set commentaire
     *
     * @param string $commentaire
     * @return Reservation
     */
    public function setCommentaire($commentaire)
    {
	$this->commentaire = $commentaire;

	return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
	return $this->commentaire;
    }

    /**
     * Set voyage
     *
     * @param \Back\VoyageOrganiseBundle\Entity\VoyageOrganise $voyage
     * @return Reservation
     */
    public function setVoyage(\Back\VoyageOrganiseBundle\Entity\VoyageOrganise $voyage = null)
    {
	$this->voyage = $voyage;

	return $this;
    }

    /**
     * Get voyage
     *
     * @return \Back\VoyageOrganiseBundle\Entity\VoyageOrganise
     */
    public function getVoyage()
    {
	return $this->voyage;
    }

    /**
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return Reservation
     */
    public function setClient(\Back\UserBundle\Entity\Client $client = null)
    {
	$this->client = $client;

	return $this;
    }

    /**
     * Get client
     *
     * @return \Back\UserBundle\Entity\Client
     */
    public function getClient()
    {
	return $this->client;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
	$this->adultes = new \Doctrine\Common\Collections\ArrayCollection();
	$this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add adultes
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationLigne $adultes
     * @return Reservation
     */
    public function addAdulte(\Back\VoyageOrganiseBundle\Entity\ReservationLigne $adultes)
    {
        $this->adultes[] = $adultes;

        return $this;
    }

    /**
     * Remove adultes
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationLigne $adultes
     */
    public function removeAdulte(\Back\VoyageOrganiseBundle\Entity\ReservationLigne $adultes)
    {
        $this->adultes->removeElement($adultes);
    }

    /**
     * Get adultes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdultes()
    {
        return $this->adultes;
    }

    /**
     * Add enfants
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationLigne $enfants
     * @return Reservation
     */
    public function addEnfant(\Back\VoyageOrganiseBundle\Entity\ReservationLigne $enfants)
    {
        $this->enfants[] = $enfants;

        return $this;
    }

    /**
     * Remove enfants
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationLigne $enfants
     */
    public function removeEnfant(\Back\VoyageOrganiseBundle\Entity\ReservationLigne $enfants)
    {
        $this->enfants->removeElement($enfants);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnfants()
    {
        return $this->enfants;
    }
}
