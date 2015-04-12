<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Hotel
 *
 * @ORM\Table(name="ost_sht_hotels")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity(repositoryClass="Back\HotelTunisieBundle\Entity\HotelRepository")
 */
class Hotel
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
     * @ORM\Column(name="etat", type="boolean", nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=20)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=20)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionCourte", type="text")
     */
    private $descriptionCourte;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionLongue", type="text")
     */
    private $descriptionLongue;

    /**
     * @ORM\ManyToOne(targetEntity="Chaine", fetch="EAGER")
     * @ORM\JoinColumn(name="chaine_id", referencedColumnName="id")
     * @ORM\OrderBy({"libelle" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $chaine;

    /**
     * @ORM\ManyToOne(targetEntity="Back\CommercialBundle\Entity\Fournisseur", fetch="EAGER")
     * @ORM\JoinColumn(name="fournisseur_id", referencedColumnName="id")
     * @ORM\OrderBy({"libelle" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity="Ville", fetch="EAGER")
     * @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     * @ORM\OrderBy({"libelle" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $ville;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="hotels", fetch="EAGER")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     * @ORM\OrderBy({"libelle" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="ost_sht_hotels_tags",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_tag", referencedColumnName="id")}
     * )
     */
    protected $tags;

    /**
     * @ORM\ManyToMany(targetEntity="Chambre", inversedBy="hotels")
     * @ORM\JoinTable(name="ost_sht_hotels_chambre",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_chambre", referencedColumnName="id")}
     * )
     */
    protected $chambres;

    /**
     * @ORM\ManyToMany(targetEntity="Optionn")
     * @ORM\JoinTable(name="ost_sht_hotels_options",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_option", referencedColumnName="id")}
     * )
     */
    protected $options;

    /**
     * @ORM\ManyToMany(targetEntity="Localisation")
     * @ORM\JoinTable(name="ost_sht_hotels_localisations",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_localisation", referencedColumnName="id")}
     * )
     */
    protected $localisations;

    /**
     * @ORM\ManyToMany(targetEntity="Theme")
     * @ORM\JoinTable(name="ost_sht_hotels_themes",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_theme", referencedColumnName="id")}
     * )
     */
    protected $themes;

    /**
     * @ORM\ManyToMany(targetEntity="Arrangement", inversedBy="hotels")
     * @ORM\JoinTable(name="ost_sht_hotels_arrangements",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_arrangement", referencedColumnName="id")}
     * )
     */
    protected $arrangements;

    /**
     * @ORM\ManyToMany(targetEntity="Amenagement")
     * @ORM\JoinTable(name="ost_sht_hotels_amenagements",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_amenagement", referencedColumnName="id")}
     * )
     */
    protected $amenagements;

    /**
     * @ORM\ManyToMany(targetEntity="Vue")
     * @ORM\JoinTable(name="ost_sht_hotels_vues",
     *      joinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_vue", referencedColumnName="id")}
     * )
     */
    protected $vues;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="hotel")
     * @ORM\OrderBy({"ordre" = "ASC"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="StopSales", mappedBy="hotel")
     */
    protected $stopSales;

    /**
     * @ORM\OneToOne(targetEntity="FicheTechnique", cascade={"persist"})
     */
    private $ficheTechnique;

    /**
     * @ORM\OneToOne(targetEntity="Saison", cascade={"persist"})
     */
    private $saisonBase;

    /**
     * @Gedmo\slug(fields={"libelle"})
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
     * @return Hotel
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
     * Set longitude
     *
     * @param string $longitude
     * @return Hotel
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Hotel
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Hotel
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
     * Set descriptionCourte
     *
     * @param string $descriptionCourte
     * @return Hotel
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
     * @return Hotel
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
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->chambres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
        $this->localisations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->arrangements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->amenagements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Hotel
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
     * @return Hotel
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
     * @return Hotel
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
     * @return Hotel
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
     * Set chaine
     *
     * @param \Back\HotelTunisieBundle\Entity\Chaine $chaine
     * @return Hotel
     */
    public function setChaine(\Back\HotelTunisieBundle\Entity\Chaine $chaine = null)
    {
        $this->chaine = $chaine;

        return $this;
    }

    /**
     * Get chaine
     *
     * @return \Back\HotelTunisieBundle\Entity\Chaine 
     */
    public function getChaine()
    {
        return $this->chaine;
    }

    /**
     * Set fournisseur
     *
     * @param \Back\CommercialBundle\Entity\Fournisseur $fournisseur
     * @return Hotel
     */
    public function setFournisseur(\Back\CommercialBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \Back\CommercialBundle\Entity\Fournisseur 
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set ville
     *
     * @param \Back\HotelTunisieBundle\Entity\Ville $ville
     * @return Hotel
     */
    public function setVille(\Back\HotelTunisieBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Back\HotelTunisieBundle\Entity\Ville 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set categorie
     *
     * @param \Back\HotelTunisieBundle\Entity\Categorie $categorie
     * @return Hotel
     */
    public function setCategorie(\Back\HotelTunisieBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Back\HotelTunisieBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add tags
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tags
     * @return Hotel
     */
    public function addTag(\Back\HotelTunisieBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tags
     */
    public function removeTag(\Back\HotelTunisieBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\chambre $chambres
     * @return Hotel
     */
    public function addChambre(\Back\HotelTunisieBundle\Entity\chambre $chambres)
    {
        $this->chambres[] = $chambres;

        return $this;
    }

    /**
     * Remove chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\chambre $chambres
     */
    public function removeChambre(\Back\HotelTunisieBundle\Entity\chambre $chambres)
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
     * Add options
     *
     * @param \Back\HotelTunisieBundle\Entity\Optionn $options
     * @return Hotel
     */
    public function addOption(\Back\HotelTunisieBundle\Entity\Optionn $options)
    {
        $this->options[] = $options;

        return $this;
    }

    /**
     * Remove options
     *
     * @param \Back\HotelTunisieBundle\Entity\Optionn $options
     */
    public function removeOption(\Back\HotelTunisieBundle\Entity\Optionn $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add localisations
     *
     * @param \Back\HotelTunisieBundle\Entity\Localisation $localisations
     * @return Hotel
     */
    public function addLocalisation(\Back\HotelTunisieBundle\Entity\Localisation $localisations)
    {
        $this->localisations[] = $localisations;

        return $this;
    }

    /**
     * Remove localisations
     *
     * @param \Back\HotelTunisieBundle\Entity\Localisation $localisations
     */
    public function removeLocalisation(\Back\HotelTunisieBundle\Entity\Localisation $localisations)
    {
        $this->localisations->removeElement($localisations);
    }

    /**
     * Get localisations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalisations()
    {
        return $this->localisations;
    }

    /**
     * Add themes
     *
     * @param \Back\HotelTunisieBundle\Entity\Theme $themes
     * @return Hotel
     */
    public function addTheme(\Back\HotelTunisieBundle\Entity\Theme $themes)
    {
        $this->themes[] = $themes;

        return $this;
    }

    /**
     * Remove themes
     *
     * @param \Back\HotelTunisieBundle\Entity\Theme $themes
     */
    public function removeTheme(\Back\HotelTunisieBundle\Entity\Theme $themes)
    {
        $this->themes->removeElement($themes);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Add arrangements
     *
     * @param \Back\HotelTunisieBundle\Entity\Arrangement $arrangements
     * @return Hotel
     */
    public function addArrangement(\Back\HotelTunisieBundle\Entity\Arrangement $arrangements)
    {
        $this->arrangements[] = $arrangements;

        return $this;
    }

    /**
     * Remove arrangements
     *
     * @param \Back\HotelTunisieBundle\Entity\Arrangement $arrangements
     */
    public function removeArrangement(\Back\HotelTunisieBundle\Entity\Arrangement $arrangements)
    {
        $this->arrangements->removeElement($arrangements);
    }

    /**
     * Get arrangements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArrangements()
    {
        return $this->arrangements;
    }

    /**
     * Add amenagements
     *
     * @param \Back\HotelTunisieBundle\Entity\Amenagement $amenagements
     * @return Hotel
     */
    public function addAmenagement(\Back\HotelTunisieBundle\Entity\Amenagement $amenagements)
    {
        $this->amenagements[] = $amenagements;

        return $this;
    }

    /**
     * Remove amenagements
     *
     * @param \Back\HotelTunisieBundle\Entity\Amenagement $amenagements
     */
    public function removeAmenagement(\Back\HotelTunisieBundle\Entity\Amenagement $amenagements)
    {
        $this->amenagements->removeElement($amenagements);
    }

    /**
     * Get amenagements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAmenagements()
    {
        return $this->amenagements;
    }

    /**
     * Add vues
     *
     * @param \Back\HotelTunisieBundle\Entity\Vue $vues
     * @return Hotel
     */
    public function addVue(\Back\HotelTunisieBundle\Entity\Vue $vues)
    {
        $this->vues[] = $vues;

        return $this;
    }

    /**
     * Remove vues
     *
     * @param \Back\HotelTunisieBundle\Entity\Vue $vues
     */
    public function removeVue(\Back\HotelTunisieBundle\Entity\Vue $vues)
    {
        $this->vues->removeElement($vues);
    }

    /**
     * Get vues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVues()
    {
        return $this->vues;
    }

    /**
     * Add images
     *
     * @param \Back\HotelTunisieBundle\Entity\Media $images
     * @return Hotel
     */
    public function addImage(\Back\HotelTunisieBundle\Entity\Media $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Back\HotelTunisieBundle\Entity\Media $images
     */
    public function removeImage(\Back\HotelTunisieBundle\Entity\Media $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add stopSales
     *
     * @param \Back\HotelTunisieBundle\Entity\StopSales $stopSales
     * @return Hotel
     */
    public function addStopSale(\Back\HotelTunisieBundle\Entity\StopSales $stopSales)
    {
        $this->stopSales[] = $stopSales;

        return $this;
    }

    /**
     * Remove stopSales
     *
     * @param \Back\HotelTunisieBundle\Entity\StopSales $stopSales
     */
    public function removeStopSale(\Back\HotelTunisieBundle\Entity\StopSales $stopSales)
    {
        $this->stopSales->removeElement($stopSales);
    }

    /**
     * Get stopSales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStopSales()
    {
        return $this->stopSales;
    }



    /**
     * Set ficheTechnique
     *
     * @param \Back\HotelTunisieBundle\Entity\FicheTechnique $ficheTechnique
     * @return Hotel
     */
    public function setFicheTechnique(\Back\HotelTunisieBundle\Entity\FicheTechnique $ficheTechnique = null)
    {
        $this->ficheTechnique = $ficheTechnique;

        return $this;
    }

    /**
     * Get ficheTechnique
     *
     * @return \Back\HotelTunisieBundle\Entity\FicheTechnique 
     */
    public function getFicheTechnique()
    {
        return $this->ficheTechnique;
    }
    
    public function getStars()
    {
        if($this->categorie != null)
            return $this->categorie->getNombreEtoiles();
        else
            return 0;
    }

    /**
     * Set saisonBase
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saisonBase
     * @return Hotel
     */
    public function setSaisonBase(\Back\HotelTunisieBundle\Entity\Saison $saisonBase = null)
    {
        $this->saisonBase = $saisonBase;

        return $this;
    }

    /**
     * Get saisonBase
     *
     * @return \Back\HotelTunisieBundle\Entity\Saison 
     */
    public function getSaisonBase()
    {
        return $this->saisonBase;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     * @return Hotel
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }
    
    
    public function getCountAutresChambres()
    {
        $i=0;
        foreach($this->chambres as $chambre)
        {
            if($chambre->getType()==0)
                $i++;
        }
        return $i;
    }
}
