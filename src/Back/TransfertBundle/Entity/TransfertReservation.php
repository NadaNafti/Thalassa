<?php

namespace Back\TransfertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Transfert
 *
 * @ORM\Table(name="ost_transfer_reservation")
 * @ORM\Entity(repositoryClass="Back\TransfertBundle\Entity\Repository\TransfertReservationRepository")
 */
class TransfertReservation
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
     * @ORM\ManyToOne(targetEntity="Back\UserBundle\Entity\Client", inversedBy="reservationsT")
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
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Reglement", mappedBy="reservationsT")
     */
    protected $reglements;

    /**
     * @var string
     *
     * @ORM\Column(name="organisme", type="string", length=255)
     */
    private $organisme;

    /**
     * @var string
     *
     * @ORM\Column(name="DepartDe", type="string", length=255)
     */
    private $departDe;

    /**
     * @var string
     *
     * @ORM\Column(name="heureDepart", type="string")
     */
    private $heureDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="date")
     */
    private $dateDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="ArriveeA", type="string", length=255)
     */
    private $arriveeA;

    /**
     * @var string
     *
     * @ORM\Column(name="heureArrivee", type="string")
     */
    private $heureArrivee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateArrivee", type="date")
     */
    private $dateArrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="pointDepartArrivee", type="string", length=255)
     */
    private $pointDepartArrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPrenom", type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="TransfertReservationLigne", mappedBy="reservation")
     */
    protected $lignes;

    /**
     * @ORM\OneToMany(targetEntity="Back\AdministrationBundle\Entity\SousEtat", mappedBy="reservationT")
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
     * Constructor
     */
    public function __construct()
    {
        $this->reglements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sousEtats = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set etat
     *
     * @param integer $etat
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * Set organisme
     *
     * @param string $organisme
     * @return TransfertReservation
     */
    public function setOrganisme($organisme)
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * Get organisme
     *
     * @return string
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * Set departDe
     *
     * @param string $departDe
     * @return TransfertReservation
     */
    public function setDepartDe($departDe)
    {
        $this->departDe = $departDe;

        return $this;
    }

    /**
     * Get departDe
     *
     * @return string
     */
    public function getDepartDe()
    {
        return $this->departDe;
    }



    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     * @return TransfertReservation
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
     * Set arriveeA
     *
     * @param string $arriveeA
     * @return TransfertReservation
     */
    public function setArriveeA($arriveeA)
    {
        $this->arriveeA = $arriveeA;

        return $this;
    }

    /**
     * Get arriveeA
     *
     * @return string
     */
    public function getArriveeA()
    {
        return $this->arriveeA;
    }



    /**
     * Set dateArrivee
     *
     * @param \DateTime $dateArrivee
     * @return TransfertReservation
     */
    public function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    /**
     * Get dateArrivee
     *
     * @return \DateTime
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * Set pointDepartArrivee
     *
     * @param string $pointDepartArrivee
     * @return TransfertReservation
     */
    public function setPointDepartArrivee($pointDepartArrivee)
    {
        $this->pointDepartArrivee = $pointDepartArrivee;

        return $this;
    }

    /**
     * Get pointDepartArrivee
     *
     * @return string
     */
    public function getPointDepartArrivee()
    {
        return $this->pointDepartArrivee;
    }

    /**
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return TransfertReservation
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
     * Set tel
     *
     * @param string $tel
     * @return TransfertReservation
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
     * Set email
     *
     * @param string $email
     * @return TransfertReservation
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
     * Set created
     *
     * @param \DateTime $created
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @return TransfertReservation
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

    /**
     * Set responsable
     *
     * @param \Back\UserBundle\Entity\User $responsable
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @return TransfertReservation
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
     * @param \Back\TransfertBundle\Entity\TransfertReservationLigne $lignes
     * @return TransfertReservation
     */
    public function addLigne(\Back\TransfertBundle\Entity\TransfertReservationLigne $lignes)
    {
        $this->lignes[] = $lignes;

        return $this;
    }

    /**
     * Remove lignes
     *
     * @param \Back\TransfertBundle\Entity\TransfertReservationLigne $lignes
     */
    public function removeLigne(\Back\TransfertBundle\Entity\TransfertReservationLigne $lignes)
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
     * Add sousEtats
     *
     * @param \Back\AdministrationBundle\Entity\SousEtat $sousEtats
     * @return TransfertReservation
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

    /**
     * Set heureDepart
     *
     * @param string $heureDepart
     * @return TransfertReservation
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    /**
     * Get heureDepart
     *
     * @return string
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * Set heureArrivee
     *
     * @param string $heureArrivee
     * @return TransfertReservation
     */
    public function setHeureArrivee($heureArrivee)
    {
        $this->heureArrivee = $heureArrivee;

        return $this;
    }

    /**
     * Get heureArrivee
     *
     * @return string
     */
    public function getHeureArrivee()
    {
        return $this->heureArrivee;
    }


    public function showOrganisme(){
        switch($this->getOrganisme()){
        case 1 : return "Particulier" ; break;
        case 2 : return "Société" ; break;
        case 3 : return "Etablissement" ; break;
        case 4 : return "Autres" ; break;
            default:
                return "Aucune Donnée" ;
        }
    }



    public function showDepart(){
        switch($this->getDepartDe()){
        case 0  : return ""; break;
        case 1  : return "Ain Draham"; break;
        case 2  : return "Bizerte"; break;
        case 3  : return "Côtes de Carthage"; break;
        case 4  : return "Djerba"; break;
        case 5  : return "Douz"; break;
        case 6  : return "Gabes"; break;
        case 7  : return "Gafsas"; break;
        case 8  : return "Hammamet"; break;
        case 9  : return "Kebili"; break;
        case 10 : return "Kelibia"; break;
        case 11 : return "Korba"; break;
        case 12 : return "Korbous"; break;
        case 13 : return "Ksar Ghilane"; break;
        case 14 : return "Mahdia"; break;
        case 15 : return "Matmata"; break;
        case 16 : return "Monastir"; break;
        case 17 : return "Nabeul"; break;
        case 18 : return "Nefta"; break;
        case 19 : return "Sfax"; break;
        case 20 : return "Sousse"; break;
        case 21 : return "Tabarka"; break;
        case 22 : return "Tamerza"; break;
        case 23 : return "Tataouine"; break;
        case 24 : return "Tozeur"; break;
        case 25 : return "Tunis ville"; break;
        case 26 : return "Zarzis"; break;
            default:
                return "Aucune Donnée";
        }

    }

    public function showArrivee(){
        switch($this->getArriveeA()){
            case 0  : return ""; break;
            case 1  : return "Ain Draham"; break;
            case 2  : return "Bizerte"; break;
            case 3  : return "Côtes de Carthage"; break;
            case 4  : return "Djerba"; break;
            case 5  : return "Douz"; break;
            case 6  : return "Gabes"; break;
            case 7  : return "Gafsas"; break;
            case 8  : return "Hammamet"; break;
            case 9  : return "Kebili"; break;
            case 10 : return "Kelibia"; break;
            case 11 : return "Korba"; break;
            case 12 : return "Korbous"; break;
            case 13 : return "Ksar Ghilane"; break;
            case 14 : return "Mahdia"; break;
            case 15 : return "Matmata"; break;
            case 16 : return "Monastir"; break;
            case 17 : return "Nabeul"; break;
            case 18 : return "Nefta"; break;
            case 19 : return "Sfax"; break;
            case 20 : return "Sousse"; break;
            case 21 : return "Tabarka"; break;
            case 22 : return "Tamerza"; break;
            case 23 : return "Tataouine"; break;
            case 24 : return "Tozeur"; break;
            case 25 : return "Tunis ville"; break;
            case 26 : return "Zarzis"; break;
            default:
                return "Aucune Donnée";
        }
    }

    public function showPointDA(){
        switch($this->getPointDepartArrivee()){
        case 1 : return 'Aéroport'; break ;
        case 2 : return 'Hôtel'; break ;
        case 3 : return 'Autres'; break ;
            default:
                return "Aucune Donnée";
        }
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
}
