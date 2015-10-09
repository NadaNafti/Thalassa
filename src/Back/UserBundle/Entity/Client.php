<?php

namespace Back\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Table(name="ost_client")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Client {

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
     * @ORM\Column(name="passager", type="boolean", nullable=true)
     */
    public $passager;

    /**
     * @var integer
     * 
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    public $type;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAltervatif", type="string", nullable=true)
     */
    public $nomAlternatif;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="nomPrenom", type="string", length=255, nullable=true)
     */
    private $nomPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=255, nullable=true)
     */
    private $tel1;

    /**
     * @var string
     *
     * @ORM\Column(name="tel2", type="string", length=255, nullable=true)
     */
    private $tel2;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     * @Assert\Email(
     *     message = "L'email n'est pas valide!"
     * )
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     * 
     * @ORM\Column(name="siteWeb", type="string", length=255, nullable=true)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var integer
     * 
     * @ORM\Column(name="codePostal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="gouvernorat", type="string", nullable=true)
     */
    private $gouvernorat;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Pays")
     * @ORM\OrderBy({"libelle" = "ASC"})
     */
    protected $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculeFiscale", type="string", length=255,nullable=true)
     */
    private $matriculeFiscale;

    /**
     * @var string
     *
     * @ORM\Column(name="registreCommercie", type="string", length=255,nullable=true)
     */
    private $registreCommercie;

    /**
     * @var string
     *
     * @ORM\Column(name="codeDouane", type="string", length=255,nullable=true)
     */
    private $codeDouane;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tva", type="boolean", nullable=true)
     */
    private $tva;

    /**
     * @var integer
     *
     * @ORM\Column(name="formeJuridique", type="integer", nullable=true)
     */
    private $formeJuridique;

    /**
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="client")
     * 
     */
    private $contacts;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="Back\AdministrationBundle\Entity\Amicale", inversedBy="clients")
     */
    protected $amicale;

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="client")
     * */
    private $user;

    /**
     * @var boolean
     *
     * @ORM\Column(name="responsable", type="boolean", nullable=true)
     */
    public $responsable;

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
     * @ORM\OneToMany(targetEntity="Back\HotelTunisieBundle\Entity\Reservation", mappedBy="client")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $reservationsSHT;

    /**
     * @ORM\OneToMany(targetEntity="Back\VoyageOrganiseBundle\Entity\Reservation", mappedBy="client")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $reservationsVO;

    /**
     * @ORM\OneToMany(targetEntity="Back\ProgrammeBundle\Entity\Reservation", mappedBy="client")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $reservationsPR;

    /**
     * @ORM\OneToMany(targetEntity="Back\BienEtreBundle\Entity\Reservation", mappedBy="client")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $reservationsBE;

    /**
     * @ORM\OneToMany(targetEntity="Back\BilletterieMaritimeBundle\Entity\BilletterieReservation", mappedBy="client")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $reservationsB;

    /**
     * @ORM\OneToMany(targetEntity="Back\BilletterieMaritimeBundle\Entity\MaritimeReservation", mappedBy="client")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected $reservationsM;

    /**
     * @ORM\OneToMany(targetEntity="Back\CommercialBundle\Entity\Piece", mappedBy="client")
     */
    protected $pieces;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;
    public $file;

    public function getUploadRootDir() {
        return __dir__ . '/../../../../web/' . $this->getDirectory();
    }

    public function getDirectory() {
        return 'uploads/crm/clients';
    }

    public function getAssetPath() {
        return $this->getDirectory() . '/' . $this->url;
    }

    public function getAbsolutePath() {
        return null === $this->url ? null : $this->getUploadRootDir() . '/' . $this->url;
    }

    /**
     * @ORM\PostLoad()
     */
    public function postLoad() {
        $this->updated = new \DateTime();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getUrl();
        $this->updated = new \DateTime();
        if (null !== $this->file)
            $this->url = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(), $this->url);
            unset($this->file);
            if ($this->oldFile != null && file_exists($this->tempFile))
                unlink($this->tempFile);
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload() {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if (file_exists($this->tempFile))
            unlink($this->tempFile);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return Client
     */
    public function setNomPrenom($nomPrenom) {
        $this->nomPrenom = $nomPrenom;
        return $this;
    }

    /**
     * Get nomPrenom
     *
     * @return string
     */
    public function getNomPrenom() {
        return $this->nomPrenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Client
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set matriculeFiscale
     *
     * @param string $matriculeFiscale
     * @return Client
     */
    public function setMatriculeFiscale($matriculeFiscale) {
        $this->matriculeFiscale = $matriculeFiscale;
        return $this;
    }

    /**
     * Get matriculeFiscale
     *
     * @return string
     */
    public function getMatriculeFiscale() {
        return $this->matriculeFiscale;
    }

    /**
     * Set registreCommercie
     *
     * @param string $registreCommercie
     * @return Client
     */
    public function setRegistreCommercie($registreCommercie) {
        $this->registreCommercie = $registreCommercie;
        return $this;
    }

    /**
     * Get registreCommercie
     *
     * @return string
     */
    public function getRegistreCommercie() {
        return $this->registreCommercie;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Client
     */
    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire() {
        return $this->commentaire;
    }

    /**
     * Set amicale
     *
     * @param \Back\AdministrationBundle\Entity\Amicale $amicale
     * @return Client
     */
    public function setAmicale(\Back\AdministrationBundle\Entity\Amicale $amicale = NULL) {
        $this->amicale = $amicale;
        return $this;
    }

    /**
     * Get amicale
     *
     * @return \Back\AdministrationBundle\Entity\Amicale
     */
    public function getAmicale() {
        return $this->amicale;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Client
     */
    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Client
     */
    public function setCreated($created) {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Client
     */
    public function setUpdated($updated) {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() {
        return $this->updated;
    }

    public function showProfileAmicale() {
        if ($this->responsable)
            return "Responsable";
        else
            return 'Employé';
    }

    public function __toString() {
        $amicale = "";
        if (!is_null($this->amicale))
            $amicale = " - " . $this->amicale;
        return $this->nomPrenom . $amicale;
    }

    public function getLongName() {
        $amical = !is_null($this->getAmicale()) ? ' - ' . $this->getAmicale()->getLibelle() : '';
        return $this->nomPrenom . $amical . ' - ' . $this->tel1;
    }

    /**
     * Set responsable
     *
     * @param boolean $responsable
     * @return Client
     */
    public function setResponsable($responsable) {
        $this->responsable = $responsable;
        return $this;
    }

    /**
     * Get responsable
     *
     * @return boolean
     */
    public function getResponsable() {
        return $this->responsable;
    }

    /**
     * Set user
     *
     * @param \Back\UserBundle\Entity\User $user
     * @return Client
     */
    public function setUser(\Back\UserBundle\Entity\User $user = NULL) {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \Back\UserBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->passager = FALSE;
        $this->responsable = FALSE;
        $this->reservationsSHT = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservationsPR = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservationsVO = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservationsBE = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservationsB = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservationsM = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reservations
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservations
     * @return Client
     */
    public function addReservation(\Back\HotelTunisieBundle\Entity\Reservation $reservations) {
        $this->reservations[] = $reservations;
        return $this;
    }

    /**
     * Remove reservations
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservations
     */
    public function removeReservation(\Back\HotelTunisieBundle\Entity\Reservation $reservations) {
        $this->reservations->removeElement($reservations);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations() {
        return $this->reservations;
    }

    /**
     * Add pieces
     *
     * @param \Back\CommercialBundle\Entity\Piece $pieces
     * @return Client
     */
    public function addPiece(\Back\CommercialBundle\Entity\Piece $pieces) {
        $this->pieces[] = $pieces;
        return $this;
    }

    /**
     * Remove pieces
     *
     * @param \Back\CommercialBundle\Entity\Piece $pieces
     */
    public function removePiece(\Back\CommercialBundle\Entity\Piece $pieces) {
        $this->pieces->removeElement($pieces);
    }

    /**
     * Get pieces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPieces() {
        return $this->pieces;
    }

    /**
     * Set passager
     *
     * @param boolean $passager
     * @return Client
     */
    public function setPassager($passager) {
        $this->passager = $passager;
        return $this;
    }

    /**
     * Get passager
     *
     * @return boolean
     */
    public function getPassager() {
        return $this->passager;
    }

    /**
     * Add reservationsSHT
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservationsSHT
     * @return Client
     */
    public function addReservationsSHT(\Back\HotelTunisieBundle\Entity\Reservation $reservationsSHT) {
        $this->reservationsSHT[] = $reservationsSHT;
        return $this;
    }

    /**
     * Remove reservationsSHT
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservationsSHT
     */
    public function removeReservationsSHT(\Back\HotelTunisieBundle\Entity\Reservation $reservationsSHT) {
        $this->reservationsSHT->removeElement($reservationsSHT);
    }

    /**
     * Get reservationsSHT
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservationsSHT() {
        return $this->reservationsSHT;
    }

    /**
     * Add reservationsVO
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Reservation $reservationsVO
     * @return Client
     */
    public function addReservationsVO(\Back\VoyageOrganiseBundle\Entity\Reservation $reservationsVO) {
        $this->reservationsVO[] = $reservationsVO;
        return $this;
    }

    /**
     * Remove reservationsVO
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Reservation $reservationsVO
     */
    public function removeReservationsVO(\Back\VoyageOrganiseBundle\Entity\Reservation $reservationsVO) {
        $this->reservationsVO->removeElement($reservationsVO);
    }

    /**
     * Get reservationsVO
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservationsVO() {
        return $this->reservationsVO;
    }

    /**
     * Add reservationsPR
     *
     * @param \Back\ProgrammeBundle\Entity\Reservation $reservationsPR
     * @return Client
     */
    public function addReservationsPR(\Back\ProgrammeBundle\Entity\Reservation $reservationsPR) {
        $this->reservationsPR[] = $reservationsPR;
        return $this;
    }

    /**
     * Remove reservationsPR
     *
     * @param \Back\ProgrammeBundle\Entity\Reservation $reservationsPR
     */
    public function removeReservationsPR(\Back\ProgrammeBundle\Entity\Reservation $reservationsPR) {
        $this->reservationsPR->removeElement($reservationsPR);
    }

    /**
     * Get reservationsPR
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservationsPR() {
        return $this->reservationsPR;
    }

    /**
     * Add reservationsBE
     *
     * @param \Back\BienEtreBundle\Entity\Reservation $reservationsBE
     * @return Client
     */
    public function addReservationsBE(\Back\BienEtreBundle\Entity\Reservation $reservationsBE) {
        $this->reservationsBE[] = $reservationsBE;

        return $this;
    }

    /**
     * Remove reservationsBE
     *
     * @param \Back\BienEtreBundle\Entity\Reservation $reservationsBE
     */
    public function removeReservationsBE(\Back\BienEtreBundle\Entity\Reservation $reservationsBE) {
        $this->reservationsBE->removeElement($reservationsBE);
    }

    /**
     * Get reservationsBE
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservationsBE() {
        return $this->reservationsBE;
    }

    /**
     * Add reservationsB
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationsB
     * @return Client
     */
    public function addReservationsB(\Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationsB) {
        $this->reservationsB[] = $reservationsB;

        return $this;
    }

    /**
     * Remove reservationsB
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationsB
     */
    public function removeReservationsB(\Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservationsB) {
        $this->reservationsB->removeElement($reservationsB);
    }

    /**
     * Get reservationsB
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservationsB() {
        return $this->reservationsB;
    }

    /**
     * Add reservationsM
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationsM
     * @return Client
     */
    public function addReservationsM(\Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationsM) {
        $this->reservationsM[] = $reservationsM;

        return $this;
    }

    /**
     * Remove reservationsM
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationsM
     */
    public function removeReservationsM(\Back\BilletterieMaritimeBundle\Entity\MaritimeReservation $reservationsM) {
        $this->reservationsM->removeElement($reservationsM);
    }

    /**
     * Get reservationsM
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservationsM() {
        return $this->reservationsM;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Client
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set nomAltervatif
     *
     * @param string $nomAltervatif
     * @return Client
     */
    public function setNomAltervatif($nomAltervatif) {
        $this->nomAltervatif = $nomAltervatif;

        return $this;
    }

    /**
     * Get nomAltervatif
     *
     * @return string 
     */
    public function getNomAltervatif() {
        return $this->nomAltervatif;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Client
     */
    public function setFax($fax) {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return Client
     */
    public function setSiteWeb($siteWeb) {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string 
     */
    public function getSiteWeb() {
        return $this->siteWeb;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     * @return Client
     */
    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer 
     */
    public function getCodePostal() {
        return $this->codePostal;
    }

    /**
     * Set codeDouane
     *
     * @param string $codeDouane
     * @return Client
     */
    public function setCodeDouane($codeDouane) {
        $this->codeDouane = $codeDouane;

        return $this;
    }

    /**
     * Get codeDouane
     *
     * @return string 
     */
    public function getCodeDouane() {
        return $this->codeDouane;
    }

    /**
     * Set tva
     *
     * @param boolean $tva
     * @return Client
     */
    public function setTva($tva) {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return boolean 
     */
    public function getTva() {
        return $this->tva;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Client
     */
    public function setVille($ville) {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set formeJuridique
     *
     * @param integer $formeJuridique
     * @return Client
     */
    public function setFormeJuridique($formeJuridique) {
        $this->formeJuridique = $formeJuridique;

        return $this;
    }

    /**
     * Get formeJuridique
     *
     * @return integer 
     */
    public function getFormeJuridique() {
        return $this->formeJuridique;
    }

    /**
     * Set nomAlternatif
     *
     * @param string $nomAlternatif
     * @return Client
     */
    public function setNomAlternatif($nomAlternatif) {
        $this->nomAlternatif = $nomAlternatif;

        return $this;
    }

    /**
     * Get nomAlternatif
     *
     * @return string 
     */
    public function getNomAlternatif() {
        return $this->nomAlternatif;
    }

    public function showTypeClient() {
        switch ($this->type) {
            case '1': return 'Société/Association';
            case '2': return 'Individu privé';
        }
    }

    public function showFormeJuridique() {
        switch ($this->formeJuridique) {
            case '1': return "Groupe de sociétés";
            case '2': return "Groupement d'intérêt économique (GEI)";
            case '3': return "Société anonyme (SA)";
            case '4': return "Société Unipersonnelle à Responsabilité Limitée (SUARL)";
            case '5': return "Société en Commandite Simple (SCS)";
            case '6': return "Société en Nom Collectif (SNC)";
            case '7': return "Société à Responsabilité Limitée (SARL)";
            case '8': return "Société en participation";
        }
    }

    public function showTva() {
        if ($this->tva == 1) {
            return 'Oui';
        }
        return 'Non';
    }

    /**
     * Add contacts
     *
     * @param \Back\UserBundle\Entity\Client $contacts
     * @return Client
     */
    public function addContact(\Back\UserBundle\Entity\Client $contacts) {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Back\UserBundle\Entity\Client $contacts
     */
    public function removeContact(\Back\UserBundle\Entity\Client $contacts) {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts() {
        return $this->contacts;
    }

    /**
     * Set gouvernorat
     *
     * @param string $gouvernorat
     * @return Client
     */
    public function setGouvernorat($gouvernorat) {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return string 
     */
    public function getGouvernorat() {
        return $this->gouvernorat;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Client
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set tel1
     *
     * @param string $tel1
     * @return Client
     */
    public function setTel1($tel1) {
        $this->tel1 = $tel1;

        return $this;
    }

    /**
     * Get tel1
     *
     * @return string 
     */
    public function getTel1() {
        return $this->tel1;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     * @return Client
     */
    public function setTel2($tel2) {
        $this->tel2 = $tel2;

        return $this;
    }

    /**
     * Get tel2
     *
     * @return string 
     */
    public function getTel2() {
        return $this->tel2;
    }


    /**
     * Set pays
     *
     * @param \Back\HotelTunisieBundle\Entity\Pays $pays
     * @return Client
     */
    public function setPays(\Back\HotelTunisieBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \Back\HotelTunisieBundle\Entity\Pays 
     */
    public function getPays()
    {
        return $this->pays;
    }
}
