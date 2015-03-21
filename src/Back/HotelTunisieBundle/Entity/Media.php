<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Table("ost_media")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Media
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
     * @var \DateTime
     * 
     * @ORM\COlumn(name="updated_at",type="datetime", nullable=true) 
     */
    private $updateAt;

    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }

    /**
     * @ORM\Column(type="integer", options={"default":1}, nullable=true) 
     */
    public $type = 1;

    /**
     * @ORM\Column(type="string",length=255, nullable=true) 
     */
    public $path;
    public $file;

    public function __construct()
    {
        $this->type = 1;
    }

    public function getUploadRootDir()
    {
        return __dir__ . '/../../../../web/uploads/media';
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getAssetPath()
    {
        return 'uploads/media/' . $this->path;
    }

    /**
     * @ORM\Prepersist()
     * @ORM\Preupdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();

        if ( null !== $this->file )
            $this->path = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if ( null !== $this->file )
        {
            $this->file->move($this->getUploadRootDir(), $this->path);
            unset($this->file);
            if ( $this->oldFile != null && file_exists($this->tempFile) )
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
        if ( file_exists($this->tempFile) )
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

    public function getPath()
    {
        return $this->path;
    }

    public function getType()
    {
        return $this->type;
    }

}
