<?php

namespace Back\CommercialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tarif
 *
 * @ORM\Table(name="ost_com_tarif")
 * @ORM\Entity
 */
class Tarif
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
     * @ORM\Column(name="timbre", type="boolean",nullable=true)
     */
    private $timbre;

    /**
     * @var string
     * @Assert\Range(min = 0)
     * @ORM\Column(name="montantTimbre", type="decimal", precision=2, scale=1,nullable=true)
     */
    private $montantTimbre;


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
     * Set timbre
     *
     * @param boolean $timbre
     * @return Tarif
     */
    public function setTimbre($timbre)
    {
        $this->timbre = $timbre;

        return $this;
    }

    /**
     * Get timbre
     *
     * @return boolean 
     */
    public function getTimbre()
    {
        return $this->timbre;
    }

    /**
     * Set montantTimbre
     *
     * @param string $montantTimbre
     * @return Tarif
     */
    public function setMontantTimbre($montantTimbre)
    {
        $this->montantTimbre = $montantTimbre;

        return $this;
    }

    /**
     * Get montantTimbre
     *
     * @return string 
     */
    public function getMontantTimbre()
    {
        return $this->montantTimbre;
    }
}
