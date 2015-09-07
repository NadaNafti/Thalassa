<?php
    namespace Back\AdministrationBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Agence
     *
     * @ORM\Table(name="ost_agence")
     * @ORM\Entity
     * @ORM\HasLifecycleCallbacks
     */
    class Agence
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
         * @ORM\Column(name="nom", type="string", length=255)
         */
        private $nom;

        /**
         * @var string
         *
         * @ORM\Column(name="adresse", type="text")
         */
        private $adresse;

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
         * @ORM\Column(name="fax", type="string", length=255,nullable=true)
         */
        private $fax;

        /**
         * @var string
         * @Assert\Email()
         * @ORM\Column(name="contactEmail", type="string", length=255)
         */
        private $contactEmail;

        /**
         * @var string
         * @ORM\Column(name="site", type="string", length=255)
         */
        private $site;

        /**
         * @var \DateTime
         *
         * @ORM\COlumn(name="updated_at",type="datetime", nullable=true)
         */
        private $updateAt;

        /**
         * @ORM\Column(type="string",length=255, nullable=true)
         */
        public $path;

        public $file;

        public function getUploadRootDir()
        {
            return __dir__ . '/../../../../web/uploads';
        }

        public function getAbsolutePath()
        {
            return NULL === $this->path ? NULL : $this->getUploadRootDir() . '/' . $this->path;
        }

        public function getAssetPath()
        {
            return 'uploads/' . $this->path;
        }

        /**
         * @ORM\PostLoad()
         */
        public function postLoad()
        {
            $this->updateAt = new \DateTime();
        }

        /**
         * @ORM\PostPersist()
         * @ORM\PreUpdate()
         */
        public function preUpload()
        {
            $this->tempFile = $this->getAbsolutePath();
            $this->oldFile = $this->path;
            $this->updateAt = new \DateTime();
            if(NULL !== $this->file)
                $this->path = sha1(uniqid(mt_rand(),TRUE)) . '.' . $this->file->guessExtension();
        }

        /**
         * @ORM\PostPersist()
         * @ORM\PostUpdate()
         */
        public function upload()
        {
            if(NULL !== $this->file){
                $this->file->move($this->getUploadRootDir(),$this->path);
                unset($this->file);
                if($this->oldFile != NULL && file_exists($this->tempFile))
                    unlink($this->tempFile);
            }
        }

        /**
         * @ORM\PreRemove()
         */
        public function preRemoveUpload()
        {
            $this->tempFile = $this->getAbsolutePath();
        }

        /**
         * @ORM\PostRemove()
         */
        public function removeUpload()
        {
            if(file_exists($this->tempFile))
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
         * Set nom
         *
         * @param string $nom
         * @return Agence
         */
        public function setNom($nom)
        {
            $this->nom = $nom;
            return $this;
        }

        /**
         * Get nom
         *
         * @return string
         */
        public function getNom()
        {
            return $this->nom;
        }

        /**
         * Set adresse
         *
         * @param string $adresse
         * @return Agence
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
         * Set tel1
         *
         * @param string $tel1
         * @return Agence
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
         * @return Agence
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
         * Set fax
         *
         * @param string $fax
         * @return Agence
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
         * Set contactEmail
         *
         * @param string $contactEmail
         * @return Agence
         */
        public function setContactEmail($contactEmail)
        {
            $this->contactEmail = $contactEmail;
            return $this;
        }

        /**
         * Get contactEmail
         *
         * @return string
         */
        public function getContactEmail()
        {
            return $this->contactEmail;
        }

        /**
         * Set site
         *
         * @param string $site
         * @return Agence
         */
        public function setSite($site)
        {
            $this->site = $site;
            return $this;
        }

        /**
         * Get site
         *
         * @return string
         */
        public function getSite()
        {
            return $this->site;
        }

        /**
         * Set updateAt
         *
         * @param \DateTime $updateAt
         * @return Agence
         */
        public function setUpdateAt($updateAt)
        {
            $this->updateAt = $updateAt;
            return $this;
        }

        /**
         * Get updateAt
         *
         * @return \DateTime
         */
        public function getUpdateAt()
        {
            return $this->updateAt;
        }

        /**
         * Set path
         *
         * @param string $path
         * @return Agence
         */
        public function setPath($path)
        {
            $this->path = $path;
            return $this;
        }

        /**
         * Get path
         *
         * @return string
         */
        public function getPath()
        {
            return $this->path;
        }

        public function __toString()
        {
            return $this->nom;
        }
    }
