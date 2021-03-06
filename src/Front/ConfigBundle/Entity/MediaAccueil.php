<?php

namespace Front\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\validator\Constraints as Assert;

/**
 * MediaAccueil
 *
 * @ORM\Table("ost_front_media_accueil")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class MediaAccueil
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
     * @ORM\Column(name="updated_at",type="datetime", nullable=true)
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
     * @ORM\Column(type="string",length=255, nullable=true) 
     */
    public $path;
    public $file;

    public function getUploadRootDir()
    {
	return __dir__ . '/../../../../web/' . $this->getDirectory();
    }

    public function getDirectory()
    {
	    return 'uploads/Accueil';
    }

    public function getAssetPath()
    {
	return $this->getDirectory() . '/' . $this->path;
    }

    public function getAbsolutePath()
    {
	return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
	$this->tempFile = $this->getAbsolutePath();
	$this->oldFile = $this->getPath();
	$this->updateAt = new \DateTime();

	if (null !== $this->file)
	    $this->path = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
	if (null !== $this->file)
	{
	    $this->file->move($this->getUploadRootDir(), $this->path);
	    unset($this->file);
	    if ($this->oldFile != null && file_exists($this->tempFile))
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

    public function getPath()
    {
	return $this->path;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Media
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
     * @return Media
     */
    public function setPath($path)
    {
	$this->path = $path;

	return $this;
    }

    public function __toString()
    {
	return $this->getAssetPath();
    }
}
