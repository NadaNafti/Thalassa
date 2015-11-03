<?php

namespace Back\ReservationDiversBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ReservationLigne
 *
 * @ORM\Table(name="ost_divers_reservation_ligne")
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Back\ReservationDiversBundle\Entity\Reservation", inversedBy="lignes")
     */
    protected $reservation ;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationLigne", inversedBy="fils")
     */
    protected $parent ;

    /**
     * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="parent")
     */

    protected $fils ;

    /**
     * @ORM\ManyToOne(targetEntity="Back\AdministrationBundle\Entity\Produit")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    protected $produit ;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation ;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite ;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrAdulte", type="integer")
     */
    private $nbrAdulte ;

    /**
     * @var string
     *
     * @ORM\Column(name="puhtAdulte", type="decimal", precision=11, scale=3)
     */
    private $puhtAdulte ;

    /**
     * @var string
     *
     * @ORM\Column(name="puttAdulte", type="decimal", precision=11, scale=3)
     */
    private $puttAdulte ;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrEnfant", type="integer",nullable=true)
     */
    private $nbrEnfant ;

    /**
     * @var string
     *
     * @ORM\Column(name="puhtEnfant", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $puhtEnfant ;

    /**
     * @var string
     *
     * @ORM\Column(name="puttEnfant", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $puttEnfant ;

    /**
     * @var integer
     *
     * @ORM\Column(name="tauxTva", type="integer")
     */
    private $tauxTva ;

    /**
     * @var string
     *
     * @ORM\Column(name="montantRemise", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $montantRemise ;


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
     * Constructor
     */
    public function __construct()
    {
        $this->fils = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return ReservationLigne
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return ReservationLigne
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set nbrAdulte
     *
     * @param integer $nbrAdulte
     * @return ReservationLigne
     */
    public function setNbrAdulte($nbrAdulte)
    {
        $this->nbrAdulte = $nbrAdulte;

        return $this;
    }

    /**
     * Get nbrAdulte
     *
     * @return integer 
     */
    public function getNbrAdulte()
    {
        return $this->nbrAdulte;
    }

    /**
     * Set puhtAdulte
     *
     * @param string $puhtAdulte
     * @return ReservationLigne
     */
    public function setPuhtAdulte($puhtAdulte)
    {
        $this->puhtAdulte = $puhtAdulte;

        return $this;
    }

    /**
     * Get puhtAdulte
     *
     * @return string 
     */
    public function getPuhtAdulte()
    {
        return $this->puhtAdulte;
    }

    /**
     * Set puttAdulte
     *
     * @param string $puttAdulte
     * @return ReservationLigne
     */
    public function setPuttAdulte($puttAdulte)
    {
        $this->puttAdulte = $puttAdulte;

        return $this;
    }

    /**
     * Get puttAdulte
     *
     * @return string 
     */
    public function getPuttAdulte()
    {
        return $this->puttAdulte;
    }

    /**
     * Set nbrEnfant
     *
     * @param integer $nbrEnfant
     * @return ReservationLigne
     */
    public function setNbrEnfant($nbrEnfant)
    {
        $this->nbrEnfant = $nbrEnfant;

        return $this;
    }

    /**
     * Get nbrEnfant
     *
     * @return integer 
     */
    public function getNbrEnfant()
    {
        return $this->nbrEnfant;
    }

    /**
     * Set puhtEnfant
     *
     * @param string $puhtEnfant
     * @return ReservationLigne
     */
    public function setPuhtEnfant($puhtEnfant)
    {
        $this->puhtEnfant = $puhtEnfant;

        return $this;
    }

    /**
     * Get puhtEnfant
     *
     * @return string 
     */
    public function getPuhtEnfant()
    {
        return $this->puhtEnfant;
    }

    /**
     * Set puttEnfant
     *
     * @param string $puttEnfant
     * @return ReservationLigne
     */
    public function setPuttEnfant($puttEnfant)
    {
        $this->puttEnfant = $puttEnfant;

        return $this;
    }

    /**
     * Get puttEnfant
     *
     * @return string 
     */
    public function getPuttEnfant()
    {
        return $this->puttEnfant;
    }

    /**
     * Set tauxTva
     *
     * @param integer $tauxTva
     * @return ReservationLigne
     */
    public function setTauxTva($tauxTva)
    {
        $this->tauxTva = $tauxTva;

        return $this;
    }

    /**
     * Get tauxTva
     *
     * @return integer 
     */
    public function getTauxTva()
    {
        return $this->tauxTva;
    }

    /**
     * Set montantRemise
     *
     * @param string $montantRemise
     * @return ReservationLigne
     */
    public function setMontantRemise($montantRemise)
    {
        $this->montantRemise = $montantRemise;

        return $this;
    }

    /**
     * Get montantRemise
     *
     * @return string 
     */
    public function getMontantRemise()
    {
        return $this->montantRemise;
    }

    /**
     * Set reservation
     *
     * @param \Back\ReservationDiversBundle\Entity\Reservation $reservation
     * @return ReservationLigne
     */
    public function setReservation(\Back\ReservationDiversBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Back\ReservationDiversBundle\Entity\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set parent
     *
     * @param \Back\ReservationDiversBundle\Entity\ReservationLigne $parent
     * @return ReservationLigne
     */
    public function setParent(\Back\ReservationDiversBundle\Entity\ReservationLigne $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Back\ReservationDiversBundle\Entity\ReservationLigne 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add fils
     *
     * @param \Back\ReservationDiversBundle\Entity\ReservationLigne $fils
     * @return ReservationLigne
     */
    public function addFil(\Back\ReservationDiversBundle\Entity\ReservationLigne $fils)
    {
        $this->fils[] = $fils;

        return $this;
    }

    /**
     * Remove fils
     *
     * @param \Back\ReservationDiversBundle\Entity\ReservationLigne $fils
     */
    public function removeFil(\Back\ReservationDiversBundle\Entity\ReservationLigne $fils)
    {
        $this->fils->removeElement($fils);
    }

    /**
     * Get fils
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFils()
    {
        return $this->fils;
    }

    /**
     * Set produit
     *
     * @param \Back\AdministrationBundle\Entity\Produit $produit
     * @return ReservationLigne
     */
    public function setProduit(\Back\AdministrationBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Back\AdministrationBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    public function getMontantNonTaxable()
    {
        return ((($this->getPuhtAdulte() * $this->getNbrAdulte()) + ($this->getPuhtEnfant() * $this->getNbrEnfant())) * $this->getQuantite()) ;
    }

    public function getMontantTaxable()
    {
        return ((($this->getPuttAdulte() * $this->getNbrAdulte()) + ($this->getPuttEnfant() * $this->getNbrEnfant())) * $this->getQuantite()) -  $this->montantNonTaxable;
    }

    public function getTva()
    {
        return $this->getMontantTaxable()-(($this->getMontantTaxable()*100)/($this->tauxTva+100)) ;
    }

    public function getTotal()
    {
        return $this->getMontantNonTaxable()+$this->getMontantTaxable()-$this->montantRemise;
    }
}
