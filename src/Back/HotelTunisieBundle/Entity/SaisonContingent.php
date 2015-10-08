<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonContingent
 *
 * @ORM\Table(name="ost_sht_saison_contingent")
 * @ORM\Entity
 */
class SaisonContingent
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
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="contingents")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $saison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="date")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="date")
     */
    private $fin;

    /**
     * @var integer
     * @Assert\Range(min = 0)
     * @ORM\Column(name="nombreChambre", type="integer")
     */
    private $nombreChambre;


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
     * Set debut
     *
     * @param \DateTime $debut
     * @return SaisonContingent
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return SaisonContingent
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set nombreChambre
     *
     * @param integer $nombreChambre
     * @return SaisonContingent
     */
    public function setNombreChambre($nombreChambre)
    {
        $this->nombreChambre = $nombreChambre;

        return $this;
    }

    /**
     * Get nombreChambre
     *
     * @return integer 
     */
    public function getNombreChambre()
    {
        return $this->nombreChambre;
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonContingent
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

    public function isBetweenDate($date)
    {
        if($this->debut->format('Y-m-d') <= $date && $this->fin->format('Y-m-d') >= $date)
            return true;
        else
            return false;
    }
}
