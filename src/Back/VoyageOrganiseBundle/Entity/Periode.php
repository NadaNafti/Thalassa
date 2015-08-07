<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periode
 *
 * @ORM\Table(name="ost_vo_periodes")
 * @ORM\Entity
 */
class Periode
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
     * @ORM\Column(name="prix", type="decimal", precision=11 ,scale=3 )
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="depart", type="date")
     */
    private $depart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="retour", type="date")
     */
    private $retour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debutInscription", type="date")
     */
    private $debutInscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finInscription", type="date")
     */
    private $finInscription;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreInscription", type="integer")
     */
    private $nombreInscription;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreInscriptionInitiale", type="integer")
     */
    private $nombreInscriptionInitiale;

    /**
     * @var integer
     *
     * @ORM\Column(name="min", type="integer")
     */
    private $min;

    /**
     * @var integer
     *
     * @ORM\Column(name="max", type="integer")
     */
    private $max;

    /**
     * @var boolean
     *
     * @ORM\Column(name="departGarantie", type="boolean" , nullable=true)
     */
    private $departGarantie;

    /**
     * @ORM\ManyToOne(targetEntity="VoyageOrganise", inversedBy="periodes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $voyage;

    /**
     * @ORM\OneToMany(targetEntity="Pack", mappedBy="periode")
     */
    private $packs;

    /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="periodeC")
     */
    private $circuits;

    /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="periodeF")
     */
    private $frais;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nombreInscription = 0;
        $this->nombreInscriptionInitiale = 0;
        $this->departGarantie = FALSE;
        $this->packs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->circuits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frais = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Periode
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
     * Set prix
     *
     * @param string $prix
     * @return Periode
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set depart
     *
     * @param \DateTime $depart
     * @return Periode
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return \DateTime 
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set retour
     *
     * @param \DateTime $retour
     * @return Periode
     */
    public function setRetour($retour)
    {
        $this->retour = $retour;

        return $this;
    }

    /**
     * Get retour
     *
     * @return \DateTime 
     */
    public function getRetour()
    {
        return $this->retour;
    }

    /**
     * Set debutInscription
     *
     * @param \DateTime $debutInscription
     * @return Periode
     */
    public function setDebutInscription($debutInscription)
    {
        $this->debutInscription = $debutInscription;

        return $this;
    }

    /**
     * Get debutInscription
     *
     * @return \DateTime 
     */
    public function getDebutInscription()
    {
        return $this->debutInscription;
    }

    /**
     * Set finInscription
     *
     * @param \DateTime $finInscription
     * @return Periode
     */
    public function setFinInscription($finInscription)
    {
        $this->finInscription = $finInscription;

        return $this;
    }

    /**
     * Get finInscription
     *
     * @return \DateTime 
     */
    public function getFinInscription()
    {
        return $this->finInscription;
    }

    /**
     * Set nombreInscription
     *
     * @param integer $nombreInscription
     * @return Periode
     */
    public function setNombreInscription($nombreInscription)
    {
        $this->nombreInscription = $nombreInscription;

        return $this;
    }

    /**
     * Get nombreInscription
     *
     * @return integer 
     */
    public function getNombreInscription()
    {
        return $this->nombreInscription;
    }

    /**
     * Set min
     *
     * @param integer $min
     * @return Periode
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return integer 
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set max
     *
     * @param integer $max
     * @return Periode
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return integer 
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set departGarantie
     *
     * @param boolean $departGarantie
     * @return Periode
     */
    public function setDepartGarantie($departGarantie)
    {
        $this->departGarantie = $departGarantie;

        return $this;
    }

    /**
     * Get departGarantie
     *
     * @return boolean 
     */
    public function getDepartGarantie()
    {
        return $this->departGarantie;
    }

    /**
     * Set voyage
     *
     * @param \Back\VoyageOrganiseBundle\Entity\VoyageOrganise $voyage
     * @return Periode
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
     * Add packs
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Pack $packs
     * @return Periode
     */
    public function addPack(\Back\VoyageOrganiseBundle\Entity\Pack $packs)
    {
        $this->packs[] = $packs;

        return $this;
    }

    /**
     * Remove packs
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Pack $packs
     */
    public function removePack(\Back\VoyageOrganiseBundle\Entity\Pack $packs)
    {
        $this->packs->removeElement($packs);
    }

    /**
     * Get packs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPacks()
    {
        return $this->packs;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Add circuits
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Ligne $circuits
     * @return Periode
     */
    public function addCircuit(\Back\VoyageOrganiseBundle\Entity\Ligne $circuits)
    {
        $this->circuits[] = $circuits;

        return $this;
    }

    /**
     * Remove circuits
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Ligne $circuits
     */
    public function removeCircuit(\Back\VoyageOrganiseBundle\Entity\Ligne $circuits)
    {
        $this->circuits->removeElement($circuits);
    }

    /**
     * Get circuits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCircuits()
    {
        return $this->circuits;
    }

    /**
     * Add frais
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Ligne $frais
     * @return Periode
     */
    public function addFrai(\Back\VoyageOrganiseBundle\Entity\Ligne $frais)
    {
        $this->frais[] = $frais;

        return $this;
    }

    /**
     * Remove frais
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Ligne $frais
     */
    public function removeFrai(\Back\VoyageOrganiseBundle\Entity\Ligne $frais)
    {
        $this->frais->removeElement($frais);
    }

    /**
     * Get frais
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFrais()
    {
        return $this->frais;
    }

    /**
     * Set nombreInscriptionInitiale
     *
     * @param integer $nombreInscriptionInitiale
     * @return Periode
     */
    public function setNombreInscriptionInitiale($nombreInscriptionInitiale)
    {
        $this->nombreInscriptionInitiale = $nombreInscriptionInitiale;

        return $this;
    }

    /**
     * Get nombreInscriptionInitiale
     *
     * @return integer 
     */
    public function getNombreInscriptionInitiale()
    {
        return $this->nombreInscriptionInitiale;
    }

    public function isValide()
    {
        if (count($this->packs)>0  && $this->getDebutInscription()->format('Y-m-d') <= date('Y-m-d') && $this->getFinInscription()->format('Y-m-d') >= date('Y-m-d') && ($this->getDepartGarantie() || $this->getNombreInscription() < $this->getMax()))
            return true;
        return false;
    }

}
