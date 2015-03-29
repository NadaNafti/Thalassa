<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Chambre
 *
 * @ORM\Table(name="ost_sht_chambre")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity
 */
class Chambre
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
     * @Gedmo\slug(fields={"libelle"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="base", type="integer")
     */
    private $base;

    /**
     * @var string
     *
     * @ORM\Column(name="nbreoccupant", type="string", length=255)
     */
    private $nbreoccupant;
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
     * @ORM\Column( name="deletedAt",type="datetime",nullable=true)
     */
    private $deletedAt;
    

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
     * @return Chambre
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
     * Set base
     *
     * @param integer $base
     * @return Chambre
     */
    public function setBase($base)
    {
        $this->base = $base;

        return $this;
    }

    /**
     * Get base
     *
     * @return integer 
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Set nbreoccupant
     *
     * @param string $nbreoccupant
     * @return Chambre
     */
    public function setNbreoccupant($nbreoccupant)
    {
        $this->nbreoccupant = $nbreoccupant;

        return $this;
    }

    /**
     * Get nbreoccupant
     *
     * @return string 
     */
    public function getNbreoccupant()
    {
        return $this->nbreoccupant;
    }
    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Chambre
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
     * @return Chambre
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
     * @return Chambre
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
}
