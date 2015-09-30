<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationPersonne
 *
 * @ORM\Table(name="ost_vo_reservation_personnes")
 * @ORM\Entity()
 */
class ReservationPersonne
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
     * @ORM\Column(name="enfant", type="boolean" , nullable=true)
     */
    private $enfant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_prenom", type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer",nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="passport", type="string", length=100)
     */
    private $passport;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationChambre", inversedBy="occupants",cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $chambre;

    /**
     * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="personne")
     */
    protected $lignes;

    /**
     * @ORM\ManyToOne(targetEntity="Chambre", inversedBy="personnes")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $chambreContingent;

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
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return ReservationPersonne
     */
    public function setNomPrenom($nomPrenom)
    {
        $this->nomPrenom = $nomPrenom;

        return $this;
    }

    /**
     * Get nomPrenom
     *
     * @return string
     */
    public function getNomPrenom()
    {
        return $this->nomPrenom;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return ReservationPersonne
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return ReservationPersonne
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get passport
     *
     * @return string
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * Set passport
     *
     * @param string $passport
     * @return ReservationPersonne
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set enfant
     *
     * @param boolean $enfant
     * @return ReservationPersonne
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant
     *
     * @return boolean 
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * Set chambre
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationChambre $chambre
     * @return ReservationPersonne
     */
    public function setChambre(\Back\VoyageOrganiseBundle\Entity\ReservationChambre $chambre = null)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return \Back\VoyageOrganiseBundle\Entity\ReservationChambre 
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Add lignes
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationLigne $lignes
     * @return ReservationPersonne
     */
    public function addLigne(\Back\VoyageOrganiseBundle\Entity\ReservationLigne $lignes)
    {
        $this->lignes[] = $lignes;

        return $this;
    }

    /**
     * Remove lignes
     *
     * @param \Back\VoyageOrganiseBundle\Entity\ReservationLigne $lignes
     */
    public function removeLigne(\Back\VoyageOrganiseBundle\Entity\ReservationLigne $lignes)
    {
        $this->lignes->removeElement($lignes);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLignes()
    {
        return $this->lignes;
    }
    
    /**
     * Get total Vente
     *
     * @return string 
     */
    public function getTotalLigneVente()
    {
        $total = 0;
            foreach ($this->lignes as $ligne)
                $total+=$ligne->getVente();
        return $total;
    }

    /**
     * Get total Achat
     *
     * @return string 
     */
    public function getTotalLigneAchat()
    {
        $total = 0;
            foreach ($this->lignes as $ligne)
                $total+=$ligne->getAchat();
        return $total;
    }

    public function __toString()
    {
        return $this->nomPrenom;
    }

    /**
     * Set chambreContingent
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Chambre $chambreContingent
     * @return ReservationPersonne
     */
    public function setChambreContingent(\Back\VoyageOrganiseBundle\Entity\Chambre $chambreContingent = null)
    {
        $this->chambreContingent = $chambreContingent;

        return $this;
    }

    /**
     * Get chambreContingent
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Chambre 
     */
    public function getChambreContingent()
    {
        return $this->chambreContingent;
    }
}
