<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationChambre
 *
 * @ORM\Table(name="ost_sht_reservation_chambre")
 * @ORM\Entity(repositoryClass="Back\HotelTunisieBundle\Entity\Repository\ReservationChambreRepository")
 */
class ReservationChambre
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
     * @ORM\ManyToOne(targetEntity="Chambre")
     */
    protected $chambre;

    /**
     * @ORM\ManyToOne(targetEntity="Arrangement")
     */
    protected $arrangement;

    /**
     * @var array
     *
     * @ORM\Column(name="occupants", type="array")
     */
    private $occupants;

    /**
     * @var array
     *
     * @ORM\Column(name="noms", type="array")
     */
    private $noms;

    /**
     * @var array
     *
     * @ORM\Column(name="supplements", type="array")
     */
    private $supplements;

    /**
     * @var array
     *
     * @ORM\Column(name="reductions", type="array")
     */
    private $reductions;

    /**
     * @var array
     *
     * @ORM\Column(name="vues", type="array")
     */
    private $vues;

    /**
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="chambres")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reservation;

    /**
     * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="supplement")
     */
    protected $supplementLignes;

    /**
     * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="reduction")
     */
    protected $reductionLignes;

    /**
     * @ORM\OneToMany(targetEntity="ReservationPersonne", mappedBy="reservationChambreAdulte")
     */
    protected $adultes;

    /**
     * @ORM\OneToMany(targetEntity="ReservationPersonne", mappedBy="reservationChambreEnfant")
     */
    protected $enfants;

    /**
     * @ORM\OneToMany(targetEntity="ReservationChambreJour", mappedBy="chambre")
     */
    protected $jours;

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
     * Set occupants
     *
     * @param array $occupants
     * @return ReservationChambre
     */
    public function setOccupants($occupants)
    {
        $this->occupants = $occupants;

        return $this;
    }

    /**
     * Get occupants
     *
     * @return array 
     */
    public function getOccupants()
    {
        return $this->occupants;
    }

    /**
     * Set noms
     *
     * @param array $noms
     * @return ReservationChambre
     */
    public function setNoms($noms)
    {
        $this->noms = $noms;

        return $this;
    }

    /**
     * Get noms
     *
     * @return array 
     */
    public function getNoms()
    {
        return $this->noms;
    }

    /**
     * Set supplements
     *
     * @param array $supplements
     * @return ReservationChambre
     */
    public function setSupplements($supplements)
    {
        $this->supplements = $supplements;

        return $this;
    }

    /**
     * Get supplements
     *
     * @return array 
     */
    public function getSupplements()
    {
        return $this->supplements;
    }

    /**
     * Set reductions
     *
     * @param array $reductions
     * @return ReservationChambre
     */
    public function setReductions($reductions)
    {
        $this->reductions = $reductions;

        return $this;
    }

    /**
     * Get reductions
     *
     * @return array 
     */
    public function getReductions()
    {
        return $this->reductions;
    }

    /**
     * Set vues
     *
     * @param array $vues
     * @return ReservationChambre
     */
    public function setVues($vues)
    {
        $this->vues = $vues;

        return $this;
    }

    /**
     * Get vues
     *
     * @return array 
     */
    public function getVues()
    {
        return $this->vues;
    }

    /**
     * Set chambre
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambre
     * @return ReservationChambre
     */
    public function setChambre(\Back\HotelTunisieBundle\Entity\Chambre $chambre = null)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return \Back\HotelTunisieBundle\Entity\Chambre 
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set arrangement
     *
     * @param \Back\HotelTunisieBundle\Entity\Arrangement $arrangement
     * @return ReservationChambre
     */
    public function setArrangement(\Back\HotelTunisieBundle\Entity\Arrangement $arrangement = null)
    {
        $this->arrangement = $arrangement;

        return $this;
    }

    /**
     * Get arrangement
     *
     * @return \Back\HotelTunisieBundle\Entity\Arrangement 
     */
    public function getArrangement()
    {
        return $this->arrangement;
    }

    /**
     * Set reservation
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservation
     * @return ReservationChambre
     */
    public function setReservation(\Back\HotelTunisieBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Back\HotelTunisieBundle\Entity\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->supplementLignes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reductionLignes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add supplementLignes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationLigne $supplementLignes
     * @return ReservationChambre
     */
    public function addSupplementLigne(\Back\HotelTunisieBundle\Entity\ReservationLigne $supplementLignes)
    {
        $this->supplementLignes[] = $supplementLignes;

        return $this;
    }

    /**
     * Remove supplementLignes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationLigne $supplementLignes
     */
    public function removeSupplementLigne(\Back\HotelTunisieBundle\Entity\ReservationLigne $supplementLignes)
    {
        $this->supplementLignes->removeElement($supplementLignes);
    }

    /**
     * Get supplementLignes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSupplementLignes()
    {
        return $this->supplementLignes;
    }

    /**
     * Add reductionLignes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationLigne $reductionLignes
     * @return ReservationChambre
     */
    public function addReductionLigne(\Back\HotelTunisieBundle\Entity\ReservationLigne $reductionLignes)
    {
        $this->reductionLignes[] = $reductionLignes;

        return $this;
    }

    /**
     * Remove reductionLignes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationLigne $reductionLignes
     */
    public function removeReductionLigne(\Back\HotelTunisieBundle\Entity\ReservationLigne $reductionLignes)
    {
        $this->reductionLignes->removeElement($reductionLignes);
    }

    /**
     * Get reductionLignes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReductionLignes()
    {
        return $this->reductionLignes;
    }


    /**
     * Add adultes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationPersonne $adultes
     * @return ReservationChambre
     */
    public function addAdulte(\Back\HotelTunisieBundle\Entity\ReservationPersonne $adultes)
    {
        $this->adultes[] = $adultes;

        return $this;
    }

    /**
     * Remove adultes
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationPersonne $adultes
     */
    public function removeAdulte(\Back\HotelTunisieBundle\Entity\ReservationPersonne $adultes)
    {
        $this->adultes->removeElement($adultes);
    }

    /**
     * Get adultes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdultes()
    {
        return $this->adultes;
    }

    /**
     * Add enfants
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationPersonne $enfants
     * @return ReservationChambre
     */
    public function addEnfant(\Back\HotelTunisieBundle\Entity\ReservationPersonne $enfants)
    {
        $this->enfants[] = $enfants;

        return $this;
    }

    /**
     * Remove enfants
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationPersonne $enfants
     */
    public function removeEnfant(\Back\HotelTunisieBundle\Entity\ReservationPersonne $enfants)
    {
        $this->enfants->removeElement($enfants);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnfants()
    {
        return $this->enfants;
    }
    
    public function getTotal()
    {
        $total=0;
        foreach($this->adultes as $personne)
            {
                foreach($personne->getJours() as $jour)
                {
                    foreach($jour->getLignes() as $ligne)
                        $total+=$ligne->getVente();
                }
            }
            foreach($this->enfants as $personne)
            {
                foreach($personne->getJours() as $jour)
                {
                    foreach($jour->getLignes() as $ligne)
                        $total+=$ligne->getVente();
                }
            }
            foreach($this->supplementLignes as $ligne)
                $total+=$ligne->getVente();
            foreach($this->reductionLignes as $ligne)
                $total-=$ligne->getVente();
            return number_format($total,3,'.','');
    }
    
    public function getTotalAchat()
    {
        $total=0;
        foreach($this->adultes as $personne)
            {
                foreach($personne->getJours() as $jour)
                {
                    foreach($jour->getLignes() as $ligne)
                        $total+=$ligne->getAchat();
                }
            }
            foreach($this->enfants as $personne)
            {
                foreach($personne->getJours() as $jour)
                {
                    foreach($jour->getLignes() as $ligne)
                        $total+=$ligne->getAchat();
                }
            }
            foreach($this->supplementLignes as $ligne)
                $total+=$ligne->getAchat();
            foreach($this->reductionLignes as $ligne)
                $total-=$ligne->getAchat();
            return number_format($total,3,'.','');
    }

    /**
     * Add jours
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationChambreJour $jours
     * @return ReservationChambre
     */
    public function addJour(\Back\HotelTunisieBundle\Entity\ReservationChambreJour $jours)
    {
        $this->jours[] = $jours;

        return $this;
    }

    /**
     * Remove jours
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationChambreJour $jours
     */
    public function removeJour(\Back\HotelTunisieBundle\Entity\ReservationChambreJour $jours)
    {
        $this->jours->removeElement($jours);
    }

    /**
     * Get jours
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJours()
    {
        return $this->jours;
    }
}
