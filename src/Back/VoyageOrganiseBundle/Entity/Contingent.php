<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contingent
 *
 * @ORM\Table(name="ost_vo_contingents")
 * @ORM\Entity
 */
class Contingent
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
     * @ORM\ManyToOne(targetEntity="VoyageOrganise", inversedBy="contingents")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $voyage;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel")
     */
    protected $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="Pack")
     */
    protected $pack;

    /**
     * @var integer
     *
     * @ORM\Column(name="chambreSingle", type="integer")
     */
    private $chambreSingle;

    /**
     * @var integer
     *
     * @ORM\Column(name="chambreDouble", type="integer")
     */
    private $chambreDouble;

    /**
     * @var integer
     *
     * @ORM\Column(name="chambreQuadruple", type="integer")
     */
    private $chambreQuadruple;

    /**
     * @var integer
     *
     * @ORM\Column(name="chambreTriple", type="integer")
     */
    private $chambreTriple;

    /**
     * @ORM\OneToMany(targetEntity="Chambre", mappedBy="contingent")
     */
    private $chambres;

    public function __construct()
    {
        $this->chambreDouble=0;
        $this->chambreSingle=0;
        $this->chambreTriple=0;
        $this->chambreQuadruple=0;
        $this->chambres=new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set chambreSingle
     *
     * @param integer $chambreSingle
     * @return Contingent
     */
    public function setChambreSingle($chambreSingle)
    {
        $this->chambreSingle = $chambreSingle;

        return $this;
    }

    /**
     * Get chambreSingle
     *
     * @return integer 
     */
    public function getChambreSingle()
    {
        return $this->chambreSingle;
    }

    /**
     * Set chambreDouble
     *
     * @param integer $chambreDouble
     * @return Contingent
     */
    public function setChambreDouble($chambreDouble)
    {
        $this->chambreDouble = $chambreDouble;

        return $this;
    }

    /**
     * Get chambreDouble
     *
     * @return integer 
     */
    public function getChambreDouble()
    {
        return $this->chambreDouble;
    }

    /**
     * Set chambreQuadruple
     *
     * @param integer $chambreQuadruple
     * @return Contingent
     */
    public function setChambreQuadruple($chambreQuadruple)
    {
        $this->chambreQuadruple = $chambreQuadruple;

        return $this;
    }

    /**
     * Get chambreQuadruple
     *
     * @return integer 
     */
    public function getChambreQuadruple()
    {
        return $this->chambreQuadruple;
    }

    /**
     * Set chambreTriple
     *
     * @param integer $chambreTriple
     * @return Contingent
     */
    public function setChambreTriple($chambreTriple)
    {
        $this->chambreTriple = $chambreTriple;

        return $this;
    }

    /**
     * Get chambreTriple
     *
     * @return integer 
     */
    public function getChambreTriple()
    {
        return $this->chambreTriple;
    }

    /**
     * Set voyage
     *
     * @param \Back\VoyageOrganiseBundle\Entity\VoyageOrganise $voyage
     * @return Contingent
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
     * Set hotel
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Hotel $hotel
     * @return Contingent
     */
    public function setHotel(\Back\VoyageOrganiseBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Hotel 
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Add chambres
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Chambre $chambres
     * @return Contingent
     */
    public function addChambre(\Back\VoyageOrganiseBundle\Entity\Chambre $chambres)
    {
        $this->chambres[] = $chambres;

        return $this;
    }

    /**
     * Remove chambres
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Chambre $chambres
     */
    public function removeChambre(\Back\VoyageOrganiseBundle\Entity\Chambre $chambres)
    {
        $this->chambres->removeElement($chambres);
    }

    /**
     * Get chambres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChambres()
    {
        return $this->chambres;
    }

    /**
     * Set pack
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Pack $pack
     * @return Contingent
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
}
