<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationJour
 *
 * @ORM\Table(name="ost_sht_reservation_chambre_jour")
 * @ORM\Entity
 */
class ReservationChambreJour
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
     * @ORM\ManyToOne(targetEntity="Saison")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $saisonCalcule;

    /**
     * @ORM\ManyToOne(targetEntity="Saison")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $saisonContingent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour", type="date")
     */
    private $jour;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationChambre", inversedBy="jours")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $chambre;


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
     * Set jour
     *
     * @param \DateTime $jour
     * @return ReservationChambreJour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return \DateTime 
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set saisonCalcule
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saisonCalcule
     * @return ReservationChambreJour
     */
    public function setSaisonCalcule(\Back\HotelTunisieBundle\Entity\Saison $saisonCalcule = null)
    {
        $this->saisonCalcule = $saisonCalcule;

        return $this;
    }

    /**
     * Get saisonCalcule
     *
     * @return \Back\HotelTunisieBundle\Entity\Saison 
     */
    public function getSaisonCalcule()
    {
        return $this->saisonCalcule;
    }

    /**
     * Set saisonContingent
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saisonContingent
     * @return ReservationChambreJour
     */
    public function setSaisonContingent(\Back\HotelTunisieBundle\Entity\Saison $saisonContingent = null)
    {
        $this->saisonContingent = $saisonContingent;

        return $this;
    }

    /**
     * Get saisonContingent
     *
     * @return \Back\HotelTunisieBundle\Entity\Saison 
     */
    public function getSaisonContingent()
    {
        return $this->saisonContingent;
    }

    /**
     * Set chambre
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationChambre $chambre
     * @return ReservationChambreJour
     */
    public function setChambre(\Back\HotelTunisieBundle\Entity\ReservationChambre $chambre = null)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return \Back\HotelTunisieBundle\Entity\ReservationChambre 
     */
    public function getChambre()
    {
        return $this->chambre;
    }
}
