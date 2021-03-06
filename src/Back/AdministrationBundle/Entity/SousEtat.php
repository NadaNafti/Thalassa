<?php

namespace Back\AdministrationBundle\Entity;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousEtat
 *
 * @ORM\Table(name="ost_sous_etat")
 * @ORM\Entity
 */
class SousEtat
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
     * @ORM\ManyToOne(targetEntity="Etat" ,fetch="EAGER")
     */
    protected $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\User" ,fetch="EAGER")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column( type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Reservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationSHT;

    /**
     * @ORM\ManyToOne(targetEntity="Back\ProgrammeBundle\Entity\Reservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationPR;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Reservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationVO;

    /**
     * @ORM\ManyToOne(targetEntity="Back\BilletterieMaritimeBundle\Entity\BilletterieReservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationB;

    /**
     * @ORM\ManyToOne(targetEntity="Back\BilletterieMaritimeBundle\Entity\MaritimeReservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationM;

    /**
     * @ORM\ManyToOne(targetEntity="Back\BienEtreBundle\Entity\Reservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationBE;

    /**
     * @ORM\ManyToOne(targetEntity="Back\TransfertBundle\Entity\TransfertReservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationT;


    /**
     * @ORM\ManyToOne(targetEntity="Back\ResaBookingBundle\Entity\Reservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationRB;


    /**
     * @ORM\ManyToOne(targetEntity="Back\ReservationDiversBundle\Entity\Reservation", inversedBy="sousEtats", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservationDivers;


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
     * @return SousEtat
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
     * Set created
     *
     * @param \DateTime $created
     * @return SousEtat
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

    public function __toString()
    {
        return $this->etat->getLibelle();
    }

    /**
     * Set etat
     *
     * @param \Back\AdministrationBundle\Entity\Etat $etat
     * @return SousEtat
     */
    public function setEtat(\Back\AdministrationBundle\Entity\Etat $etat = null)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \Back\AdministrationBundle\Entity\Etat
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set reservationSHT
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservationSHT
     * @return SousEtat
     */
    public function setReservationSHT(\Back\HotelTunisieBundle\Entity\Reservation $reservationSHT = null)
    {
        $this->reservationSHT = $reservationSHT;

        return $this;
    }

    /**
     * Get reservationSHT
     *
     * @return \Back\HotelTunisieBundle\Entity\Reservation 
     */
    public function getReservationSHT()
    {
        return $this->reservationSHT;
    }

    /**
     * Set reservationPR
     *
     * @param \Back\ProgrammeBundle\Entity\Reservation $reservationPR
     * @return SousEtat
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
     * Set reservationVO
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Reservation $reservationVO
     * @return SousEtat
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
     * Set reservationB
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationB
     * @return SousEtat
     */
    public function setReservationB(\Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationB = null)
    {
        $this->reservationB = $reservationB;

        return $this;
    }

    /**
     * Get reservationB
     *
     * @return \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation 
     */
    public function getReservationB()
    {
        return $this->reservationB;
    }

    /**
     * Set reservationM
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationM
     * @return SousEtat
     */
    public function setReservationM(\Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationM = null)
    {
        $this->reservationM = $reservationM;

        return $this;
    }

    /**
     * Get reservationM
     *
     * @return \Back\BilletterieMaritimeBundle\Entity\MaritimeReservation 
     */
    public function getReservationM()
    {
        return $this->reservationM;
    }

    /**
     * Set user
     *
     * @param \Back\UserBundle\Entity\User $user
     * @return SousEtat
     */
    public function setUser(\Back\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Back\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set reservationBE
     *
     * @param \Back\BienEtreBundle\Entity\Reservation $reservationBE
     * @return SousEtat
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
     * @return SousEtat
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
     * @return SousEtat
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

    /**
     * Set reservationDivers
     *
     * @param \Back\ReservationDiversBundle\Entity\Reservation $reservationDivers
     * @return SousEtat
     */
    public function setReservationDivers(\Back\ReservationDiversBundle\Entity\Reservation $reservationDivers = null)
    {
        $this->reservationDivers = $reservationDivers;

        return $this;
    }

    /**
     * Get reservationDivers
     *
     * @return \Back\ReservationDiversBundle\Entity\Reservation 
     */
    public function getReservationDivers()
    {
        return $this->reservationDivers;
    }
}
