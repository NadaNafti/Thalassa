<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FicheTechnique
 *
 * @ORM\Table(name="ost_sht_fichetechnique")
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
     * @var decimal
     *
     * @ORM\Column(name="min1AgeEnfant", type="decimal", precision=3, scale=1)
     * @Assert\NotBlank()
     */
    private $min1AgeEnfant;

    /**
     * @var deciaml
     *
     * @ORM\Column(name="max1AgeEnfant", type="decimal", precision=3, scale=1)
     * @Assert\NotBlank()
     */
    private $max1AgeEnfant;

    /**
     * @var decimal
     *
     * @ORM\Column(name="min2AgeEnfant", type="decimal", precision=3, scale=1)
     */
    private $min2AgeEnfant;

    /**
     * @var decimal
     *
     * @ORM\Column(name="max2AgeEnfant", type="decimal", precision=3, scale=1)
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * @param decimal $min2AgeEnfant
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
     * @return decimal
     */
    public function getMin2AgeEnfant()
    {
        return $this->min2AgeEnfant;
    }

    /**
     * Set max2AgeEnfant
     *
     * @param decimal $max2AgeEnfant
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
     * @return decimal
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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return FicheTechnique
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
     * @return FicheTechnique
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
}
