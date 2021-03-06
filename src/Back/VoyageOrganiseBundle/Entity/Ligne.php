<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligne
 *
 * @ORM\Table(name="ost_vo_ligne")
 * @ORM\Entity(repositoryClass="Back\VoyageOrganiseBundle\Entity\Repository\LigneRepository")
 */
class Ligne
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="adulteAchat", type="decimal", precision=11 ,scale=3)
     */
    private $adulteAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="adulteVente", type="decimal", precision=11 ,scale=3)
     */
    private $adulteVente;

    /**
     * @var string
     *
     * @ORM\Column(name="enfantAchat", type="decimal", precision=11 ,scale=3, nullable=true)
     */
    private $enfantAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="enfantVente", type="decimal", precision=11 ,scale=3, nullable=true)
     */
    private $enfantVente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obligatoire", type="boolean" , nullable=true)
     */
    private $obligatoire;

    /**
     * @ORM\ManyToOne(targetEntity="Pack", inversedBy="supplements")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $pack;

    /**
     * @ORM\ManyToOne(targetEntity="Periode", inversedBy="circuits")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $periodeC;

    /**
     * @ORM\ManyToOne(targetEntity="Periode", inversedBy="frais")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $periodeF;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enfantAchat = 0;
        $this->enfantVente = 0;
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
     * Set libelle
     *
     * @param string $libelle
     * @return Ligne
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set adulteAchat
     *
     * @param string $adulteAchat
     * @return Ligne
     */
    public function setAdulteAchat($adulteAchat)
    {
        $this->adulteAchat = $adulteAchat;

        return $this;
    }

    /**
     * Get adulteAchat
     *
     * @return string 
     */
    public function getAdulteAchat()
    {
        return $this->adulteAchat;
    }

    /**
     * Set adulteVente
     *
     * @param string $adulteVente
     * @return Ligne
     */
    public function setAdulteVente($adulteVente)
    {
        $this->adulteVente = $adulteVente;

        return $this;
    }

    /**
     * Get adulteVente
     *
     * @return string 
     */
    public function getAdulteVente()
    {
        return $this->adulteVente;
    }

    /**
     * Set enfantAchat
     *
     * @param string $enfantAchat
     * @return Ligne
     */
    public function setEnfantAchat($enfantAchat)
    {
        $this->enfantAchat = $enfantAchat;

        return $this;
    }

    /**
     * Get enfantAchat
     *
     * @return string 
     */
    public function getEnfantAchat()
    {
        return $this->enfantAchat;
    }

    /**
     * Set enfantVente
     *
     * @param string $enfantVente
     * @return Ligne
     */
    public function setEnfantVente($enfantVente)
    {
        $this->enfantVente = $enfantVente;

        return $this;
    }

    /**
     * Get enfantVente
     *
     * @return string 
     */
    public function getEnfantVente()
    {
        return $this->enfantVente;
    }

    /**
     * Set obligatoire
     *
     * @param boolean $obligatoire
     * @return Ligne
     */
    public function setObligatoire($obligatoire)
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    /**
     * Get obligatoire
     *
     * @return boolean 
     */
    public function getObligatoire()
    {
        return $this->obligatoire;
    }

    /**
     * Set pack
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Pack $pack
     * @return Ligne
     */
    public function setPack(\Back\VoyageOrganiseBundle\Entity\Pack $pack = null)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Pack 
     */
    public function getPack()
    {
        return $this->pack;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Set periodeC
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Periode $periodeC
     * @return Ligne
     */
    public function setPeriodeC(\Back\VoyageOrganiseBundle\Entity\Periode $periodeC = null)
    {
        $this->periodeC = $periodeC;

        return $this;
    }

    /**
     * Get periodeC
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Periode 
     */
    public function getPeriodeC()
    {
        return $this->periodeC;
    }

    /**
     * Set periodeF
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Periode $periodeF
     * @return Ligne
     */
    public function setPeriodeF(\Back\VoyageOrganiseBundle\Entity\Periode $periodeF = null)
    {
        $this->periodeF = $periodeF;

        return $this;
    }

    /**
     * Get periodeF
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Periode 
     */
    public function getPeriodeF()
    {
        return $this->periodeF;
    }

}
