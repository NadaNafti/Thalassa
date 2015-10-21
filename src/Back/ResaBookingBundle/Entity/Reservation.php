<?php


namespace Back\ResaBookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Billetterie
 *
 * @ORM\Table(name="ost_resa_resarvation")
 * @ORM\Entity()
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
     * @ORM\Column( type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column( type="datetime")
     */
    private $dateFin;

    /**
     * @var integer
     *
     * 1:Enregistr�e
     * 2:Valid�e
     * 9:Annul�e
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="reservationsRB")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $client;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validated", type="datetime" ,nullable=true)
     */
    private $validated;

    /**
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservationsRB")
     */
    protected $reglements;

    /**
     * @ORM\OneToMany(targetEntity="Back\AdministrationBundle\Entity\SousEtat", mappedBy="reservationRV")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $sousEtats;

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
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $total;

    /**
     * @var array
     *
     * @ORM\Column(name="reponseDevis", type="json_array")
     */
    private $reponseDevis;

    /**
     * @var array
     *
     * @ORM\Column(name="reponseBooking", type="json_array")
     */
    private $reponseBooking;

    /**
     * @var array
     *
     * @ORM\Column(name="travellers", type="json_array")
     */
    private $travellers;

    /**
     * @var array
     *
     * @ORM\Column(name="responsable", type="json_array")
     */
    private $responsable;

    /**
     * @var array
     *
     * @ORM\Column(name="reponseTunisieMonetique", type="json_array")
     */
    private $reponseTunisieMonetique;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sousEtats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reponseDevis=array();
        $this->reponseBooking=array();
        $this->reponseTunisieMonetique=array();
        $this->travellers=array();
        $this->responsable=array();
        $this->total=0;
        $this->etat=1;
    }

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
     * @return Reservation
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
     * Set etat
     *
     * @param integer $etat
     * @return Reservation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

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
     * Set validated
     *
     * @param \DateTime $validated
     * @return Reservation
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

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
     * Set created
     *
     * @param \DateTime $created
     * @return Reservation
     */
    public function setCreated($created)
    {
        $this->created = $created;

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
        $this->updated = $updated;

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
     * Set total
     *
     * @param string $total
     * @return Reservation
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set reponseDevis
     *
     * @param array $reponseDevis
     * @return Reservation
     */
    public function setReponseDevis($reponseDevis)
    {
        $this->reponseDevis = $reponseDevis;

        return $this;
    }

    /**
     * Get reponseDevis
     *
     * @return array 
     */
    public function getReponseDevis()
    {
        return $this->reponseDevis;
    }

    /**
     * Set reponseBooking
     *
     * @param array $reponseBooking
     * @return Reservation
     */
    public function setReponseBooking($reponseBooking)
    {
        $this->reponseBooking = $reponseBooking;

        return $this;
    }

    /**
     * Get reponseBooking
     *
     * @return array 
     */
    public function getReponseBooking()
    {
        return $this->reponseBooking;
    }

    /**
     * Set travellers
     *
     * @param array $travellers
     * @return Reservation
     */
    public function setTravellers($travellers)
    {
        $this->travellers = $travellers;

        return $this;
    }

    /**
     * Get travellers
     *
     * @return array 
     */
    public function getTravellers()
    {
        return $this->travellers;
    }

    /**
     * Set responsable
     *
     * @param array $responsable
     * @return Reservation
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return array 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set reponseTunisieMonetique
     *
     * @param array $reponseTunisieMonetique
     * @return Reservation
     */
    public function setReponseTunisieMonetique($reponseTunisieMonetique)
    {
        $this->reponseTunisieMonetique = $reponseTunisieMonetique;

        return $this;
    }

    /**
     * Get reponseTunisieMonetique
     *
     * @return array 
     */
    public function getReponseTunisieMonetique()
    {
        return $this->reponseTunisieMonetique;
    }

    /**
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return Reservation
     */
    public function setClient(\Back\UserBundle\Entity\Client $client = null)
    {
        $this->client = $client;

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

    /**
     * Add sousEtats
     *
     * @param \Back\AdministrationBundle\Entity\SousEtat $sousEtats
     * @return Reservation
     */
    public function addSousEtat(\Back\AdministrationBundle\Entity\SousEtat $sousEtats)
    {
        $this->sousEtats[] = $sousEtats;

        return $this;
    }

    /**
     * Remove sousEtats
     *
     * @param \Back\AdministrationBundle\Entity\SousEtat $sousEtats
     */
    public function removeSousEtat(\Back\AdministrationBundle\Entity\SousEtat $sousEtats)
    {
        $this->sousEtats->removeElement($sousEtats);
    }

    /**
     * Get sousEtats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSousEtats()
    {
        return $this->sousEtats;
    }

    public function showEtat()
    {
        if ($this->etat == 1)
            return 'Enregistrée';
        if ($this->etat == 2)
            return 'Validée';
        if ($this->etat == 9)
            return 'Annulée';
    }

    public function getMontantRegle()
    {
        $montant = 0;
        foreach ($this->reglements as $reglement)
            $montant += $reglement->getMontant();
        return number_format($montant, 3, '.', '');
    }

    public function getMontantRestant()
    {
        return number_format($this->getTotal() - $this->getMontantRegle(), 3, '.', '');
    }
}
