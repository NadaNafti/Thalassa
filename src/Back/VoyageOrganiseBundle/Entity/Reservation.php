<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="ost_vo_reservations")
 * @ORM\Entity(repositoryClass="Back\VoyageOrganiseBundle\Entity\ReservationRepository")
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
     * @ORM\Column(name="code", type="string",nullable=true)
     */
    private $code;

    /**
     * @var integer
     *
     * 1:Enregistrée
     * 2:Validée
     * 9:Annulée
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\User")
     */
    protected $responsable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="frontOffice", type="boolean", nullable=true)
     */
    private $frontOffice;

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
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=11 ,scale=3 ,nullable=true)
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validated", type="datetime" ,nullable=true)
     */
    private $validated;

    /**
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservationVO")
     */
    protected $reglements;

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
     * @var array
     *
     * @ORM\Column(name="coordonnees", type="array")
     */
    private $coordonnees;

    /**
     * Constructor
     */
    public function __construct()
    {
	$this->frontOffice=false;
	$this->etat = 1;
	$this->coordonnees = array();
	$this->adultes = new \Doctrine\Common\Collections\ArrayCollection();
	$this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Set code
     *
     * @param string $code
     * @return Reservation
     */
    public function setCode($code)
    {
	$this->code = $code;

	return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
	return $this->code;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Reservation
     */
    public function setEtat($etat)
    {
	$this->etat = $etat;

	return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
	return $this->etat;
    }

    /**
     * Set frontOffice
     *
     * @param boolean $frontOffice
     * @return Reservation
     */
    public function setFrontOffice($frontOffice)
    {
	$this->frontOffice = $frontOffice;

	return $this;
    }

    /**
     * Get frontOffice
     *
     * @return boolean 
     */
    public function getFrontOffice()
    {
	return $this->frontOffice;
    }

    /**
     * Set validated
     *
     * @param \DateTime $validated
     * @return Reservation
     */
    public function setValidated($validated)
    {
	$this->validated = $validated;

	return $this;
    }

    /**
     * Get validated
     *
     * @return \DateTime 
     */
    public function getValidated()
    {
	return $this->validated;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Reservation
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

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Reservation
     */
    public function setUpdated($updated)
    {
	$this->updated = $updated;

	return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
	return $this->updated;
    }

    /**
     * Set responsable
     *
     * @param \Back\UserBundle\Entity\User $responsable
     * @return Reservation
     */
    public function setResponsable(\Back\UserBundle\Entity\User $responsable = null)
    {
	$this->responsable = $responsable;

	return $this;
    }

    /**
     * Get responsable
     *
     * @return \Back\UserBundle\Entity\User 
     */
    public function getResponsable()
    {
	return $this->responsable;
    }

    /**
     * Add reglements
     *
     * @param \Back\CommercialBundle\Entity\Reglement $reglements
     * @return Reservation
     */
    public function addReglement(\Back\CommercialBundle\Entity\Reglement $reglements)
    {
	$this->reglements[] = $reglements;

	return $this;
    }

    /**
     * Remove reglements
     *
     * @param \Back\CommercialBundle\Entity\Reglement $reglements
     */
    public function removeReglement(\Back\CommercialBundle\Entity\Reglement $reglements)
    {
	$this->reglements->removeElement($reglements);
    }

    /**
     * Get reglements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReglements()
    {
	return $this->reglements;
    }

    public function showEtat()
    {
	if ($this->etat == 1)
	    return 'Enregistrée';
	if ($this->etat == 2)
	    return 'Validée';
	if ($this->etat == 9)
	    return 'Annulée';
    }

    /**
     * Set total
     *
     * @param string $total
     * @return Reservation
     */
    public function setTotal($total)
    {
	$this->total = $total;

	return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
	return $this->total;
    }

    public function getMontantRegle()
    {
	$montant = 0;
	foreach ($this->reglements as $reglement)
	    $montant+=$reglement->getMontant();
	return number_format($montant, 3, '.', '');
    }

    public function getMontantRestant()
    {
	return number_format($this->total - $this->getMontantRegle(), 3, '.', '');
    }

    /**
     * Set coordonnees
     *
     * @param array $coordonnees
     * @return Reservation
     */
    public function setCoordonnees($coordonnees)
    {
	$this->coordonnees = $coordonnees;

	return $this;
    }

    /**
     * Get coordonnees
     *
     * @return array 
     */
    public function getCoordonnees()
    {
	return $this->coordonnees;
    }

}
