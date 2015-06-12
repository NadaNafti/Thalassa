<?php

namespace Back\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Table(name="ost_client")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity
 */
class Client
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
     * @Assert\NotBlank()
     * @ORM\Column(name="nomPrenom", type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=255)
     */
    private $tel1;

    /**
     * @var string
     *
     * @ORM\Column(name="tel2", type="string", length=255,nullable=true)
     */
    private $tel2;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

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
     * @Gedmo\Slug(fields={"nomPrenom"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

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
     * @ORM\Column( name="deletedAt",type="datetime",nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="Back\HotelTunisieBundle\Entity\Reservation", mappedBy="client")
     */
    protected $reservations;

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
     * @return Client
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
     * Set tel1
     *
     * @param string $tel1
     * @return Client
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
     * @return Client
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
     * Set adresse
     *
     * @param string $adresse
     * @return Client
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
     * Set matriculeFiscale
     *
     * @param string $matriculeFiscale
     * @return Client
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
     * @return Client
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
     * Set commentaire
     *
     * @param string $commentaire
     * @return Client
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
     * Set amicale
     *
     * @param \Back\AdministrationBundle\Entity\Amicale $amicale
     * @return Client
     */
    public function setAmicale(\Back\AdministrationBundle\Entity\Amicale $amicale = null)
    {
        $this->amicale = $amicale;

        return $this;
    }

    /**
     * Get amicale
     *
     * @return \Back\AdministrationBundle\Entity\Amicale 
     */
    public function getAmicale()
    {
        return $this->amicale;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Client
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Client
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
     * @return Client
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
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Client
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function showProfileAmicale()
    {
        if ($this->responsable)
            return "Responsable";
        else
            return 'Employé';
    }

    public function __toString()
    {
        $amicale = "";
        if (!is_null($this->amicale))
            $amicale = " - " . $this->amicale;
        return $this->nomPrenom . $amicale;
    }

    /**
     * Set responsable
     *
     * @param boolean $responsable
     * @return Client
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return boolean 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set user
     *
     * @param \Back\UserBundle\Entity\User $user
     * @return Client
     */
    public function setUser(\Back\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Back\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reservations
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservations
     * @return Client
     */
    public function addReservation(\Back\HotelTunisieBundle\Entity\Reservation $reservations)
    {
        $this->reservations[] = $reservations;

        return $this;
    }

    /**
     * Remove reservations
     *
     * @param \Back\HotelTunisieBundle\Entity\Reservation $reservations
     */
    public function removeReservation(\Back\HotelTunisieBundle\Entity\Reservation $reservations)
    {
        $this->reservations->removeElement($reservations);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
