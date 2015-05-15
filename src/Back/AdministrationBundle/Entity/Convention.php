<?php

namespace Back\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo ;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Convention
 * 
 * @ORM\Table(name="ost_amicale_convention")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity
 */
class Convention
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    /**
     * @var integer
     * @Assert\Range(
     *      min = 1,
     *      max = 100,
     * )
     * @ORM\Column(name="remise", type="integer")
     */
    private $remise;

    /**
     *  1- Ne pas prendre en compte les promo et appliquer les remises
     *  2- Prendre en compte les promo et ne pas appliquer les remises
     * @var integer
     * @ORM\Column(name="type", type="integer" ,nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeRemise", type="integer")
     */
    private $typeRemise;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Amicale", inversedBy="conventions")
     */
    protected $amicale;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column( type="datetime")
     */
    private $created ;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column( type="datetime")
     */
    private $updated ;

    /**
     * @ORM\Column( name="deletedAt",type="datetime",nullable=true)
     */
    private $deletedAt ;



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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Convention
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Convention
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set remise
     *
     * @param integer $remise
     * @return Convention
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return integer 
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set typeRemise
     *
     * @param integer $typeRemise
     * @return Convention
     */
    public function setTypeRemise($typeRemise)
    {
        $this->typeRemise = $typeRemise;

        return $this;
    }

    /**
     * Get typeRemise
     *
     * @return integer 
     */
    public function getTypeRemise()
    {
        return $this->typeRemise;
    }
    
    /**
     * Get showTypeRemise
     *
     * @return integer 
     */
    public function showTypeRemise()
    {
        if($this->typeRemise==1)
            return 'Remise Total';
        else
            return 'Remise Prix de base';
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Convention
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
     * @return Convention
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

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Convention
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set amicale
     *
     * @param \Back\AdministrationBundle\Entity\Amicale $amicale
     * @return Convention
     */
    public function setAmicale(\Back\AdministrationBundle\Entity\Amicale $amicale = null)
    {
        $this->amicale = $amicale;

        return $this;
    }

    /**
     * Get amicale
     *
     * @return \Back\AdministrationBundle\Entity\Amicale 
     */
    public function getAmicale()
    {
        return $this->amicale;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Convention
     */
    public function setType($type)
    {
        $this->type = $type;

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
    
    public function showType()
    {
        if(is_null($this->type))
            return "Appliquer les promos & les promotions";
        elseif($this->type==1)
            return "Ne pas prendre en compte les promo et appliquer les remises";
        elseif($this->type==2)
            return "Prendre en compte les promo et ne pas appliquer les remises";
    }
}
