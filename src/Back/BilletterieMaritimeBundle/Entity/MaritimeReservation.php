<?php

namespace Back\BilletterieMaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MaritimeReservation
 *
 * @ORM\Table(name="ost_maritime_reservation")
 * @ORM\Entity(repositoryClass="Back\BilletterieMaritimeBundle\Entity\Repository\MaritimeReservationRepository")
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
     * @ORM\OneToMany(targetEntity="Back\AdministrationBundle\Entity\SousEtat", mappedBy="reservationM")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $sousEtats;

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
     * @var string
     *
     * @ORM\Column(name="timbre", type="decimal", precision=2, scale=1,nullable=true)
     */
    private $timbre;

    /**
     * @var string
     *
     * @ORM\Column(name="remise", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $remise;

    /**
     * @var string
     *
     * @ORM\Column(name="total_achat", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $totalAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="total_vente", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $totalVente;


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
        $this->remise=0;
        $this->timbre=0;
        $this->totalAchat=0;
        $this->totalVente=0;
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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return MaritimeReservation
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
     * @return MaritimeReservation
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

    public function showEtat()
    {
        if($this->etat == 1)
            return 'Enregistrée';
        if($this->etat == 2)
            return 'Validée';
        if($this->etat == 9)
            return 'Annulée';
    }

    /**
     * Add sousEtats
     *
     * @param \Back\AdministrationBundle\Entity\SousEtat $sousEtats
     * @return MaritimeReservation
     */
    public function addSousEtat(\Back\AdministrationBundle\Entity\SousEtat $sousEtats)
    {
        $this->sousEtats[] = $sousEtats;

        return $this;
    }

    /**
     * Remove sousEtats
     *
     * @param \Back\AdministrationBundle\Entity\SousEtat $sousEtats
     */
    public function removeSousEtat(\Back\AdministrationBundle\Entity\SousEtat $sousEtats)
    {
        $this->sousEtats->removeElement($sousEtats);
    }

    /**
     * Get sousEtats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSousEtats()
    {
        return $this->sousEtats;
    }

    public function __toString()
    {
        return "Reservation : ".$this->getId();
    }

    /**
     * Set timbre
     *
     * @param string $timbre
     * @return MaritimeReservation
     */
    public function setTimbre($timbre)
    {
        $this->timbre = $timbre;

        return $this;
    }

    /**
     * Get timbre
     *
     * @return string 
     */
    public function getTimbre()
    {
        return $this->timbre;
    }

    /**
     * Set remise
     *
     * @param string $remise
     * @return MaritimeReservation
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return string 
     */
    public function getRemise()
    {
        return $this->remise;
    }



    public function getMontantRegle()
    {
        $montant = 0;
        foreach ($this->reglements as $reglement)
            $montant += $reglement->getMontant();
        return number_format($montant, 3, '.', '');
    }

    public function getMontantRestant()
    {
        return number_format($this->getTotal() - $this->getMontantRegle(), 3, '.', '');
    }

    public function getTotal()
    {
        return number_format($this->totalVente+$this->timbre-$this->remise, 3, '.', '');
    }

    /**
     * Set totalAchat
     *
     * @param string $totalAchat
     * @return MaritimeReservation
     */
    public function setTotalAchat($totalAchat)
    {
        $this->totalAchat = $totalAchat;

        return $this;
    }

    /**
     * Get totalAchat
     *
     * @return string 
     */
    public function getTotalAchat()
    {
        return $this->totalAchat;
    }

    /**
     * Set totalVente
     *
     * @param string $totalVente
     * @return MaritimeReservation
     */
    public function setTotalVente($totalVente)
    {
        $this->totalVente = $totalVente;

        return $this;
    }

    /**
     * Get totalVente
     *
     * @return string 
     */
    public function getTotalVente()
    {
        return $this->totalVente;
    }
}
