<?php

namespace Back\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reglement
 *
 * @ORM\Table(name="ost_com_reglement")
 * @ORM\Entity
 */
class Reglement
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
     * @ORM\ManyToOne(targetEntity="Piece", inversedBy="reglements")
     */
    protected $piece;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Reservation", inversedBy="reglements")
     */
    protected $reservation;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Reservation", inversedBy="reglements")
     */
    protected $reservationVO;

    /**
     * @ORM\ManyToOne(targetEntity="Back\ProgrammeBundle\Entity\Reservation", inversedBy="reglements")
     */
    protected $reservationPR;

    /**
     * @ORM\ManyToOne(targetEntity="Back\BilletterieMaritimeBundle\Entity\BilletterieReservation", inversedBy="reglements")
     */
    protected $reservationsBilletterie;

    /**
     * @ORM\ManyToOne(targetEntity="Back\BilletterieMaritimeBundle\Entity\MaritimeReservation", inversedBy="reglements")
     */
    protected $reservationMaritime;

    /**
     * @ORM\ManyToOne(targetEntity="Back\BienEtreBundle\Entity\Reservation", inversedBy="reglements")
     */
    protected $reservationBE;

    /**
     * @ORM\ManyToOne(targetEntity="Back\TransfertBundle\Entity\TransfertReservation", inversedBy="reglements")
     */
    protected $reservationT;

    /**
     * @ORM\ManyToOne(targetEntity="Back\ResaBookingBundle\Entity\Reservation", inversedBy="reglements")
     */
    protected $reservationRB;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", precision=11, scale=3)
     */
    private $montant;

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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Reglement
     */
    public function setDateCreation($dateCreation)
    {
	$this->dateCreation = $dateCreation;

	return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
	return $this->dateCreation;
    }

    /**
     * Set montant
     *
     * @param string $montant
     * @return Reglement
     */
    public function setMontant($montant)
    {
	$this->montant = $montant;

	return $this;
    }

    /**
     * Get montant
     *
     * @return string 
     */
    public function getMontant()
    {
	return $this->montant;
    }

    /**
     * Set piece
     *
     * @param \Back\CommercialBundle\Entity\Piece $piece
     * @return Reglement
     */
    public function setPiece(\Back\CommercialBundle\Entity\Piece $piece = null)
    {
	$this->piece = $piece;

	return $this;
    }

    /**
     * Get piece
     *
     * @return \Back\CommercialBundle\Entity\Piece 
     */
    public function getPiece()
    {
	return $this->piece;
    }

    /**
     * Set reservation
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservation
     * @return Reglement
     */
    public function setReservation(\Back\HotelTunisieBundle\Entity\Reservation $reservation = null)
    {
	$this->reservation = $reservation;

	return $this;
    }

    /**
     * Get reservation
     *
     * @return \Back\HotelTunisieBundle\Entity\Reservation 
     */
    public function getReservation()
    {
	return $this->reservation;
    }


    /**
     * Set reservationVO
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Reservation $reservationVO
     * @return Reglement
     */
    public function setReservationVO(\Back\VoyageOrganiseBundle\Entity\Reservation $reservationVO = null)
    {
        $this->reservationVO = $reservationVO;

        return $this;
    }

    /**
     * Get reservationVO
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Reservation 
     */
    public function getReservationVO()
    {
        return $this->reservationVO;
    }

    /**
     * Set reservationPR
     *
     * @param \Back\ProgrammeBundle\Entity\Reservation $reservationPR
     * @return Reglement
     */
    public function setReservationPR(\Back\ProgrammeBundle\Entity\Reservation $reservationPR = null)
    {
        $this->reservationPR = $reservationPR;

        return $this;
    }

    /**
     * Get reservationPR
     *
     * @return \Back\ProgrammeBundle\Entity\Reservation 
     */
    public function getReservationPR()
    {
        return $this->reservationPR;
    }

    /**
     * Set reservationsBilletterie
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationsBilletterie
     * @return Reglement
     */
    public function setReservationsBilletterie(\Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationsBilletterie = null)
    {
        $this->reservationsBilletterie = $reservationsBilletterie;

        return $this;
    }

    /**
     * Get reservationsBilletterie
     *
     * @return \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation 
     */
    public function getReservationsBilletterie()
    {
        return $this->reservationsBilletterie;
    }

    /**
     * Set reservationMaritime
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationMaritime
     * @return Reglement
     */
    public function setReservationMaritime(\Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationMaritime = null)
    {
        $this->reservationMaritime = $reservationMaritime;

        return $this;
    }

    /**
     * Get reservationMaritime
     *
     * @return \Back\BilletterieMaritimeBundle\Entity\MaritimeReservation 
     */
    public function getReservationMaritime()
    {
        return $this->reservationMaritime;
    }

    /**
     * Set reservationBE
     *
     * @param \Back\BienEtreBundle\Entity\Reservation $reservationBE
     * @return Reglement
     */
    public function setReservationBE(\Back\BienEtreBundle\Entity\Reservation $reservationBE = null)
    {
        $this->reservationBE = $reservationBE;

        return $this;
    }

    /**
     * Get reservationBE
     *
     * @return \Back\BienEtreBundle\Entity\Reservation 
     */
    public function getReservationBE()
    {
        return $this->reservationBE;
    }

    /**
     * Set reservationT
     *
     * @param \Back\TransfertBundle\Entity\TransfertReservation $reservationT
     * @return Reglement
     */
    public function setReservationT(\Back\TransfertBundle\Entity\TransfertReservation $reservationT = null)
    {
        $this->reservationT = $reservationT;

        return $this;
    }

    /**
     * Get reservationT
     *
     * @return \Back\TransfertBundle\Entity\TransfertReservation 
     */
    public function getReservationT()
    {
        return $this->reservationT;
    }

    /**
     * Set reservationRB
     *
     * @param \Back\ResaBookingBundle\Entity\Reservation $reservationRB
     * @return Reglement
     */
    public function setReservationRB(\Back\ResaBookingBundle\Entity\Reservation $reservationRB = null)
    {
        $this->reservationRB = $reservationRB;

        return $this;
    }

    /**
     * Get reservationRB
     *
     * @return \Back\ResaBookingBundle\Entity\Reservation 
     */
    public function getReservationRB()
    {
        return $this->reservationRB;
    }
}
