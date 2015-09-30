<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contingent
 *
 * @ORM\Table(name="ost_vo_chambre")
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
     * @ORM\ManyToOne(targetEntity="Contingent", inversedBy="chambres")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $contingent;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="ReservationPersonne", mappedBy="chambreContingent")
     */
    private $personnes;


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
     * Set type
     *
     * @param integer $type
     * @return Chambre
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

    /**
     * Set contingent
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Contingent $contingent
     * @return Chambre
     */
    public function setContingent(\Back\VoyageOrganiseBundle\Entity\Contingent $contingent = null)
    {
        $this->contingent = $contingent;

        return $this;
    }

    /**
     * Get contingent
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Contingent 
     */
    public function getContingent()
    {
        return $this->contingent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personnes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add personnes
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationPersonne $personnes
     * @return Chambre
     */
    public function addPersonne(\Back\VoyageOrganiseBundle\Entity\ReservationPersonne $personnes)
    {
        $this->personnes[] = $personnes;

        return $this;
    }

    /**
     * Remove personnes
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationPersonne $personnes
     */
    public function removePersonne(\Back\VoyageOrganiseBundle\Entity\ReservationPersonne $personnes)
    {
        $this->personnes->removeElement($personnes);
    }

    /**
     * Get personnes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonnes()
    {
        return $this->personnes;
    }
}
