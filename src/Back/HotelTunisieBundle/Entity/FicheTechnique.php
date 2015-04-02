<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FicheTechnique
 *
 * @ORM\Table(name="ost_sht_hotels_fichetechnique")
 * @ORM\Entity
 */
class FicheTechnique
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
     * @ORM\Column(name="delaiAnnulation", type="integer",nullable=true)
     * @Assert\NotBlank()
     */
    private $delaiAnnulation;

    /**
     * @var integer
     *
     * @ORM\Column(name="delaiRectrocession", type="integer",nullable=true)
     * @Assert\NotBlank()
     */
    private $delaiRectrocession;

    /**
     * @var integer
     *
     * @ORM\Column(name="min1AgeEnfant", type="integer")
     * @Assert\NotBlank()
     */
    private $min1AgeEnfant;

    /**
     * @var integer
     *
     * @ORM\Column(name="max1AgeEnfant", type="integer")
     * @Assert\NotBlank()
     */
    private $max1AgeEnfant;

    /**
     * @var integer
     *
     * @ORM\Column(name="min2AgeEnfant", type="integer",nullable=true)
     */
    private $min2AgeEnfant;

    /**
     * @var integer
     *
     * @ORM\Column(name="max2AgeEnfant", type="integer",nullable=true)
     */
    private $max2AgeEnfant;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrAdulteAvoirChambreSeparer", type="integer")
     */
    private $nbrAdulteAvoirChambreSeparer;

    /**
     * @var integer
     *
     * @ORM\Column(name="minEnfantChambreSepare", type="integer")
     */
    private $minEnfantChambreSepare;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxEnfantChambreSepare", type="integer")
     */
    private $maxEnfantChambreSepare;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSingle1Adulte1EnfantChDouble", type="boolean",nullable=true)
     */
    private $suppSingle1Adulte1EnfantChDouble;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSingle1Adulte2EnfantChDouble", type="boolean",nullable=true)
     */
    private $suppSingle1Adulte2EnfantChDouble;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tarifWeekend", type="boolean",nullable=true)
     */
    private $tarifWeekend;


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
     * Set delaiAnnulation
     *
     * @param integer $delaiAnnulation
     * @return FicheTechnique
     */
    public function setDelaiAnnulation($delaiAnnulation)
    {
        $this->delaiAnnulation = $delaiAnnulation;

        return $this;
    }

    /**
     * Get delaiAnnulation
     *
     * @return integer 
     */
    public function getDelaiAnnulation()
    {
        return $this->delaiAnnulation;
    }

    /**
     * Set delaiRectrocession
     *
     * @param integer $delaiRectrocession
     * @return FicheTechnique
     */
    public function setDelaiRectrocession($delaiRectrocession)
    {
        $this->delaiRectrocession = $delaiRectrocession;

        return $this;
    }

    /**
     * Get delaiRectrocession
     *
     * @return integer 
     */
    public function getDelaiRectrocession()
    {
        return $this->delaiRectrocession;
    }

    /**
     * Set min1AgeEnfant
     *
     * @param integer $min1AgeEnfant
     * @return FicheTechnique
     */
    public function setMin1AgeEnfant($min1AgeEnfant)
    {
        $this->min1AgeEnfant = $min1AgeEnfant;

        return $this;
    }

    /**
     * Get min1AgeEnfant
     *
     * @return integer 
     */
    public function getMin1AgeEnfant()
    {
        return $this->min1AgeEnfant;
    }

    /**
     * Set max1AgeEnfant
     *
     * @param integer $max1AgeEnfant
     * @return FicheTechnique
     */
    public function setMax1AgeEnfant($max1AgeEnfant)
    {
        $this->max1AgeEnfant = $max1AgeEnfant;

        return $this;
    }

    /**
     * Get max1AgeEnfant
     *
     * @return integer 
     */
    public function getMax1AgeEnfant()
    {
        return $this->max1AgeEnfant;
    }

    /**
     * Set min2AgeEnfant
     *
     * @param integer $min2AgeEnfant
     * @return FicheTechnique
     */
    public function setMin2AgeEnfant($min2AgeEnfant)
    {
        $this->min2AgeEnfant = $min2AgeEnfant;

        return $this;
    }

    /**
     * Get min2AgeEnfant
     *
     * @return integer 
     */
    public function getMin2AgeEnfant()
    {
        return $this->min2AgeEnfant;
    }

    /**
     * Set max2AgeEnfant
     *
     * @param integer $max2AgeEnfant
     * @return FicheTechnique
     */
    public function setMax2AgeEnfant($max2AgeEnfant)
    {
        $this->max2AgeEnfant = $max2AgeEnfant;

        return $this;
    }

    /**
     * Get max2AgeEnfant
     *
     * @return integer 
     */
    public function getMax2AgeEnfant()
    {
        return $this->max2AgeEnfant;
    }

    /**
     * Set nbrAdulteAvoirChambreSeparer
     *
     * @param integer $nbrAdulteAvoirChambreSeparer
     * @return FicheTechnique
     */
    public function setNbrAdulteAvoirChambreSeparer($nbrAdulteAvoirChambreSeparer)
    {
        $this->nbrAdulteAvoirChambreSeparer = $nbrAdulteAvoirChambreSeparer;

        return $this;
    }

    /**
     * Get nbrAdulteAvoirChambreSeparer
     *
     * @return integer 
     */
    public function getNbrAdulteAvoirChambreSeparer()
    {
        return $this->nbrAdulteAvoirChambreSeparer;
    }

    /**
     * Set minEnfantChambreSepare
     *
     * @param integer $minEnfantChambreSepare
     * @return FicheTechnique
     */
    public function setMinEnfantChambreSepare($minEnfantChambreSepare)
    {
        $this->minEnfantChambreSepare = $minEnfantChambreSepare;

        return $this;
    }

    /**
     * Get minEnfantChambreSepare
     *
     * @return integer 
     */
    public function getMinEnfantChambreSepare()
    {
        return $this->minEnfantChambreSepare;
    }

    /**
     * Set maxEnfantChambreSepare
     *
     * @param integer $maxEnfantChambreSepare
     * @return FicheTechnique
     */
    public function setMaxEnfantChambreSepare($maxEnfantChambreSepare)
    {
        $this->maxEnfantChambreSepare = $maxEnfantChambreSepare;

        return $this;
    }

    /**
     * Get maxEnfantChambreSepare
     *
     * @return integer 
     */
    public function getMaxEnfantChambreSepare()
    {
        return $this->maxEnfantChambreSepare;
    }

    /**
     * Set suppSingle1Adulte1EnfantChDouble
     *
     * @param boolean $suppSingle1Adulte1EnfantChDouble
     * @return FicheTechnique
     */
    public function setSuppSingle1Adulte1EnfantChDouble($suppSingle1Adulte1EnfantChDouble)
    {
        $this->suppSingle1Adulte1EnfantChDouble = $suppSingle1Adulte1EnfantChDouble;

        return $this;
    }

    /**
     * Get suppSingle1Adulte1EnfantChDouble
     *
     * @return boolean 
     */
    public function getSuppSingle1Adulte1EnfantChDouble()
    {
        return $this->suppSingle1Adulte1EnfantChDouble;
    }

    /**
     * Set suppSingle1Adulte2EnfantChDouble
     *
     * @param boolean $suppSingle1Adulte2EnfantChDouble
     * @return FicheTechnique
     */
    public function setSuppSingle1Adulte2EnfantChDouble($suppSingle1Adulte2EnfantChDouble)
    {
        $this->suppSingle1Adulte2EnfantChDouble = $suppSingle1Adulte2EnfantChDouble;

        return $this;
    }

    /**
     * Get suppSingle1Adulte2EnfantChDouble
     *
     * @return boolean 
     */
    public function getSuppSingle1Adulte2EnfantChDouble()
    {
        return $this->suppSingle1Adulte2EnfantChDouble;
    }

    /**
     * Set tarifWeekend
     *
     * @param boolean $tarifWeekend
     * @return FicheTechnique
     */
    public function setTarifWeekend($tarifWeekend)
    {
        $this->tarifWeekend = $tarifWeekend;

        return $this;
    }

    /**
     * Get tarifWeekend
     *
     * @return boolean 
     */
    public function getTarifWeekend()
    {
        return $this->tarifWeekend;
    }
}
