<?php

namespace Back\BilletterieMaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Billetterie
 *
 * @ORM\Table(name="ost_billetterie_reservation")
 * @ORM\Entity(repositoryClass="Back\BilletterieMaritimeBundle\Entity\Repository\BilletterieReservationRepository")
 */
class BilletterieReservation
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
     * @var integer
     *
     * 1:Enregistr�e
     * 2:Valid�e
     * 9:Annul�e
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
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="reservationsBilletterie")
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
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservationsBilletterie")
     */
    protected $reglements;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeVol", type="integer")
     */
    private $typeVol;

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
     * @ORM\Column(name="cin", type="string", length=255)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

    /**
     * @var integer
     *
     * @ORM\Column(name="classe", type="integer")
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuDepart", type="string", length=255)
     */
    private $lieuDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuArriver", type="string", length=255)
     */
    private $lieuArriver;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="date")
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateArriver", type="date")
     */
    private $dateArriver;

    /**
     * @ORM\OneToMany(targetEntity="BilletterieReservationLigne", mappedBy="reservation")
     */
    protected $lignes;

    /**
     * @ORM\OneToMany(targetEntity="Back\AdministrationBundle\Entity\SousEtat", mappedBy="reservationB")
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
     * @var string
     *
     * @ORM\Column(name="total_achat", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $totalAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="total_vente", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $totalVente;

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
     * Set typeVol
     *
     * @param integer $typeVol
     * @return Billetterie
     */
    public function setTypeVol($typeVol)
    {
        $this->typeVol = $typeVol;

        return $this;
    }

    /**
     * Get typeVol
     *
     * @return integer
     */
    public function getTypeVol()
    {
        return $this->typeVol;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Billetterie
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
     * Set cin
     *
     * @param string $cin
     * @return Billetterie
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Billetterie
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
     * Set codePostal
     *
     * @param string $codePostal
     * @return Billetterie
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Billetterie
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Billetterie
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set classe
     *
     * @param integer $classe
     * @return Billetterie
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return integer
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set lieuDepart
     *
     * @param string $lieuDepart
     * @return Billetterie
     */
    public function setLieuDepart($lieuDepart)
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    /**
     * Get lieuDepart
     *
     * @return string
     */
    public function getLieuDepart()
    {
        return $this->lieuDepart;
    }

    /**
     * Set lieuArriver
     *
     * @param string $lieuArriver
     * @return Billetterie
     */
    public function setLieuArriver($lieuArriver)
    {
        $this->lieuArriver = $lieuArriver;

        return $this;
    }

    /**
     * Get lieuArriver
     *
     * @return string
     */
    public function getLieuArriver()
    {
        return $this->lieuArriver;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     * @return Billetterie
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dateArriver
     *
     * @param \DateTime $dateArriver
     * @return Billetterie
     */
    public function setDateArriver($dateArriver)
    {
        $this->dateArriver = $dateArriver;

        return $this;
    }

    /**
     * Get dateArriver
     *
     * @return \DateTime
     */
    public function getDateArriver()
    {
        return $this->dateArriver;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->remise=0;
        $this->timbre=0;
        $this->totalAchat=0;
        $this->totalVente=0;
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return BilletterieReservation
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
     * @return BilletterieReservation
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
     * @return BilletterieReservation
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
     * @return BilletterieReservation
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
     * Set responsable
     *
     * @param \Back\UserBundle\Entity\User $responsable
     * @return BilletterieReservation
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
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return BilletterieReservation
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
     * @return BilletterieReservation
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
     * Add lignes
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\BilletterieReservationLigne $lignes
     * @return BilletterieReservation
     */
    public function addLigne(\Back\BilletterieMaritimeBundle\Entity\BilletterieReservationLigne $lignes)
    {
        $this->lignes[] = $lignes;

        return $this;
    }

    /**
     * Remove lignes
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\BilletterieReservationLigne $lignes
     */
    public function removeLigne(\Back\BilletterieMaritimeBundle\Entity\BilletterieReservationLigne $lignes)
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
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return BilletterieReservation
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

    public function showTypeVole()
    {
        if ($this->getTypeVol() == 1)
            return "Aller-Retour";
        if ($this->getTypeVol() == 2)
            return "Aller-Simple";
        if ($this->getTypeVol() == 3)
            return "Multi-Segments";
    }

    public function showClasse()
    {
        if ($this->classe == 1)
            return "Economy";
        if ($this->classe == 2)
            return "Business";
        if ($this->classe == 3)
            return "First";
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return BilletterieReservation
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
     * @return BilletterieReservation
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

    public function showEtat()
    {
        if($this->etat == 1)
            return 'Enregistrée';
        if($this->etat == 2)
            return 'Validée';
        if($this->etat == 9)
            return 'Annulée';
    }

    /**
     * Add sousEtats
     *
     * @param \Back\AdministrationBundle\Entity\SousEtat $sousEtats
     * @return BilletterieReservation
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

    public function __toString()
    {
        return "Reservation : ".$this->getId();
    }

    /**
     * Set timbre
     *
     * @param string $timbre
     * @return BilletterieReservation
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
     * @return BilletterieReservation
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

    public function getTotal()
    {
        return number_format($this->totalVente+$this->timbre-$this->remise, 3, '.', '');
    }

    /**
     * Set totalAchat
     *
     * @param string $totalAchat
     * @return BilletterieReservation
     */
    public function setTotalAchat($totalAchat)
    {
        $this->totalAchat = $totalAchat;

        return $this;
    }

    /**
     * Get totalAchat
     *
     * @return string 
     */
    public function getTotalAchat()
    {
        return $this->totalAchat;
    }

    /**
     * Set totalVente
     *
     * @param string $totalVente
     * @return BilletterieReservation
     */
    public function setTotalVente($totalVente)
    {
        $this->totalVente = $totalVente;

        return $this;
    }

    /**
     * Get totalVente
     *
     * @return string 
     */
    public function getTotalVente()
    {
        return $this->totalVente;
    }
}
