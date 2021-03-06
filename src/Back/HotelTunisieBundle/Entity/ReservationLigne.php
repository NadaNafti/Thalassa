<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationLigne
 *
 * @ORM\Table(name="ost_sht_reservation_ligne")
 * @ORM\Entity
 */
class ReservationLigne
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
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="achat", type="decimal", precision=11, scale=3)
     */
    private $achat;

    /**
     * @var string
     *
     * @ORM\Column(name="vente", type="decimal", precision=11, scale=3)
     */
    private $vente;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationChambre", inversedBy="supplementLignes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $supplement;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationChambre", inversedBy="reductionLignes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reduction;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationJour", inversedBy="lignes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $jour;

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
     * Set code
     *
     * @param string $code
     * @return ReservationLigne
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return ReservationLigne
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
     * Set achat
     *
     * @param string $achat
     * @return ReservationLigne
     */
    public function setAchat($achat)
    {
        $this->achat = $achat;

        return $this;
    }

    /**
     * Get achat
     *
     * @return string 
     */
    public function getAchat()
    {
        return $this->achat;
    }

    /**
     * Set vente
     *
     * @param string $vente
     * @return ReservationLigne
     */
    public function setVente($vente)
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * Get vente
     *
     * @return string 
     */
    public function getVente()
    {
        return $this->vente;
    }

    /**
     * Set supplement
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationChambre $supplement
     * @return ReservationLigne
     */
    public function setSupplement(\Back\HotelTunisieBundle\Entity\ReservationChambre $supplement = null)
    {
        $this->supplement = $supplement;

        return $this;
    }

    /**
     * Get supplement
     *
     * @return \Back\HotelTunisieBundle\Entity\ReservationChambre 
     */
    public function getSupplement()
    {
        return $this->supplement;
    }

    /**
     * Set reduction
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationChambre $reduction
     * @return ReservationLigne
     */
    public function setReduction(\Back\HotelTunisieBundle\Entity\ReservationChambre $reduction = null)
    {
        $this->reduction = $reduction;

        return $this;
    }

    /**
     * Get reduction
     *
     * @return \Back\HotelTunisieBundle\Entity\ReservationChambre 
     */
    public function getReduction()
    {
        return $this->reduction;
    }


    /**
     * Set jour
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationJour $jour
     * @return ReservationLigne
     */
    public function setJour(\Back\HotelTunisieBundle\Entity\ReservationJour $jour = null)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return \Back\HotelTunisieBundle\Entity\ReservationJour 
     */
    public function getJour()
    {
        return $this->jour;
    }
}
