<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonReduc
 *
 * @ORM\Table(name="ost_sht_hotels_saison_reduc")
 * @ORM\Entity
 */
class SaisonReduc
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
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val1Enfant1Adulte1", type="decimal", precision=11, scale=3)
     */
    private $val1Enfant1Adulte1;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val1Enfant1Adulte2", type="decimal", precision=11, scale=3)
     */
    private $val1Enfant1Adulte2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pour1Enfant1Adulte", type="boolean", nullable=true)
     */
    private $pour1Enfant1Adulte;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="marge1Enfant1Adulte", type="decimal", precision=11, scale=3)
     */
    private $marge1Enfant1Adulte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margepour1Enfant1Adulte", type="boolean", nullable=true)
     */
    private $margepour1Enfant1Adulte;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val1Enfant2Adulte1", type="decimal", precision=11, scale=3)
     */
    private $val1Enfant2Adulte1;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val1Enfant2Adulte2", type="decimal", precision=11, scale=3)
     */
    private $val1Enfant2Adulte2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pour1Enfant2Adulte", type="boolean", nullable=true)
     */
    private $pour1Enfant2Adulte;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="marge1Enfant2Adulte", type="decimal", precision=11, scale=3)
     */
    private $marge1Enfant2Adulte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margepour1Enfant2Adulte", type="boolean", nullable=true)
     */
    private $margepour1Enfant2Adulte;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val1EnfantSepare1", type="decimal", precision=11, scale=3)
     */
    private $val1EnfantSepare1;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val1EnfantSepare2", type="decimal", precision=11, scale=3)
     */
    private $val1EnfantSepare2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pour1EnfantSepare", type="boolean", nullable=true)
     */
    private $pour1EnfantSepare;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="marge1EnfantSepare", type="decimal", precision=11, scale=3)
     */
    private $marge1EnfantSepare;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margepour1EnfantSepare", type="boolean", nullable=true)
     */
    private $margepour1EnfantSepare;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val2Enfant1Adulte1", type="decimal", precision=11, scale=3)
     */
    private $val2Enfant1Adulte1;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val2Enfant1Adulte2", type="decimal", precision=11, scale=3)
     */
    private $val2Enfant1Adulte2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pour2Enfant1Adulte", type="boolean", nullable=true)
     */
    private $pour2Enfant1Adulte;
    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="marge2Enfant1Adulte", type="decimal", precision=11, scale=3)
     */
    private $marge2Enfant1Adulte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margepour2Enfant1Adulte", type="boolean", nullable=true)
     */
    private $margepour2Enfant1Adulte;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val2Enfant2Adulte1", type="decimal", precision=11, scale=3)
     */
    private $val2Enfant2Adulte1;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val2Enfant2Adulte2", type="decimal", precision=11, scale=3)
     */
    private $val2Enfant2Adulte2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pour2Enfant2Adulte", type="boolean", nullable=true)
     */
    private $pour2Enfant2Adulte;
    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="marge2Enfant2Adulte", type="decimal", precision=11, scale=3)
     */
    private $marge2Enfant2Adulte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margepour2Enfant2Adulte", type="boolean", nullable=true)
     */
    private $margepour2Enfant2Adulte;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val2EnfantOuPlusSepare1", type="decimal", precision=11, scale=3)
     */
    private $val2EnfantOuPlusSepare1;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="val2EnfantOuPlusSepare2", type="decimal", precision=11, scale=3)
     */
    private $val2EnfantOuPlusSepare2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pour2EnfantOuPlusSepare", type="boolean", nullable=true)
     */
    private $pour2EnfantOuPlusSepare;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="marge2EnfantOuPlusSepare", type="decimal", precision=11, scale=3)
     */
    private $marge2EnfantOuPlusSepare;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margepour2EnfantOuPlusSepare", type="boolean", nullable=true)
     */
    private $margepour2EnfantOuPlusSepare;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="reduc3Lit", type="decimal", precision=11, scale=3)
     */
    private $reduc3Lit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reduc3LitPour", type="boolean", nullable=true)
     */
    private $reduc3LitPour;
    
    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="reduc3LitMarge", type="decimal", precision=11, scale=3)
     */
    private $reduc3LitMarge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reduc3LitMargePour", type="boolean", nullable=true)
     */
    private $reduc3LitMargePour;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="reduc4Lit", type="decimal", precision=11, scale=3)
     */
    private $reduc4Lit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reduc4LitPour", type="boolean", nullable=true)
     */
    private $reduc4LitPour;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="reduc4LitMarge", type="decimal", precision=11, scale=3)
     */
    private $reduc4LitMarge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reduc4LitMargePour", type="boolean", nullable=true)
     */
    private $reduc4LitMargePour;
    
    /**
     * @ORM\OneToOne(targetEntity="Saison", mappedBy="saisonReduc")
     * */
    private $saison;

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
     * Set val1Enfant1Adulte1
     *
     * @param string $val1Enfant1Adulte1
     * @return SaisonReduc
     */
    public function setVal1Enfant1Adulte1($val1Enfant1Adulte1)
    {
        $this->val1Enfant1Adulte1=$val1Enfant1Adulte1;

        return $this;
    }

    /**
     * Get val1Enfant1Adulte1
     *
     * @return string 
     */
    public function getVal1Enfant1Adulte1()
    {
        return $this->val1Enfant1Adulte1;
    }

    /**
     * Set val1Enfant1Adulte2
     *
     * @param string $val1Enfant1Adulte2
     * @return SaisonReduc
     */
    public function setVal1Enfant1Adulte2($val1Enfant1Adulte2)
    {
        $this->val1Enfant1Adulte2=$val1Enfant1Adulte2;

        return $this;
    }

    /**
     * Get val1Enfant1Adulte2
     *
     * @return string 
     */
    public function getVal1Enfant1Adulte2()
    {
        return $this->val1Enfant1Adulte2;
    }

    /**
     * Set pour1Enfant1Adulte
     *
     * @param boolean $pour1Enfant1Adulte
     * @return SaisonReduc
     */
    public function setPour1Enfant1Adulte($pour1Enfant1Adulte)
    {
        $this->pour1Enfant1Adulte=$pour1Enfant1Adulte;

        return $this;
    }

    /**
     * Get pour1Enfant1Adulte
     *
     * @return boolean 
     */
    public function getPour1Enfant1Adulte()
    {
        return $this->pour1Enfant1Adulte;
    }

    /**
     * Set val1Enfant2Adulte1
     *
     * @param string $val1Enfant2Adulte1
     * @return SaisonReduc
     */
    public function setVal1Enfant2Adulte1($val1Enfant2Adulte1)
    {
        $this->val1Enfant2Adulte1=$val1Enfant2Adulte1;

        return $this;
    }

    /**
     * Get val1Enfant2Adulte1
     *
     * @return string 
     */
    public function getVal1Enfant2Adulte1()
    {
        return $this->val1Enfant2Adulte1;
    }

    /**
     * Set val1Enfant2Adulte2
     *
     * @param string $val1Enfant2Adulte2
     * @return SaisonReduc
     */
    public function setVal1Enfant2Adulte2($val1Enfant2Adulte2)
    {
        $this->val1Enfant2Adulte2=$val1Enfant2Adulte2;

        return $this;
    }

    /**
     * Get val1Enfant2Adulte2
     *
     * @return string 
     */
    public function getVal1Enfant2Adulte2()
    {
        return $this->val1Enfant2Adulte2;
    }

    /**
     * Set pour1Enfant2Adulte
     *
     * @param boolean $pour1Enfant2Adulte
     * @return SaisonReduc
     */
    public function setPour1Enfant2Adulte($pour1Enfant2Adulte)
    {
        $this->pour1Enfant2Adulte=$pour1Enfant2Adulte;

        return $this;
    }

    /**
     * Get pour1Enfant2Adulte
     *
     * @return boolean 
     */
    public function getPour1Enfant2Adulte()
    {
        return $this->pour1Enfant2Adulte;
    }

    /**
     * Set val1EnfantSepare1
     *
     * @param string $val1EnfantSepare1
     * @return SaisonReduc
     */
    public function setVal1EnfantSepare1($val1EnfantSepare1)
    {
        $this->val1EnfantSepare1=$val1EnfantSepare1;

        return $this;
    }

    /**
     * Get val1EnfantSepare1
     *
     * @return string 
     */
    public function getVal1EnfantSepare1()
    {
        return $this->val1EnfantSepare1;
    }

    /**
     * Set val1EnfantSepare2
     *
     * @param string $val1EnfantSepare2
     * @return SaisonReduc
     */
    public function setVal1EnfantSepare2($val1EnfantSepare2)
    {
        $this->val1EnfantSepare2=$val1EnfantSepare2;

        return $this;
    }

    /**
     * Get val1EnfantSepare2
     *
     * @return string 
     */
    public function getVal1EnfantSepare2()
    {
        return $this->val1EnfantSepare2;
    }

    /**
     * Set pour1EnfantSepare
     *
     * @param boolean $pour1EnfantSepare
     * @return SaisonReduc
     */
    public function setPour1EnfantSepare($pour1EnfantSepare)
    {
        $this->pour1EnfantSepare=$pour1EnfantSepare;

        return $this;
    }

    /**
     * Get pour1EnfantSepare
     *
     * @return boolean 
     */
    public function getPour1EnfantSepare()
    {
        return $this->pour1EnfantSepare;
    }

    /**
     * Set val2Enfant1Adulte1
     *
     * @param string $val2Enfant1Adulte1
     * @return SaisonReduc
     */
    public function setVal2Enfant1Adulte1($val2Enfant1Adulte1)
    {
        $this->val2Enfant1Adulte1=$val2Enfant1Adulte1;

        return $this;
    }

    /**
     * Get val2Enfant1Adulte1
     *
     * @return string 
     */
    public function getVal2Enfant1Adulte1()
    {
        return $this->val2Enfant1Adulte1;
    }

    /**
     * Set val2Enfant1Adulte2
     *
     * @param string $val2Enfant1Adulte2
     * @return SaisonReduc
     */
    public function setVal2Enfant1Adulte2($val2Enfant1Adulte2)
    {
        $this->val2Enfant1Adulte2=$val2Enfant1Adulte2;

        return $this;
    }

    /**
     * Get val2Enfant1Adulte2
     *
     * @return string 
     */
    public function getVal2Enfant1Adulte2()
    {
        return $this->val2Enfant1Adulte2;
    }

    /**
     * Set pour2Enfant1Adulte
     *
     * @param boolean $pour2Enfant1Adulte
     * @return SaisonReduc
     */
    public function setPour2Enfant1Adulte($pour2Enfant1Adulte)
    {
        $this->pour2Enfant1Adulte=$pour2Enfant1Adulte;

        return $this;
    }

    /**
     * Get pour2Enfant1Adulte
     *
     * @return boolean 
     */
    public function getPour2Enfant1Adulte()
    {
        return $this->pour2Enfant1Adulte;
    }

    /**
     * Set val2Enfant2Adulte1
     *
     * @param string $val2Enfant2Adulte1
     * @return SaisonReduc
     */
    public function setVal2Enfant2Adulte1($val2Enfant2Adulte1)
    {
        $this->val2Enfant2Adulte1=$val2Enfant2Adulte1;

        return $this;
    }

    /**
     * Get val2Enfant2Adulte1
     *
     * @return string 
     */
    public function getVal2Enfant2Adulte1()
    {
        return $this->val2Enfant2Adulte1;
    }

    /**
     * Set val2Enfant2Adulte2
     *
     * @param string $val2Enfant2Adulte2
     * @return SaisonReduc
     */
    public function setVal2Enfant2Adulte2($val2Enfant2Adulte2)
    {
        $this->val2Enfant2Adulte2=$val2Enfant2Adulte2;

        return $this;
    }

    /**
     * Get val2Enfant2Adulte2
     *
     * @return string 
     */
    public function getVal2Enfant2Adulte2()
    {
        return $this->val2Enfant2Adulte2;
    }

    /**
     * Set pour2Enfant2Adulte
     *
     * @param boolean $pour2Enfant2Adulte
     * @return SaisonReduc
     */
    public function setPour2Enfant2Adulte($pour2Enfant2Adulte)
    {
        $this->pour2Enfant2Adulte=$pour2Enfant2Adulte;

        return $this;
    }

    /**
     * Get pour2Enfant2Adulte
     *
     * @return boolean 
     */
    public function getPour2Enfant2Adulte()
    {
        return $this->pour2Enfant2Adulte;
    }

    /**
     * Set val2EnfantOuPlusSepare1
     *
     * @param string $val2EnfantOuPlusSepare1
     * @return SaisonReduc
     */
    public function setVal2EnfantOuPlusSepare1($val2EnfantOuPlusSepare1)
    {
        $this->val2EnfantOuPlusSepare1=$val2EnfantOuPlusSepare1;

        return $this;
    }

    /**
     * Get val2EnfantOuPlusSepare1
     *
     * @return string 
     */
    public function getVal2EnfantOuPlusSepare1()
    {
        return $this->val2EnfantOuPlusSepare1;
    }

    /**
     * Set val2EnfantOuPlusSepare2
     *
     * @param string $val2EnfantOuPlusSepare2
     * @return SaisonReduc
     */
    public function setVal2EnfantOuPlusSepare2($val2EnfantOuPlusSepare2)
    {
        $this->val2EnfantOuPlusSepare2=$val2EnfantOuPlusSepare2;

        return $this;
    }

    /**
     * Get val2EnfantOuPlusSepare2
     *
     * @return string 
     */
    public function getVal2EnfantOuPlusSepare2()
    {
        return $this->val2EnfantOuPlusSepare2;
    }

    /**
     * Set pour2EnfantOuPlusSepare
     *
     * @param boolean $pour2EnfantOuPlusSepare
     * @return SaisonReduc
     */
    public function setPour2EnfantOuPlusSepare($pour2EnfantOuPlusSepare)
    {
        $this->pour2EnfantOuPlusSepare=$pour2EnfantOuPlusSepare;

        return $this;
    }

    /**
     * Get pour2EnfantOuPlusSepare
     *
     * @return boolean 
     */
    public function getPour2EnfantOuPlusSepare()
    {
        return $this->pour2EnfantOuPlusSepare;
    }

    /**
     * Set reduc3Lit
     *
     * @param string $reduc3Lit
     * @return SaisonReduc
     */
    public function setReduc3Lit($reduc3Lit)
    {
        $this->reduc3Lit=$reduc3Lit;

        return $this;
    }

    /**
     * Get reduc3Lit
     *
     * @return string 
     */
    public function getReduc3Lit()
    {
        return $this->reduc3Lit;
    }

    /**
     * Set reduc3LitPour
     *
     * @param boolean $reduc3LitPour
     * @return SaisonReduc
     */
    public function setReduc3LitPour($reduc3LitPour)
    {
        $this->reduc3LitPour=$reduc3LitPour;

        return $this;
    }

    /**
     * Get reduc3LitPour
     *
     * @return boolean 
     */
    public function getReduc3LitPour()
    {
        return $this->reduc3LitPour;
    }

    /**
     * Set reduc4Lit
     *
     * @param decimal $reduc4Lit
     * @return SaisonReduc
     */
    public function setReduc4Lit($reduc4Lit)
    {
        $this->reduc4Lit=$reduc4Lit;

        return $this;
    }

    /**
     * Get reduc4Lit
     *
     * @return decimal 
     */
    public function getReduc4Lit()
    {
        return $this->reduc4Lit;
    }

    /**
     * Set reduc4LitPour
     *
     * @param boolean $reduc4LitPour
     * @return SaisonReduc
     */
    public function setReduc4LitPour($reduc4LitPour)
    {
        $this->reduc4LitPour=$reduc4LitPour;

        return $this;
    }

    /**
     * Get reduc4LitPour
     *
     * @return boolean 
     */
    public function getReduc4LitPour()
    {
        return $this->reduc4LitPour;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return SaisonReduc
     */
    public function setCreated($created)
    {
        $this->created=$created;

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
     * @return SaisonReduc
     */
    public function setUpdated($updated)
    {
        $this->updated=$updated;

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
     * Set marge1Enfant1Adulte
     *
     * @param string $marge1Enfant1Adulte
     * @return SaisonReduc
     */
    public function setMarge1Enfant1Adulte($marge1Enfant1Adulte)
    {
        $this->marge1Enfant1Adulte = $marge1Enfant1Adulte;

        return $this;
    }

    /**
     * Get marge1Enfant1Adulte
     *
     * @return string 
     */
    public function getMarge1Enfant1Adulte()
    {
        return $this->marge1Enfant1Adulte;
    }

    /**
     * Set margepour1Enfant1Adulte
     *
     * @param boolean $margepour1Enfant1Adulte
     * @return SaisonReduc
     */
    public function setMargepour1Enfant1Adulte($margepour1Enfant1Adulte)
    {
        $this->margepour1Enfant1Adulte = $margepour1Enfant1Adulte;

        return $this;
    }

    /**
     * Get margepour1Enfant1Adulte
     *
     * @return boolean 
     */
    public function getMargepour1Enfant1Adulte()
    {
        return $this->margepour1Enfant1Adulte;
    }

    /**
     * Set marge1Enfant2Adulte
     *
     * @param string $marge1Enfant2Adulte
     * @return SaisonReduc
     */
    public function setMarge1Enfant2Adulte($marge1Enfant2Adulte)
    {
        $this->marge1Enfant2Adulte = $marge1Enfant2Adulte;

        return $this;
    }

    /**
     * Get marge1Enfant2Adulte
     *
     * @return string 
     */
    public function getMarge1Enfant2Adulte()
    {
        return $this->marge1Enfant2Adulte;
    }

    /**
     * Set margepour1Enfant2Adulte
     *
     * @param boolean $margepour1Enfant2Adulte
     * @return SaisonReduc
     */
    public function setMargepour1Enfant2Adulte($margepour1Enfant2Adulte)
    {
        $this->margepour1Enfant2Adulte = $margepour1Enfant2Adulte;

        return $this;
    }

    /**
     * Get margepour1Enfant2Adulte
     *
     * @return boolean 
     */
    public function getMargepour1Enfant2Adulte()
    {
        return $this->margepour1Enfant2Adulte;
    }

    /**
     * Set marge1EnfantSepare
     *
     * @param string $marge1EnfantSepare
     * @return SaisonReduc
     */
    public function setMarge1EnfantSepare($marge1EnfantSepare)
    {
        $this->marge1EnfantSepare = $marge1EnfantSepare;

        return $this;
    }

    /**
     * Get marge1EnfantSepare
     *
     * @return string 
     */
    public function getMarge1EnfantSepare()
    {
        return $this->marge1EnfantSepare;
    }

    /**
     * Set margepour1EnfantSepare
     *
     * @param boolean $margepour1EnfantSepare
     * @return SaisonReduc
     */
    public function setMargepour1EnfantSepare($margepour1EnfantSepare)
    {
        $this->margepour1EnfantSepare = $margepour1EnfantSepare;

        return $this;
    }

    /**
     * Get margepour1EnfantSepare
     *
     * @return boolean 
     */
    public function getMargepour1EnfantSepare()
    {
        return $this->margepour1EnfantSepare;
    }

    /**
     * Set marge2Enfant1Adulte
     *
     * @param string $marge2Enfant1Adulte
     * @return SaisonReduc
     */
    public function setMarge2Enfant1Adulte($marge2Enfant1Adulte)
    {
        $this->marge2Enfant1Adulte = $marge2Enfant1Adulte;

        return $this;
    }

    /**
     * Get marge2Enfant1Adulte
     *
     * @return string 
     */
    public function getMarge2Enfant1Adulte()
    {
        return $this->marge2Enfant1Adulte;
    }

    /**
     * Set margepour2Enfant1Adulte
     *
     * @param boolean $margepour2Enfant1Adulte
     * @return SaisonReduc
     */
    public function setMargepour2Enfant1Adulte($margepour2Enfant1Adulte)
    {
        $this->margepour2Enfant1Adulte = $margepour2Enfant1Adulte;

        return $this;
    }

    /**
     * Get margepour2Enfant1Adulte
     *
     * @return boolean 
     */
    public function getMargepour2Enfant1Adulte()
    {
        return $this->margepour2Enfant1Adulte;
    }

    /**
     * Set marge2Enfant2Adulte
     *
     * @param string $marge2Enfant2Adulte
     * @return SaisonReduc
     */
    public function setMarge2Enfant2Adulte($marge2Enfant2Adulte)
    {
        $this->marge2Enfant2Adulte = $marge2Enfant2Adulte;

        return $this;
    }

    /**
     * Get marge2Enfant2Adulte
     *
     * @return string 
     */
    public function getMarge2Enfant2Adulte()
    {
        return $this->marge2Enfant2Adulte;
    }

    /**
     * Set margepour2Enfant2Adulte
     *
     * @param boolean $margepour2Enfant2Adulte
     * @return SaisonReduc
     */
    public function setMargepour2Enfant2Adulte($margepour2Enfant2Adulte)
    {
        $this->margepour2Enfant2Adulte = $margepour2Enfant2Adulte;

        return $this;
    }

    /**
     * Get margepour2Enfant2Adulte
     *
     * @return boolean 
     */
    public function getMargepour2Enfant2Adulte()
    {
        return $this->margepour2Enfant2Adulte;
    }

    /**
     * Set marge2EnfantOuPlusSepare
     *
     * @param string $marge2EnfantOuPlusSepare
     * @return SaisonReduc
     */
    public function setMarge2EnfantOuPlusSepare($marge2EnfantOuPlusSepare)
    {
        $this->marge2EnfantOuPlusSepare = $marge2EnfantOuPlusSepare;

        return $this;
    }

    /**
     * Get marge2EnfantOuPlusSepare
     *
     * @return string 
     */
    public function getMarge2EnfantOuPlusSepare()
    {
        return $this->marge2EnfantOuPlusSepare;
    }

    /**
     * Set margepour2EnfantOuPlusSepare
     *
     * @param boolean $margepour2EnfantOuPlusSepare
     * @return SaisonReduc
     */
    public function setMargepour2EnfantOuPlusSepare($margepour2EnfantOuPlusSepare)
    {
        $this->margepour2EnfantOuPlusSepare = $margepour2EnfantOuPlusSepare;

        return $this;
    }

    /**
     * Get margepour2EnfantOuPlusSepare
     *
     * @return boolean 
     */
    public function getMargepour2EnfantOuPlusSepare()
    {
        return $this->margepour2EnfantOuPlusSepare;
    }

    /**
     * Set reduc3LitMarge
     *
     * @param string $reduc3LitMarge
     * @return SaisonReduc
     */
    public function setReduc3LitMarge($reduc3LitMarge)
    {
        $this->reduc3LitMarge = $reduc3LitMarge;

        return $this;
    }

    /**
     * Get reduc3LitMarge
     *
     * @return string 
     */
    public function getReduc3LitMarge()
    {
        return $this->reduc3LitMarge;
    }

    /**
     * Set reduc3LitMargePour
     *
     * @param boolean $reduc3LitMargePour
     * @return SaisonReduc
     */
    public function setReduc3LitMargePour($reduc3LitMargePour)
    {
        $this->reduc3LitMargePour = $reduc3LitMargePour;

        return $this;
    }

    /**
     * Get reduc3LitMargePour
     *
     * @return boolean 
     */
    public function getReduc3LitMargePour()
    {
        return $this->reduc3LitMargePour;
    }

    /**
     * Set reduc4LitMarge
     *
     * @param string $reduc4LitMarge
     * @return SaisonReduc
     */
    public function setReduc4LitMarge($reduc4LitMarge)
    {
        $this->reduc4LitMarge = $reduc4LitMarge;

        return $this;
    }

    /**
     * Get reduc4LitMarge
     *
     * @return string 
     */
    public function getReduc4LitMarge()
    {
        return $this->reduc4LitMarge;
    }

    /**
     * Set reduc4LitMargePour
     *
     * @param boolean $reduc4LitMargePour
     * @return SaisonReduc
     */
    public function setReduc4LitMargePour($reduc4LitMargePour)
    {
        $this->reduc4LitMargePour = $reduc4LitMargePour;

        return $this;
    }

    /**
     * Get reduc4LitMargePour
     *
     * @return boolean 
     */
    public function getReduc4LitMargePour()
    {
        return $this->reduc4LitMargePour;
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonReduc
     */
    public function setSaison(\Back\HotelTunisieBundle\Entity\Saison $saison = null)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return \Back\HotelTunisieBundle\Entity\Saison 
     */
    public function getSaison()
    {
        return $this->saison;
    }
}
