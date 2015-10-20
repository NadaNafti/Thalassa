<?php

namespace Back\TransfertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransfertReservationLigne
 *
 * @ORM\Table(name="ost_transfert_reservation_ligne")
 * @ORM\Entity
 */
class TransfertReservationLigne
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
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre", type="integer")
     */
    private $nombre;


    /**
     * @ORM\ManyToOne(targetEntity="TransfertReservation", inversedBy="lignes",cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $reservation;

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
     * Set categorie
     *
     * @param string $categorie
     * @return TransfertReservationLigne
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     * @return TransfertReservationLigne
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return integer
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set reservation
     *
     * @param \Back\TransfertBundle\Entity\TransfertReservation $reservation
     * @return TransfertReservationLigne
     */
    public function setReservation(\Back\TransfertBundle\Entity\TransfertReservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Back\TransfertBundle\Entity\TransfertReservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }


    public function showCategorie(){
        switch($this->getCategorie()){
        case 1 : return "Véhicule de tourisme"; break ;
        case 2 : return "Véhicule monospace"; break ;
        case 3 : return "Véhicule Luxe et Confort"; break ;
        case 4 : return "4*4"; break ;
        case 5 : return "Grand Bus"; break ;
        case 6 : return "Mini Bus"; break ;
        case 7 : return "Autres"; break ;
            default:
                return "Aucune Donnée";
        }
    }
}
