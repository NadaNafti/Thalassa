<?php
    namespace Back\ProgrammeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\Mapping\Annotation as Gedmo;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * ost_vo_voyages
     *
     * @ORM\Table(name="ost_pr_programmes")
     * @ORM\Entity(repositoryClass="Back\ProgrammeBundle\Entity\Repository\ProgrammeRepository")
     */
    class Programme
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
         * @ORM\ManyToMany(targetEntity="Theme", inversedBy="programmes")
         * @ORM\JoinTable(name="ost_pr_programme_themes")
         */
        private $themes;

        /**
         * @var string
         *
         * @ORM\Column(name="prix", type="decimal", precision=11 ,scale=3)
         */
        private $prix;

        /**
         * @var string
         *
         * @ORM\Column(name="description_courte", type="text")
         */
        private $descriptionCourte;

        /**
         * @ORM\OneToMany(targetEntity="Photo", mappedBy="programme", cascade={"remove"})
         */
        private $photos;

        /**
         * @ORM\OneToMany(targetEntity="Description", mappedBy="programme", cascade={"remove"})
         * @ORM\OrderBy({"ordre" = "ASC"})
         */
        private $descriptions;

        /**
         * @ORM\OneToMany(targetEntity="Periode", mappedBy="programme", cascade={"remove"})
         * @ORM\OrderBy({"depart" = "ASC"})
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
            $this->periodes = new \Doctrine\Common\Collections\ArrayCollection();
            $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
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
         * @return Programme
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
         * Set prix
         *
         * @param string $prix
         * @return Programme
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
         * @return Programme
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
         * Set slug
         *
         * @param string $slug
         * @return Programme
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
         * @return Programme
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
         * @return Programme
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
         * Add themes
         *
         * @param \Back\ProgrammeBundle\Entity\Theme $themes
         * @return Programme
         */
        public function addTheme(\Back\ProgrammeBundle\Entity\Theme $themes)
        {
            $this->themes[] = $themes;
            return $this;
        }

        /**
         * Remove themes
         *
         * @param \Back\ProgrammeBundle\Entity\Theme $themes
         */
        public function removeTheme(\Back\ProgrammeBundle\Entity\Theme $themes)
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
         * Add photos
         *
         * @param \Back\ProgrammeBundle\Entity\Photo $photos
         * @return Programme
         */
        public function addPhoto(\Back\ProgrammeBundle\Entity\Photo $photos)
        {
            $this->photos[] = $photos;
            return $this;
        }

        /**
         * Remove photos
         *
         * @param \Back\ProgrammeBundle\Entity\Photo $photos
         */
        public function removePhoto(\Back\ProgrammeBundle\Entity\Photo $photos)
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
         * @param \Back\ProgrammeBundle\Entity\Description $descriptions
         * @return Programme
         */
        public function addDescription(\Back\ProgrammeBundle\Entity\Description $descriptions)
        {
            $this->descriptions[] = $descriptions;
            return $this;
        }

        /**
         * Remove descriptions
         *
         * @param \Back\ProgrammeBundle\Entity\Description $descriptions
         */
        public function removeDescription(\Back\ProgrammeBundle\Entity\Description $descriptions)
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

        public function __toString()
        {
            return $this->libelle;
        }

        /**
         * Add periodes
         *
         * @param \Back\ProgrammeBundle\Entity\Periode $periodes
         * @return Programme
         */
        public function addPeriode(\Back\ProgrammeBundle\Entity\Periode $periodes)
        {
            $this->periodes[] = $periodes;
            return $this;
        }

        /**
         * Remove periodes
         *
         * @param \Back\ProgrammeBundle\Entity\Periode $periodes
         */
        public function removePeriode(\Back\ProgrammeBundle\Entity\Periode $periodes)
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

        public function isValide()
        {
            if(count($this->getPeriodes(TRUE)) != 0)
                return TRUE;
            return FALSE;
        }
    }
