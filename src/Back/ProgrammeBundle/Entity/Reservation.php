<?php
namespace Back\ProgrammeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="ost_pr_reservations")
 * @ORM\Entity(repositoryClass="Back\ProgrammeBundle\Entity\Repository\ReservationRepository")
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
     * @ORM\ManyToOne(targetEntity="Programme")
     * @Assert\NotBlank()
     */
    private $programme;

    /**
     * @ORM\ManyToOne(targetEntity="Periode")
     */
    private $periode;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="reservationsPR")
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
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservationPR")
     */
    protected $reglements;

    /**
     * @ORM\OneToMany(targetEntity="ReservationPersonne", mappedBy="reservationA")
     */
    protected $adultes;

    /**
     * @ORM\OneToMany(targetEntity="ReservationPersonne", mappedBy="reservationE")
     */
    protected $enfants;

    /**
     * @var array
     *
     * @ORM\Column(name="supplements", type="array")
     */
    private $supplements;

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
     * @ORM\OneToMany(targetEntity="Back\AdministrationBundle\Entity\SousEtat", mappedBy="reservationPR")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $sousEtats;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adultes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frontOffice = FALSE;
        $this->remise = 0;
        $this->timbre = 0;
        $this->etat = 1;
        $this->coordonnees = array();
        $this->supplements = array();
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
     * Set supplements
     *
     * @param array $supplements
     * @return Reservation
     */
    public function setSupplements($supplements)
    {
        $this->supplements = $supplements;
        return $this;
    }

    /**
     * Get supplements
     *
     * @return array
     */
    public function getSupplements()
    {
        return $this->supplements;
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

    /**
     * Set timbre
     *
     * @param string $timbre
     * @return Reservation
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
     * @return Reservation
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

    /**
     * Set responsable
     *
     * @param \Back\UserBundle\Entity\User $responsable
     * @return Reservation
     */
    public function setResponsable(\Back\UserBundle\Entity\User $responsable = NULL)
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
     * Set programme
     *
     * @param \Back\ProgrammeBundle\Entity\Programme $programme
     * @return Reservation
     */
    public function setProgramme(\Back\ProgrammeBundle\Entity\Programme $programme = NULL)
    {
        $this->programme = $programme;
        return $this;
    }

    /**
     * Get programme
     *
     * @return \Back\ProgrammeBundle\Entity\Programme
     */
    public function getProgramme()
    {
        return $this->programme;
    }

    /**
     * Set periode
     *
     * @param \Back\ProgrammeBundle\Entity\Periode $periode
     * @return Reservation
     */
    public function setPeriode(\Back\ProgrammeBundle\Entity\Periode $periode = NULL)
    {
        $this->periode = $periode;
        return $this;
    }

    /**
     * Get periode
     *
     * @return \Back\ProgrammeBundle\Entity\Periode
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return Reservation
     */
    public function setClient(\Back\UserBundle\Entity\Client $client = NULL)
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

    public function totalAchat()
    {
        $total = 0;
        foreach ($this->adultes as $adulte)
            $total += $adulte->getTotalLigneAchat();
        foreach ($this->enfants as $enfant)
            $total += $enfant->getTotalLigneAchat();
        return $total;
    }

    public function totalVente()
    {
        $total = 0;
        foreach ($this->adultes as $adulte)
            $total += $adulte->getTotalLigneVente();
        foreach ($this->enfants as $enfant)
            $total += $enfant->getTotalLigneVente();
        return $total;
    }

    public function getTotal()
    {
        return number_format($this->totalVente() + $this->timbre - $this->remise, 3, '.', '');
    }

    /**
     * Add adultes
     *
     * @param \Back\ProgrammeBundle\Entity\ReservationPersonne $adultes
     * @return Reservation
     */
    public function addAdulte(\Back\ProgrammeBundle\Entity\ReservationPersonne $adultes)
    {
        $this->adultes[] = $adultes;
        return $this;
    }

    /**
     * Remove adultes
     *
     * @param \Back\ProgrammeBundle\Entity\ReservationPersonne $adultes
     */
    public function removeAdulte(\Back\ProgrammeBundle\Entity\ReservationPersonne $adultes)
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
     * @param \Back\ProgrammeBundle\Entity\ReservationPersonne $enfants
     * @return Reservation
     */
    public function addEnfant(\Back\ProgrammeBundle\Entity\ReservationPersonne $enfants)
    {
        $this->enfants[] = $enfants;
        return $this;
    }

    /**
     * Remove enfants
     *
     * @param \Back\ProgrammeBundle\Entity\ReservationPersonne $enfants
     */
    public function removeEnfant(\Back\ProgrammeBundle\Entity\ReservationPersonne $enfants)
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

    public function showEtat()
    {
        if ($this->etat == 1)
            return 'Enregistrée';
        if ($this->etat == 2)
            return 'Validée';
        if ($this->etat == 9)
            return 'Annulée';
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

    public function getNombreOccupants()
    {
        return count($this->adultes) + count($this->enfants);
    }

    /**
     * Add sousEtats
     *
     * @param \Back\AdministrationBundle\Entity\SousEtat $sousEtats
     * @return Reservation
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
}
