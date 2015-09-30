<?php
namespace Back\BienEtreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="ost_be_reservations")
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
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="Produit")
     * @Assert\NotBlank()
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="Tarif")
     */
    private $tarif;

    /**
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="reservationsPR")
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
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservationBE")
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
     * @var string
     *
     * @ORM\Column(name="timbre", type="decimal", precision=2, scale=1,nullable=true)
     */
    private $timbre;

    /**
     * @var string
     *
     * @ORM\Column(name="remise", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $remise;

    /**
     * @ORM\OneToMany(targetEntity="Back\AdministrationBundle\Entity\SousEtat", mappedBy="reservationPR")
     */
    protected $sousEtats;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_personne", type="integer")
     */
    private $nombrePersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPrenom", type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sousEtats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->timbre=0;
        $this->remise=0;
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
     * Set code
     *
     * @param string $code
     * @return Reservation
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
     * Set frontOffice
     *
     * @param boolean $frontOffice
     * @return Reservation
     */
    public function setFrontOffice($frontOffice)
    {
        $this->frontOffice = $frontOffice;

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
     * Set commentaire
     *
     * @param string $commentaire
     * @return Reservation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

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
     * Set timbre
     *
     * @param string $timbre
     * @return Reservation
     */
    public function setTimbre($timbre)
    {
        $this->timbre = $timbre;

        return $this;
    }

    /**
     * Get timbre
     *
     * @return string 
     */
    public function getTimbre()
    {
        return $this->timbre;
    }

    /**
     * Set remise
     *
     * @param string $remise
     * @return Reservation
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return string 
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set nombrePersonne
     *
     * @param integer $nombrePersonne
     * @return Reservation
     */
    public function setNombrePersonne($nombrePersonne)
    {
        $this->nombrePersonne = $nombrePersonne;

        return $this;
    }

    /**
     * Get nombrePersonne
     *
     * @return integer 
     */
    public function getNombrePersonne()
    {
        return $this->nombrePersonne;
    }

    /**
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return Reservation
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
     * Set email
     *
     * @param string $email
     * @return Reservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Reservation
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set responsable
     *
     * @param \Back\UserBundle\Entity\User $responsable
     * @return Reservation
     */
    public function setResponsable(\Back\UserBundle\Entity\User $responsable = null)
    {
        $this->responsable = $responsable;

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
     * Set produit
     *
     * @param \Back\BienEtreBundle\Entity\Produit $produit
     * @return Reservation
     */
    public function setProduit(\Back\BienEtreBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Back\BienEtreBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set tarif
     *
     * @param \Back\BienEtreBundle\Entity\Tarif $tarif
     * @return Reservation
     */
    public function setTarif(\Back\BienEtreBundle\Entity\Tarif $tarif = null)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return \Back\BienEtreBundle\Entity\Tarif 
     */
    public function getTarif()
    {
        return $this->tarif;
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
    
    public function getTotalAchat()
    {
        return number_format($this->nombrePersonne*$this->tarif->getPrixAchat(), '.', '');
    }
    
    public function getTotalVente()
    {
        return number_format($this->nombrePersonne*$this->tarif->getPrixVente(), '.', '');
    }
    
    public function getTotal()
    {
        return number_format($this->getTotalVente()+$this->timbre-$this->remise,3,'.','');
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
}
