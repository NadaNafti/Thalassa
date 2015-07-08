<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationLigne
 *
 * @ORM\Table(name="ost_vo_reservation_lignes")
 * @ORM\Entity()
 */
class ReservationLigne
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
     * @ORM\Column(name="nom_prenom", type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer",nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="passport", type="string", length=100)
     */
    private $passport;

    /**
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="adultes",cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $reservationA;

    /**
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="enfants",cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $reservationE;

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
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return ReservationLigne
     */
    public function setNomPrenom($nomPrenom)
    {
	$this->nomPrenom = $nomPrenom;

	return $this;
    }

    /**
     * Get nomPrenom
     *
     * @return string
     */
    public function getNomPrenom()
    {
	return $this->nomPrenom;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return ReservationLigne
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
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return ReservationLigne
     */
    public function setDateNaissance($dateNaissance)
    {
	$this->dateNaissance = $dateNaissance;

	return $this;
    }

    /**
     * Get passport
     *
     * @return string
     */
    public function getPassport()
    {
	return $this->passport;
    }

    /**
     * Get reservation
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Reservation
     */
    public function getReservation()
    {
	if (!is_null($this->reservationA))
	    return $this->reservationA;
	return $this->reservationE;
    }


    /**
     * Set passport
     *
     * @param string $passport
     * @return ReservationLigne
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Set reservationA
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Reservation $reservationA
     * @return ReservationLigne
     */
    public function setReservationA(\Back\VoyageOrganiseBundle\Entity\Reservation $reservationA = null)
    {
        $this->reservationA = $reservationA;

        return $this;
    }

    /**
     * Get reservationA
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Reservation 
     */
    public function getReservationA()
    {
        return $this->reservationA;
    }

    /**
     * Set reservationE
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Reservation $reservationE
     * @return ReservationLigne
     */
    public function setReservationE(\Back\VoyageOrganiseBundle\Entity\Reservation $reservationE = null)
    {
        $this->reservationE = $reservationE;

        return $this;
    }

    /**
     * Get reservationE
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Reservation 
     */
    public function getReservationE()
    {
        return $this->reservationE;
    }
}
