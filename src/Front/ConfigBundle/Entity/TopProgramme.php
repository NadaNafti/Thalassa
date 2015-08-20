<?php
    namespace Front\ConfigBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * TopProgramme
     *
     * @ORM\Table(name="ost_front_topprogramme")
     * @ORM\Entity
     * @ORM\HasLifecycleCallbacks
     */
    class TopProgramme
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
         * @ORM\ManyToOne(targetEntity="Back\ProgrammeBundle\Entity\Theme")
         */
        protected $theme;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="updated_at",type="datetime", nullable=true)
         */
        private $updateAt;

        /**
         * @ORM\Column(type="string",length=255, nullable=true)
         */
        public $path;

        public $file;

        public function getUploadRootDir()
        {
            return __dir__ . '/../../../../web/uploads/Programmes/TopProgrammes';
        }

        public function getAbsolutePath()
        {
            return NULL === $this->path ? NULL : $this->getUploadRootDir() . '/' . $this->path;
        }

        public function getAssetPath()
        {
            return 'uploads/Programmes/TopProgrammes/' . $this->path;
        }

        /**
         * @ORM\PostLoad()
         */
        public function postLoad()
        {
            $this->updateAt = new \DateTime();
        }

        /**
         * @ORM\PrePersist()
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
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return TopProgramme
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
     * @return TopProgramme
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

    /**
     * Set theme
     *
     * @param \Back\ProgrammeBundle\Entity\Theme $theme
     * @return TopProgramme
     */
    public function setTheme(\Back\ProgrammeBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Back\ProgrammeBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }
}
