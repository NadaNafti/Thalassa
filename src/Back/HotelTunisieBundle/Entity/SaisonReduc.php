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
        $this->val1Enfant1Adulte1 = $val1Enfant1Adulte1;

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
        $this->val1Enfant1Adulte2 = $val1Enfant1Adulte2;

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
        $this->pour1Enfant1Adulte = $pour1Enfant1Adulte;

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
        $this->val1Enfant2Adulte1 = $val1Enfant2Adulte1;

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
        $this->val1Enfant2Adulte2 = $val1Enfant2Adulte2;

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
        $this->pour1Enfant2Adulte = $pour1Enfant2Adulte;

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
        $this->val1EnfantSepare1 = $val1EnfantSepare1;

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
        $this->val1EnfantSepare2 = $val1EnfantSepare2;

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
        $this->pour1EnfantSepare = $pour1EnfantSepare;

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
        $this->val2Enfant1Adulte1 = $val2Enfant1Adulte1;

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
        $this->val2Enfant1Adulte2 = $val2Enfant1Adulte2;

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
        $this->pour2Enfant1Adulte = $pour2Enfant1Adulte;

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
        $this->val2Enfant2Adulte1 = $val2Enfant2Adulte1;

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
        $this->val2Enfant2Adulte2 = $val2Enfant2Adulte2;

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
        $this->pour2Enfant2Adulte = $pour2Enfant2Adulte;

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
        $this->val2EnfantOuPlusSepare1 = $val2EnfantOuPlusSepare1;

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
        $this->val2EnfantOuPlusSepare2 = $val2EnfantOuPlusSepare2;

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
        $this->pour2EnfantOuPlusSepare = $pour2EnfantOuPlusSepare;

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
        $this->reduc3Lit = $reduc3Lit;

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
        $this->reduc3LitPour = $reduc3LitPour;

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
        $this->reduc4Lit = $reduc4Lit;

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
        $this->reduc4LitPour = $reduc4LitPour;

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
     * @return SaisonReduc
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
