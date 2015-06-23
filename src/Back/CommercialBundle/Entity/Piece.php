<?php

namespace Back\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Piece
 *
 * @ORM\Table(name="ost_com_piece")
 * @ORM\Entity
 */
class Piece
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
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="pieces")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $client;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="modeReglement", type="string", length=4)
     */
    private $modeReglement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEcheance", type="date",nullable=true)
     */
    private $dateEcheance;

    /**
     * @var string
     *
     * @ORM\Column(name="montantOrigine", type="decimal", precision=11, scale=3)
     */
    private $montantOrigine;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", precision=11, scale=3)
     */
    private $montant;

    /**
     * @var integer
     * 1:validée,2:Terminée
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateValidation", type="date",nullable=true)
     */
    private $dateValidation;

    /**
     * @ORM\OneToMany(targetEntity="Reglement", mappedBy="piece")
     */
    protected $reglements;

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
     * Set numero
     *
     * @param string $numero
     * @return Piece
     */
    public function setNumero($numero)
    {
        $this->numero=$numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Piece
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation=$dateCreation;

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
     * Set modeReglement
     *
     * @param string $modeReglement
     * @return Piece
     */
    public function setModeReglement($modeReglement)
    {
        $this->modeReglement=$modeReglement;

        return $this;
    }

    /**
     * Get modeReglement
     *
     * @return string 
     */
    public function getModeReglement()
    {
        return $this->modeReglement;
    }

    /**
     * Set dateEcheance
     *
     * @param \DateTime $dateEcheance
     * @return Piece
     */
    public function setDateEcheance($dateEcheance)
    {
        $this->dateEcheance=$dateEcheance;

        return $this;
    }

    /**
     * Get dateEcheance
     *
     * @return \DateTime 
     */
    public function getDateEcheance()
    {
        return $this->dateEcheance;
    }

    /**
     * Set montantOrigine
     *
     * @param string $montantOrigine
     * @return Piece
     */
    public function setMontantOrigine($montantOrigine)
    {
        $this->montantOrigine=$montantOrigine;

        return $this;
    }

    /**
     * Get montantOrigine
     *
     * @return string 
     */
    public function getMontantOrigine()
    {
        return $this->montantOrigine;
    }

    /**
     * Set montant
     *
     * @param string $montant
     * @return Piece
     */
    public function setMontant($montant)
    {
        $this->montant=$montant;

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
     * Set etat
     *
     * @param integer $etat
     * @return Piece
     */
    public function setEtat($etat)
    {
        $this->etat=$etat;

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
     * Set dateValidation
     *
     * @param \DateTime $dateValidation
     * @return Piece
     */
    public function setDateValidation($dateValidation)
    {
        $this->dateValidation=$dateValidation;

        return $this;
    }

    /**
     * Get dateValidation
     *
     * @return \DateTime 
     */
    public function getDateValidation()
    {
        return $this->dateValidation;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return Piece
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
     * @return Piece
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
}
