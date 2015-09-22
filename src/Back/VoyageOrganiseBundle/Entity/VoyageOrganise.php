<?php
    namespace Back\VoyageOrganiseBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\Mapping\Annotation as Gedmo;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * ost_vo_voyages
     *
     * @ORM\Table(name="ost_vo_voyages")
     * @ORM\Entity(repositoryClass="Back\VoyageOrganiseBundle\Entity\Repository\VoyageOrganiseRepository")
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
         * @ORM\ManyToMany(targetEntity="Theme")
         * @ORM\JoinTable(name="ost_vo_voyages_themes")
         */
        private $themes;

        /**
         * @var string
         *
         * @ORM\Column(name="prix", type="decimal", precision=11 ,scale=3 ,nullable=true)
         */
        private $prix;

        /**
         * @var string
         *
         * @ORM\Column(name="description_courte", type="text")
         */
        private $descriptionCourte;

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
         * @ORM\OneToMany(targetEntity="Periode", mappedBy="voyage")
         */
        private $periodes;

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
         * Constructor
         */
        public function __construct()
        {
            $this->nbrInscriptions = 0;
            $this->periodes = new \Doctrine\Common\Collections\ArrayCollection();
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
        public function setDestination(\Back\VoyageOrganiseBundle\Entity\Destination $destination = NULL)
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

        public function getPhotoPrincipal()
        {
            if(count($this->photos) == 0)
                return NULL;
            foreach($this->photos as $image){
                if($image->getType() == 1)
                    return $image;
            }
            return NULL;
        }

        public function getPhotosAlbum()
        {
            $album = array();
            foreach($this->photos as $image){
                if($image->getType() == 2)
                    $album[] = $image;
            }
            return $album;
        }

        /**
         * Add themes
         *
         * @param \Back\VoyageOrganiseBundle\Entity\Theme $themes
         * @return VoyageOrganise
         */
        public function addTheme(\Back\VoyageOrganiseBundle\Entity\Theme $themes)
        {
            $this->themes[] = $themes;
            return $this;
        }

        /**
         * Remove themes
         *
         * @param \Back\VoyageOrganiseBundle\Entity\Theme $themes
         */
        public function removeTheme(\Back\VoyageOrganiseBundle\Entity\Theme $themes)
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
         * Add periodes
         *
         * @param \Back\VoyageOrganiseBundle\Entity\Periode $periodes
         * @return VoyageOrganise
         */
        public function addPeriode(\Back\VoyageOrganiseBundle\Entity\Periode $periodes)
        {
            $this->periodes[] = $periodes;
            return $this;
        }

        /**
         * Remove periodes
         *
         * @param \Back\VoyageOrganiseBundle\Entity\Periode $periodes
         */
        public function removePeriode(\Back\VoyageOrganiseBundle\Entity\Periode $periodes)
        {
            $this->periodes->removeElement($periodes);
        }

        /**
         * Get periodes
         *
         * @return \Doctrine\Common\Collections\Collection
         */
        public function getPeriodes($valide = FALSE)
        {
            if($valide){
                $array = array();
                foreach($this->periodes as $periode){
                    if($periode->isValide())
                        $array[] = $periode;
                }
                return $array;
            }
            return $this->periodes;
        }

        public function isValide()
        {
            if(count($this->getPeriodes(TRUE)) != 0)
                return TRUE;
            return FALSE;
        }
    }
