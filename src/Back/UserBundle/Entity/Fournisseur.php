<?php

namespace Back\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Fournisseur
 *
 * @ORM\Table(name="ost_com_fournisseur")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Fournisseur
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
     * @ORM\Column(name="nomPrenom", type="string", length=255)
     */
    private $nomPrenom;
    
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
     * @ORM\Column(name="adresse", type="string", nullable=true)
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
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="fournisseur")
     * 
     */
    private $contacts;

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
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;
    
    public $file;
    public function getUploadRootDir() {
        return __dir__ . '/../../../../web/' . $this->getDirectory();
    }

    public function getDirectory() {
        return 'uploads/crm/fournisseurs';
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return Fournisseur
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
     * Constructor
     */
    public function __construct()
    {
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contacts
     *
     * @param \Back\UserBundle\Entity\Fournisseur $contacts
     * @return Fournisseur
     */
    public function addContact(\Back\UserBundle\Entity\Fournisseur $contacts)
    {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Back\UserBundle\Entity\Fournisseur $contacts
     */
    public function removeContact(\Back\UserBundle\Entity\Fournisseur $contacts)
    {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }
    
    public function __toString()
    {
        return $this->nomPrenom;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Fournisseur
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nomAlternatif
     *
     * @param string $nomAlternatif
     * @return Fournisseur
     */
    public function setNomAlternatif($nomAlternatif)
    {
        $this->nomAlternatif = $nomAlternatif;

        return $this;
    }

    /**
     * Get nomAlternatif
     *
     * @return string 
     */
    public function getNomAlternatif()
    {
        return $this->nomAlternatif;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Fournisseur
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Fournisseur
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
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return Fournisseur
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string 
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Fournisseur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     * @return Fournisseur
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Fournisseur
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
     * Set gouvernorat
     *
     * @param string $gouvernorat
     * @return Fournisseur
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return string 
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set matriculeFiscale
     *
     * @param string $matriculeFiscale
     * @return Fournisseur
     */
    public function setMatriculeFiscale($matriculeFiscale)
    {
        $this->matriculeFiscale = $matriculeFiscale;

        return $this;
    }

    /**
     * Get matriculeFiscale
     *
     * @return string 
     */
    public function getMatriculeFiscale()
    {
        return $this->matriculeFiscale;
    }

    /**
     * Set registreCommercie
     *
     * @param string $registreCommercie
     * @return Fournisseur
     */
    public function setRegistreCommercie($registreCommercie)
    {
        $this->registreCommercie = $registreCommercie;

        return $this;
    }

    /**
     * Get registreCommercie
     *
     * @return string 
     */
    public function getRegistreCommercie()
    {
        return $this->registreCommercie;
    }

    /**
     * Set codeDouane
     *
     * @param string $codeDouane
     * @return Fournisseur
     */
    public function setCodeDouane($codeDouane)
    {
        $this->codeDouane = $codeDouane;

        return $this;
    }

    /**
     * Get codeDouane
     *
     * @return string 
     */
    public function getCodeDouane()
    {
        return $this->codeDouane;
    }

    /**
     * Set tva
     *
     * @param boolean $tva
     * @return Fournisseur
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return boolean 
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set formeJuridique
     *
     * @param integer $formeJuridique
     * @return Fournisseur
     */
    public function setFormeJuridique($formeJuridique)
    {
        $this->formeJuridique = $formeJuridique;

        return $this;
    }

    /**
     * Get formeJuridique
     *
     * @return integer 
     */
    public function getFormeJuridique()
    {
        return $this->formeJuridique;
    }
    
    public function showTypeFournisseur() {
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
            return 'oui';
        }
        return 'non';
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Fournisseur
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set tel1
     *
     * @param string $tel1
     * @return Fournisseur
     */
    public function setTel1($tel1)
    {
        $this->tel1 = $tel1;

        return $this;
    }

    /**
     * Get tel1
     *
     * @return string 
     */
    public function getTel1()
    {
        return $this->tel1;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     * @return Fournisseur
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2;

        return $this;
    }

    /**
     * Get tel2
     *
     * @return string 
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Fournisseur
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
     * @return Fournisseur
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
     * Set pays
     *
     * @param \Back\HotelTunisieBundle\Entity\Pays $pays
     * @return Fournisseur
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
