<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pack
 *
 * @ORM\Table(name="ost_vo_packs")
 * @ORM\Entity(repositoryClass="Back\VoyageOrganiseBundle\Entity\Repository\PackRepository")
 */
class Pack
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
     * @ORM\ManyToMany(targetEntity="Hotel")
     * @ORM\JoinTable(name="ost_vo_voyages_packs_hotels")
     */
    private $hotels;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="singleAchat", type="decimal", precision=11 ,scale=3)
     */
    private $singleAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="singleVente", type="decimal", precision=11 ,scale=3)
     */
    private $singleVente;

    /**
     * @var string
     *
     * @ORM\Column(name="doubleAchat", type="decimal", precision=11 ,scale=3)
     */
    private $doubleAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="doubleVente", type="decimal", precision=11 ,scale=3)
     */
    private $doubleVente;

    /**
     * @var string
     *
     * @ORM\Column(name="tripleAchat", type="decimal", precision=11 ,scale=3)
     */
    private $tripleAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="tripleVente", type="decimal", precision=11 ,scale=3)
     */
    private $tripleVente;

    /**
     * @var string
     *
     * @ORM\Column(name="quadrupleAchat", type="decimal", precision=11 ,scale=3)
     */
    private $quadrupleAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="quadrupleVente", type="decimal", precision=11 ,scale=3)
     */
    private $quadrupleVente;

    /**
     * @var string
     *
     * @ORM\Column(name="enfantAchat", type="decimal", precision=11 ,scale=3)
     */
    private $enfantAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="enfantVente", type="decimal", precision=11 ,scale=3)
     */
    private $enfantVente;
    
    /**
     * @ORM\ManyToOne(targetEntity="Periode", inversedBy="packs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $periode;

    /**
     * @ORM\OneToMany(targetEntity="Ligne", mappedBy="pack",cascade={"persist"})
     */
    private $supplements;


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
     * @return Pack
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
     * Set singleAchat
     *
     * @param string $singleAchat
     * @return Pack
     */
    public function setSingleAchat($singleAchat)
    {
        $this->singleAchat = $singleAchat;

        return $this;
    }

    /**
     * Get singleAchat
     *
     * @return string 
     */
    public function getSingleAchat()
    {
        return $this->singleAchat;
    }

    /**
     * Set singleVente
     *
     * @param string $singleVente
     * @return Pack
     */
    public function setSingleVente($singleVente)
    {
        $this->singleVente = $singleVente;

        return $this;
    }

    /**
     * Get singleVente
     *
     * @return string 
     */
    public function getSingleVente()
    {
        return $this->singleVente;
    }

    /**
     * Set doubleAchat
     *
     * @param string $doubleAchat
     * @return Pack
     */
    public function setDoubleAchat($doubleAchat)
    {
        $this->doubleAchat = $doubleAchat;

        return $this;
    }

    /**
     * Get doubleAchat
     *
     * @return string 
     */
    public function getDoubleAchat()
    {
        return $this->doubleAchat;
    }

    /**
     * Set doubleVente
     *
     * @param string $doubleVente
     * @return Pack
     */
    public function setDoubleVente($doubleVente)
    {
        $this->doubleVente = $doubleVente;

        return $this;
    }

    /**
     * Get doubleVente
     *
     * @return string 
     */
    public function getDoubleVente()
    {
        return $this->doubleVente;
    }

    /**
     * Set tripleAchat
     *
     * @param string $tripleAchat
     * @return Pack
     */
    public function setTripleAchat($tripleAchat)
    {
        $this->tripleAchat = $tripleAchat;

        return $this;
    }

    /**
     * Get tripleAchat
     *
     * @return string 
     */
    public function getTripleAchat()
    {
        return $this->tripleAchat;
    }

    /**
     * Set tripleVente
     *
     * @param string $tripleVente
     * @return Pack
     */
    public function setTripleVente($tripleVente)
    {
        $this->tripleVente = $tripleVente;

        return $this;
    }

    /**
     * Get tripleVente
     *
     * @return string 
     */
    public function getTripleVente()
    {
        return $this->tripleVente;
    }

    /**
     * Set quadrupleAchat
     *
     * @param string $quadrupleAchat
     * @return Pack
     */
    public function setQuadrupleAchat($quadrupleAchat)
    {
        $this->quadrupleAchat = $quadrupleAchat;

        return $this;
    }

    /**
     * Get quadrupleAchat
     *
     * @return string 
     */
    public function getQuadrupleAchat()
    {
        return $this->quadrupleAchat;
    }

    /**
     * Set quadrupleVente
     *
     * @param string $quadrupleVente
     * @return Pack
     */
    public function setQuadrupleVente($quadrupleVente)
    {
        $this->quadrupleVente = $quadrupleVente;

        return $this;
    }

    /**
     * Get quadrupleVente
     *
     * @return string 
     */
    public function getQuadrupleVente()
    {
        return $this->quadrupleVente;
    }

    /**
     * Set enfantAchat
     *
     * @param string $enfantAchat
     * @return Pack
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
     * @return Pack
     */
    public function setEnfantVente($enfantVente)
    {
        $this->enfantVente = abs($enfantVente);

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
     * Set voyage
     *
     * @param \Back\VoyageOrganiseBundle\Entity\VoyageOrganise $voyage
     * @return Pack
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
     * Constructor
     */
    public function __construct()
    {
        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add hotels
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Hotel $hotels
     * @return Pack
     */
    public function addHotel(\Back\VoyageOrganiseBundle\Entity\Hotel $hotels)
    {
        $this->hotels[] = $hotels;

        return $this;
    }

    /**
     * Remove hotels
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Hotel $hotels
     */
    public function removeHotel(\Back\VoyageOrganiseBundle\Entity\Hotel $hotels)
    {
        $this->hotels->removeElement($hotels);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * Set periode
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Periode $periode
     * @return Pack
     */
    public function setPeriode(\Back\VoyageOrganiseBundle\Entity\Periode $periode = null)
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * Get periode
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Periode 
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Add supplements
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Ligne $supplements
     * @return Pack
     */
    public function addSupplement(\Back\VoyageOrganiseBundle\Entity\Ligne $supplements)
    {
        $this->supplements[] = $supplements;

        return $this;
    }

    /**
     * Remove supplements
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Ligne $supplements
     */
    public function removeSupplement(\Back\VoyageOrganiseBundle\Entity\Ligne $supplements)
    {
        $this->supplements->removeElement($supplements);
    }

    /**
     * Get supplements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSupplements()
    {
        return $this->supplements;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }
}
