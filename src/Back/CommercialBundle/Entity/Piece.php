<?php

namespace Back\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="numero", type="string", length=255,nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="param", type="string", length=255,nullable=true)
     */
    private $param;

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
     * @Assert\Range(min = 1)
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
     * @var boolean
     *
     * @ORM\Column(name="regle", type="boolean",nullable=true)
     */
    private $regle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReglement", type="date",nullable=true)
     */
    private $dateReglement;

    /**
     * @ORM\OneToMany(targetEntity="Reglement", mappedBy="piece")
     */
    protected $reglements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numero
     *
     * @param string $numero
     * @return Piece
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

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
     * Set modeReglement
     *
     * @param string $modeReglement
     * @return Piece
     */
    public function setModeReglement($modeReglement)
    {
        $this->modeReglement = $modeReglement;

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
        $this->dateEcheance = $dateEcheance;

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
        $this->montantOrigine = $montantOrigine;

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
     * Set regle
     *
     * @param boolean $regle
     * @return Piece
     */
    public function setRegle($regle)
    {
        $this->regle = $regle;

        return $this;
    }

    /**
     * Get regle
     *
     * @return boolean 
     */
    public function getRegle()
    {
        return $this->regle;
    }

    /**
     * Set dateReglement
     *
     * @param \DateTime $dateReglement
     * @return Piece
     */
    public function setDateReglement($dateReglement)
    {
        $this->dateReglement = $dateReglement;

        return $this;
    }

    /**
     * Get dateReglement
     *
     * @return \DateTime 
     */
    public function getDateReglement()
    {
        return $this->dateReglement;
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

    public function showModeReglement()
    {
        if ($this->modeReglement == "AD")
            return "Autorisation de débit";
        if ($this->modeReglement == "PE")
            return "Paiement électronique";
        if ($this->modeReglement == "PC")
            return "Pris en charge";
        if ($this->modeReglement == "CB")
            return "Carte Bancaire";
        if ($this->modeReglement == "C")
            return "Chèque";
        if ($this->modeReglement == "E")
            return "Espece";
        if ($this->modeReglement == "V")
            return "Virement";
    }

    public function __toString()
    {
        return $this->numero .' '.$this->montantOrigine.' DT';
    }


    /**
     * Set param
     *
     * @param string $param
     * @return Piece
     */
    public function setParam($param)
    {
        $this->param = $param;

        return $this;
    }

    /**
     * Get param
     *
     * @return string 
     */
    public function getParam()
    {
        return $this->param;
    }
}
