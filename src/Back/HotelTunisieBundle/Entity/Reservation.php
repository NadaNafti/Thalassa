<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="ost_sht_reservation")
 * @ORM\Entity(repositoryClass="Back\HotelTunisieBundle\Entity\ReservationRepository")
 */
class Reservation
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
     * @ORM\Column(name="code", type="string",nullable=true)
     */
    private $code;

    /**
     * @var integer
     *
     * 1:Enregistrée
     * 2:Validée
     * 9:Annulée
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\User")
     */
    protected $responsable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="frontOffice", type="boolean", nullable=true)
     */
    private $frontOffice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hotelNotifier", type="boolean", nullable=true)
     */
    private $hotelNotifier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="surDemande", type="boolean", nullable=true)
     */
    private $surDemande;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel")
     */
    protected $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="reservations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $client;

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
     * @var integer
     *
     * @ORM\Column(name="nuitees", type="integer")
     */
    private $nuitees;

    /**
     * @ORM\OneToMany(targetEntity="ReservationChambre", mappedBy="reservation")
     */
    protected $chambres;

    /**
     * @var array
     *
     * @ORM\Column(name="options", type="array")
     */
    private $options;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validated", type="datetime" ,nullable=true)
     */
    private $validated;

    /**
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservation")
     */
    protected $reglements;

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
     * @return Reservation
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut=$dateDebut;

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
     * @return Reservation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin=$dateFin;

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
     * Set nuitees
     *
     * @param integer $nuitees
     * @return Reservation
     */
    public function setNuitees($nuitees)
    {
        $this->nuitees=$nuitees;

        return $this;
    }

    /**
     * Get nuitees
     *
     * @return integer 
     */
    public function getNuitees()
    {
        return $this->nuitees;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Reservation
     */
    public function setCreated($created)
    {
        $this->created=$created;

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
     * @return Reservation
     */
    public function setUpdated($updated)
    {
        $this->updated=$updated;

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
     * Set hotel
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotel
     * @return Reservation
     */
    public function setHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotel=null)
    {
        $this->hotel=$hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Back\HotelTunisieBundle\Entity\Hotel 
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chambres=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return Reservation
     */
    public function setClient(\Back\UserBundle\Entity\Client $client=null)
    {
        $this->client=$client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Back\UserBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationChambre $chambres
     * @return Reservation
     */
    public function addChambre(\Back\HotelTunisieBundle\Entity\ReservationChambre $chambres)
    {
        $this->chambres[]=$chambres;

        return $this;
    }

    /**
     * Remove chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\ReservationChambre $chambres
     */
    public function removeChambre(\Back\HotelTunisieBundle\Entity\ReservationChambre $chambres)
    {
        $this->chambres->removeElement($chambres);
    }

    /**
     * Get chambres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChambres()
    {
        return $this->chambres;
    }

    /**
     * Set frontOffice
     *
     * @param boolean $frontOffice
     * @return Reservation
     */
    public function setFrontOffice($frontOffice)
    {
        $this->frontOffice=$frontOffice;

        return $this;
    }

    /**
     * Get frontOffice
     *
     * @return boolean 
     */
    public function getFrontOffice()
    {
        return $this->frontOffice;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Reservation
     */
    public function setEtat($etat)
    {
        $this->etat=$etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set responsable
     *
     * @param \Back\UserBundle\Entity\User $responsable
     * @return Reservation
     */
    public function setResponsable(\Back\UserBundle\Entity\User $responsable=null)
    {
        $this->responsable=$responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \Back\UserBundle\Entity\User 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set surDemande
     *
     * @param boolean $surDemande
     * @return Reservation
     */
    public function setSurDemande($surDemande)
    {
        $this->surDemande=$surDemande;

        return $this;
    }

    /**
     * Get surDemande
     *
     * @return boolean 
     */
    public function getSurDemande()
    {
        return $this->surDemande;
    }

    public function showEtat()
    {
        if($this->etat == 1)
            return 'Enregistrée';
        if($this->etat == 2)
            return 'Validée';
        if($this->etat == 9)
            return 'Annulée';
    }

    public function getTotal()
    {
        $total=0;
        foreach($this->chambres as $chambre)
        {
            $total+=$chambre->getTotal();
        }
        return number_format($total, 3, '.', '');
    }

    /**
     * Set hotelNotifier
     *
     * @param boolean $hotelNotifier
     * @return Reservation
     */
    public function setHotelNotifier($hotelNotifier)
    {
        $this->hotelNotifier=$hotelNotifier;

        return $this;
    }

    /**
     * Get hotelNotifier
     *
     * @return boolean 
     */
    public function getHotelNotifier()
    {
        return $this->hotelNotifier;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Reservation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire=$commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Reservation
     */
    public function setCode($code)
    {
        $this->code=$code;

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
     * Set validated
     *
     * @param \DateTime $validated
     * @return Reservation
     */
    public function setValidated($validated)
    {
        $this->validated=$validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return \DateTime 
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * Set options
     *
     * @param array $options
     * @return Reservation
     */
    public function setOptions($options)
    {
        $this->options=$options;

        return $this;
    }

    /**
     * Get options
     *
     * @return array 
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function calcVente()
    {
        $vente=0;
        foreach($this->chambres as $chambre)
            $vente+=$chambre->getTotal();
        return number_format($vente, 3, '.', '');
    }

    public function calcAchat()
    {
        $achat=0;
        foreach($this->chambres as $chambre)
            $achat+=$chambre->getTotalAchat();
        return number_format($achat, 3, '.', '');
    }


    /**
     * Add reglements
     *
     * @param \Back\CommercialBundle\Entity\Reglement $reglements
     * @return Reservation
     */
    public function addReglement(\Back\CommercialBundle\Entity\Reglement $reglements)
    {
        $this->reglements[] = $reglements;

        return $this;
    }

    /**
     * Remove reglements
     *
     * @param \Back\CommercialBundle\Entity\Reglement $reglements
     */
    public function removeReglement(\Back\CommercialBundle\Entity\Reglement $reglements)
    {
        $this->reglements->removeElement($reglements);
    }

    /**
     * Get reglements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReglements()
    {
        return $this->reglements;
    }
}
