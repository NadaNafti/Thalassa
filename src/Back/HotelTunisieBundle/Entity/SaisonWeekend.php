<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonWeekend
 *
 * @ORM\Table(name="ost_sht_saison_weekend")
 * @ORM\Entity
 */
class SaisonWeekend
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
     * @var boolean
     *
     * @ORM\Column(name="jeudi", type="boolean",nullable=true)
     */
    private $jeudi;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendredi", type="boolean",nullable=true)
     */
    private $vendredi;

    /**
     * @var boolean
     *
     * @ORM\Column(name="samedi", type="boolean",nullable=true)
     */
    private $samedi;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dimanche", type="boolean",nullable=true)
     */
    private $dimanche;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="marge", type="decimal", precision=11, scale=3)
     */
    private $marge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margePour", type="boolean",nullable=true)
     */
    private $margePour;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbNuitMin", type="integer")
     */
    private $nbNuitMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbNuitMax", type="integer")
     */
    private $nbNuitMax;

    /**
     * @ORM\OneToOne(targetEntity="Saison", mappedBy="saisonWeekend")
     * */
    private $saison;

    /**
     * @ORM\OneToMany(targetEntity="SaisonWeekendLigne",mappedBy="saisonWeekend", cascade={"persist"})
     */
    protected $lignes;

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
     * Set vendredi
     *
     * @param boolean $vendredi
     * @return SaisonWeekend
     */
    public function setVendredi($vendredi)
    {
        $this->vendredi=$vendredi;

        return $this;
    }

    /**
     * Get vendredi
     *
     * @return boolean 
     */
    public function getVendredi()
    {
        return $this->vendredi;
    }

    /**
     * Set samedi
     *
     * @param boolean $samedi
     * @return SaisonWeekend
     */
    public function setSamedi($samedi)
    {
        $this->samedi=$samedi;

        return $this;
    }

    /**
     * Get samedi
     *
     * @return boolean 
     */
    public function getSamedi()
    {
        return $this->samedi;
    }

    /**
     * Set dimanche
     *
     * @param boolean $dimanche
     * @return SaisonWeekend
     */
    public function setDimanche($dimanche)
    {
        $this->dimanche=$dimanche;

        return $this;
    }

    /**
     * Get dimanche
     *
     * @return boolean 
     */
    public function getDimanche()
    {
        return $this->dimanche;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return SaisonWeekend
     */
    public function setType($type)
    {
        $this->type=$type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set marge
     *
     * @param string $marge
     * @return SaisonWeekend
     */
    public function setMarge($marge)
    {
        $this->marge=$marge;

        return $this;
    }

    /**
     * Get marge
     *
     * @return string 
     */
    public function getMarge()
    {
        return $this->marge;
    }

    /**
     * Set margePour
     *
     * @param boolean $margePour
     * @return SaisonWeekend
     */
    public function setMargePour($margePour)
    {
        $this->margePour=$margePour;

        return $this;
    }

    /**
     * Get margePour
     *
     * @return boolean 
     */
    public function getMargePour()
    {
        return $this->margePour;
    }

    /**
     * Set nbNuitMin
     *
     * @param integer $nbNuitMin
     * @return SaisonWeekend
     */
    public function setNbNuitMin($nbNuitMin)
    {
        $this->nbNuitMin=$nbNuitMin;

        return $this;
    }

    /**
     * Get nbNuitMin
     *
     * @return integer 
     */
    public function getNbNuitMin()
    {
        return $this->nbNuitMin;
    }

    /**
     * Set nbNuitMax
     *
     * @param integer $nbNuitMax
     * @return SaisonWeekend
     */
    public function setNbNuitMax($nbNuitMax)
    {
        $this->nbNuitMax=$nbNuitMax;

        return $this;
    }

    /**
     * Get nbNuitMax
     *
     * @return integer 
     */
    public function getNbNuitMax()
    {
        return $this->nbNuitMax;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return SaisonWeekend
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
     * @return SaisonWeekend
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
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonWeekend
     */
    public function setSaison(\Back\HotelTunisieBundle\Entity\Saison $saison=null)
    {
        $this->saison=$saison;

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


    
    public function __clone()
    {
        if ($this->id)
        {
            $this->id = NULL ;
        }
    }

    /**
     * Set jeudi
     *
     * @param boolean $jeudi
     * @return SaisonWeekend
     */
    public function setJeudi($jeudi)
    {
        $this->jeudi = $jeudi;

        return $this;
    }

    /**
     * Get jeudi
     *
     * @return boolean 
     */
    public function getJeudi()
    {
        return $this->jeudi;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add lignes
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonWeekendLigne $lignes
     * @return SaisonWeekend
     */
    public function addLigne(\Back\HotelTunisieBundle\Entity\SaisonWeekendLigne $lignes)
    {
        $this->lignes[] = $lignes;

        return $this;
    }

    /**
     * Remove lignes
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonWeekendLigne $lignes
     */
    public function removeLigne(\Back\HotelTunisieBundle\Entity\SaisonWeekendLigne $lignes)
    {
        $this->lignes->removeElement($lignes);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLignes()
    {
        return $this->lignes;
    }
}
