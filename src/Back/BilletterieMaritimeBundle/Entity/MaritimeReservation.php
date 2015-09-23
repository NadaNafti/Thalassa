<?php

namespace Back\BilletterieMaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MaritimeReservation
 *
 * @ORM\Table(name="ost_maritime_reservation")
 * @ORM\Entity
 */
class MaritimeReservation
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
     * 1:Enregistr�e
     * 2:Valid�e
     * 9:Annul�e
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
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="reservationsVO")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $client;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validated", type="datetime" ,nullable=true)
     */
    private $validated;

    /**
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservationMaritime")
     */
    protected $reglements;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeVoyage", type="integer")
     */
    private $typeVoyage;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPrenom", type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=255)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculation", type="string", length=255)
     */
    private $matriculation;

    /**
     * @var integer
     *
     * @ORM\Column(name="passagers", type="integer")
     */
    private $passagers;

    /**
     * @var integer
     *
     * @ORM\Column(name="cabine", type="integer")
     */
    private $cabine;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuDepart", type="string", length=255)
     */
    private $lieuDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuArrivee", type="string", length=255)
     */
    private $lieuArrivee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="date")
     */
    private $dateDepart;


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
     * Set typeVoyage
     *
     * @param integer $typeVoyage
     * @return MaritimeReservation
     */
    public function setTypeVoyage($typeVoyage)
    {
        $this->typeVoyage = $typeVoyage;

        return $this;
    }

    /**
     * Get typeVoyage
     *
     * @return integer
     */
    public function getTypeVoyage()
    {
        return $this->typeVoyage;
    }

    /**
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return MaritimeReservation
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
     * Set email
     *
     * @param string $email
     * @return MaritimeReservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set cin
     *
     * @param string $cin
     * @return MaritimeReservation
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return MaritimeReservation
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set marque
     *
     * @param string $marque
     * @return MaritimeReservation
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set matriculation
     *
     * @param string $matriculation
     * @return MaritimeReservation
     */
    public function setMatriculation($matriculation)
    {
        $this->matriculation = $matriculation;

        return $this;
    }

    /**
     * Get matriculation
     *
     * @return string
     */
    public function getMatriculation()
    {
        return $this->matriculation;
    }

    /**
     * Set passagers
     *
     * @param integer $passagers
     * @return MaritimeReservation
     */
    public function setPassagers($passagers)
    {
        $this->passagers = $passagers;

        return $this;
    }

    /**
     * Get passagers
     *
     * @return integer
     */
    public function getPassagers()
    {
        return $this->passagers;
    }

    /**
     * Set cabine
     *
     * @param integer $cabine
     * @return MaritimeReservation
     */
    public function setCabine($cabine)
    {
        $this->cabine = $cabine;

        return $this;
    }

    /**
     * Get cabine
     *
     * @return integer
     */
    public function getCabine()
    {
        return $this->cabine;
    }

    /**
     * Set lieuDepart
     *
     * @param string $lieuDepart
     * @return MaritimeReservation
     */
    public function setLieuDepart($lieuDepart)
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    /**
     * Get lieuDepart
     *
     * @return string
     */
    public function getLieuDepart()
    {
        return $this->lieuDepart;
    }

    /**
     * Set lieuArrivee
     *
     * @param string $lieuArrivee
     * @return MaritimeReservation
     */
    public function setLieuArrivee($lieuArrivee)
    {
        $this->lieuArrivee = $lieuArrivee;

        return $this;
    }

    /**
     * Get lieuArrivee
     *
     * @return string
     */
    public function getLieuArrivee()
    {
        return $this->lieuArrivee;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     * @return MaritimeReservation
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return MaritimeReservation
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
     * @return MaritimeReservation
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
     * Set commentaire
     *
     * @param string $commentaire
     * @return MaritimeReservation
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
     * Set validated
     *
     * @param \DateTime $validated
     * @return MaritimeReservation
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
     * Set responsable
     *
     * @param \Back\UserBundle\Entity\User $responsable
     * @return MaritimeReservation
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
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return MaritimeReservation
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
     * Add reglements
     *
     * @param \Back\CommercialBundle\Entity\Reglement $reglements
     * @return MaritimeReservation
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

    public function showTypeVoyage()
    {
        if ($this->typeVoyage == 1)
            return "Aller-Retour";
        if ($this->typeVoyage == 2)
            return "Aller-Simple";
    }

    public function showPassagers()
    {
        if ($this->passagers == 1)
            return "Résident";
        if ($this->passagers == 2)
            return "Non-Résident";
        if ($this->passagers == 3)
            return "Diplomat";
        if ($this->passagers == 4)
            return "Etudiant";
    }

    public function showCabine()
    {
        if ($this->cabine == 1)
            return "Fauteuille";
        if ($this->cabine == 1)
            return "Cabinet-Exterieur";
        if ($this->cabine == 1)
            return "Cabinet-Interieur";
        if ($this->cabine == 1)
            return "Suite";
    }
}
