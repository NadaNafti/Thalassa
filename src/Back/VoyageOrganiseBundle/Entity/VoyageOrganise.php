<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ost_vo_voyages
 *
 * @ORM\Table(name="ost_vo_voyages")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity()
 */
class VoyageOrganise
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_jour", type="integer")
     */
    private $nbrJour;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_nuit", type="integer")
     */
    private $nbrNuit;

    /**
     * @ORM\ManyToMany(targetEntity="Back\HotelTunisieBundle\Entity\Pays")
     * @ORM\JoinTable(name="ost_vo_voyages_pays")
     */
    private $pays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="date")
     */
    private $depart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRetour", type="date")
     */
    private $retour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut_inscription", type="date")
     */
    private $debutInscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_inscription", type="date")
     */
    private $finInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=11 ,scale=3 ,nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_inscriptions", type="integer",nullable=true)
     */
    private $nbrInscriptions;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_inscriptions_min", type="integer")
     */
    private $nbrInscriptionsMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_inscriptions_max", type="integer")
     */
    private $nbrInscriptionsMax;

    /**
     * @var string
     *
     * @ORM\Column(name="description_courte", type="text")
     */
    private $descriptionCourte;

    /**
     * @var string
     *
     * @ORM\Column(name="description_longue", type="text")
     */
    private $descriptionLongue;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="voyage", cascade={"remove"})
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="Back\VoyageOrganiseBundle\Entity\Description", mappedBy="voyage", cascade={"remove"})
     * @ORM\OrderBy({"ordre" = "ASC"})
     */
    private $descriptions;

    /**
     * @ORM\ManyToOne(targetEntity="Destination")
     * @ORM\JoinColumn(name="destination_id", referencedColumnName="id")
     */
    private $destination;

    /**
     * @Gedmo\Slug(fields={"libelle"})
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
     * Constructor
     */
    public function __construct()
    {
	$this->nbrInscriptions=0;
        $this->pays = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->descriptions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set libelle
     *
     * @param string $libelle
     * @return VoyageOrganise
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set nbrJour
     *
     * @param integer $nbrJour
     * @return VoyageOrganise
     */
    public function setNbrJour($nbrJour)
    {
        $this->nbrJour = $nbrJour;

        return $this;
    }

    /**
     * Get nbrJour
     *
     * @return integer 
     */
    public function getNbrJour()
    {
        return $this->nbrJour;
    }

    /**
     * Set nbrNuit
     *
     * @param integer $nbrNuit
     * @return VoyageOrganise
     */
    public function setNbrNuit($nbrNuit)
    {
        $this->nbrNuit = $nbrNuit;

        return $this;
    }

    /**
     * Get nbrNuit
     *
     * @return integer 
     */
    public function getNbrNuit()
    {
        return $this->nbrNuit;
    }

    /**
     * Set depart
     *
     * @param \DateTime $depart
     * @return VoyageOrganise
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return \DateTime 
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set retour
     *
     * @param \DateTime $retour
     * @return VoyageOrganise
     */
    public function setRetour($retour)
    {
        $this->retour = $retour;

        return $this;
    }

    /**
     * Get retour
     *
     * @return \DateTime 
     */
    public function getRetour()
    {
        return $this->retour;
    }

    /**
     * Set debutInscription
     *
     * @param \DateTime $debutInscription
     * @return VoyageOrganise
     */
    public function setDebutInscription($debutInscription)
    {
        $this->debutInscription = $debutInscription;

        return $this;
    }

    /**
     * Get debutInscription
     *
     * @return \DateTime 
     */
    public function getDebutInscription()
    {
        return $this->debutInscription;
    }

    /**
     * Set finInscription
     *
     * @param \DateTime $finInscription
     * @return VoyageOrganise
     */
    public function setFinInscription($finInscription)
    {
        $this->finInscription = $finInscription;

        return $this;
    }

    /**
     * Get finInscription
     *
     * @return \DateTime 
     */
    public function getFinInscription()
    {
        return $this->finInscription;
    }

    /**
     * Set prix
     *
     * @param string $prix
     * @return VoyageOrganise
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set nbrInscriptions
     *
     * @param integer $nbrInscriptions
     * @return VoyageOrganise
     */
    public function setNbrInscriptions($nbrInscriptions)
    {
        $this->nbrInscriptions = $nbrInscriptions;

        return $this;
    }

    /**
     * Get nbrInscriptions
     *
     * @return integer 
     */
    public function getNbrInscriptions()
    {
        return $this->nbrInscriptions;
    }

    /**
     * Set nbrInscriptionsMin
     *
     * @param integer $nbrInscriptionsMin
     * @return VoyageOrganise
     */
    public function setNbrInscriptionsMin($nbrInscriptionsMin)
    {
        $this->nbrInscriptionsMin = $nbrInscriptionsMin;

        return $this;
    }

    /**
     * Get nbrInscriptionsMin
     *
     * @return integer 
     */
    public function getNbrInscriptionsMin()
    {
        return $this->nbrInscriptionsMin;
    }

    /**
     * Set nbrInscriptionsMax
     *
     * @param integer $nbrInscriptionsMax
     * @return VoyageOrganise
     */
    public function setNbrInscriptionsMax($nbrInscriptionsMax)
    {
        $this->nbrInscriptionsMax = $nbrInscriptionsMax;

        return $this;
    }

    /**
     * Get nbrInscriptionsMax
     *
     * @return integer 
     */
    public function getNbrInscriptionsMax()
    {
        return $this->nbrInscriptionsMax;
    }

    /**
     * Set descriptionCourte
     *
     * @param string $descriptionCourte
     * @return VoyageOrganise
     */
    public function setDescriptionCourte($descriptionCourte)
    {
        $this->descriptionCourte = $descriptionCourte;

        return $this;
    }

    /**
     * Get descriptionCourte
     *
     * @return string 
     */
    public function getDescriptionCourte()
    {
        return $this->descriptionCourte;
    }

    /**
     * Set descriptionLongue
     *
     * @param string $descriptionLongue
     * @return VoyageOrganise
     */
    public function setDescriptionLongue($descriptionLongue)
    {
        $this->descriptionLongue = $descriptionLongue;

        return $this;
    }

    /**
     * Get descriptionLongue
     *
     * @return string 
     */
    public function getDescriptionLongue()
    {
        return $this->descriptionLongue;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return VoyageOrganise
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
     * @return VoyageOrganise
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
     * @return VoyageOrganise
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

    /**
     * Add pays
     *
     * @param \Back\HotelTunisieBundle\Entity\Pays $pays
     * @return VoyageOrganise
     */
    public function addPay(\Back\HotelTunisieBundle\Entity\Pays $pays)
    {
        $this->pays[] = $pays;

        return $this;
    }

    /**
     * Remove pays
     *
     * @param \Back\HotelTunisieBundle\Entity\Pays $pays
     */
    public function removePay(\Back\HotelTunisieBundle\Entity\Pays $pays)
    {
        $this->pays->removeElement($pays);
    }

    /**
     * Get pays
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Add photos
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Photo $photos
     * @return VoyageOrganise
     */
    public function addPhoto(\Back\VoyageOrganiseBundle\Entity\Photo $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Photo $photos
     */
    public function removePhoto(\Back\VoyageOrganiseBundle\Entity\Photo $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add descriptions
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Description $descriptions
     * @return VoyageOrganise
     */
    public function addDescription(\Back\VoyageOrganiseBundle\Entity\Description $descriptions)
    {
        $this->descriptions[] = $descriptions;

        return $this;
    }

    /**
     * Remove descriptions
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Description $descriptions
     */
    public function removeDescription(\Back\VoyageOrganiseBundle\Entity\Description $descriptions)
    {
        $this->descriptions->removeElement($descriptions);
    }

    /**
     * Get descriptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * Set destination
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Destination $destination
     * @return VoyageOrganise
     */
    public function setDestination(\Back\VoyageOrganiseBundle\Entity\Destination $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Destination 
     */
    public function getDestination()
    {
        return $this->destination;
    }
    
    public function __toString()
    {
	return $this->libelle;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return VoyageOrganise
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
}
