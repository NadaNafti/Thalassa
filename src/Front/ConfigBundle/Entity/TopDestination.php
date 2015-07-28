<?php

namespace Front\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TopDestination
 *
 * @ORM\Table(name="ost_front_topdestination")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class TopDestination
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
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Destination")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $destination;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

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
	return __dir__ . '/../../../../web/uploads/VoyageOrganise/TopDestination';
    }

    public function getAbsolutePath()
    {
	return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getAssetPath()
    {
	return 'uploads/VoyageOrganise/TopDestination/' . $this->path;
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

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return TopDestination
     */
    public function setOrdre($ordre)
    {
	$this->ordre = $ordre;

	return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
	return $this->ordre;
    }

    /**
     * Set destination
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Destination $destination
     * @return TopDestination
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

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return TopDestination
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
     * @return TopDestination
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

}
