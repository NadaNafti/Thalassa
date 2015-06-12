<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periode
 *
 * @ORM\Table(name="ost_periodes")
 * @ORM\Entity
 */
class Periode
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
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="periodes", fetch="EAGER")
     * @ORM\JoinColumn(name="saison_id", referencedColumnName="id",onDelete="CASCADE")
     */
    protected $saison;


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
     * @return Periode
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
     * @return Periode
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
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return Periode
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
    
    public function showPeriode()
    {
        if(date('Y-m-d')>= $this->dateDebut->format('Y-m-d') && date('Y-m-d')<= $this->dateFin->format('Y-m-d'))
            return "<span style='color:red' >".$this->dateDebut->format("d/m/Y").' - '.$this->dateFin->format("d/m/Y")."</span>";
        elseif(date('Y-m-d') > $this->dateFin->format('Y-m-d'))
            return "<s>".$this->dateDebut->format("d/m/Y").' - '.$this->dateFin->format("d/m/Y")."</s>";
        else
            return $this->dateDebut->format("d/m/Y").' - '.$this->dateFin->format("d/m/Y");
    }
    
    public function getCurrentPeriode()
    {
        if(date('Y-m-d')>= $this->dateDebut->format('Y-m-d') && date('Y-m-d')<= $this->dateFin->format('Y-m-d'))
            return $this->dateDebut->format('d/m/Y').' - '.$this->dateFin->format('d/m/Y');
    }
}
