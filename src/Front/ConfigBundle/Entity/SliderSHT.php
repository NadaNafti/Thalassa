<?php

namespace Front\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SliderVO
 *
 * @ORM\Table(name="ost_front_sildersht")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class SliderSHT
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
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="titre1", type="string", length=255,nullable=true)
     */
    private $titre1;

    /**
     * @var string
     *
     * @ORM\Column(name="titre2", type="string", length=255,nullable=true)
     */
    private $titre2;

    /**
     * @var string
     *
     * @ORM\Column(name="titre3", type="string", length=255,nullable=true)
     */
    private $titre3;
    
    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="url", type="string", length=255,nullable=true)
     */
    private $url;

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
	return __dir__ . '/../../../../web/uploads/HotelTunisie/Slider';
    }

    public function getAbsolutePath()
    {
	return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getAssetPath()
    {
	return 'uploads/HotelTunisie/Slider/' . $this->path;
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
     * @return SliderVO
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
     * Set titre1
     *
     * @param string $titre1
     * @return SliderVO
     */
    public function setTitre1($titre1)
    {
	$this->titre1 = $titre1;

	return $this;
    }

    /**
     * Get titre1
     *
     * @return string 
     */
    public function getTitre1()
    {
	return $this->titre1;
    }

    /**
     * Set titre2
     *
     * @param string $titre2
     * @return SliderVO
     */
    public function setTitre2($titre2)
    {
	$this->titre2 = $titre2;

	return $this;
    }

    /**
     * Get titre2
     *
     * @return string 
     */
    public function getTitre2()
    {
	return $this->titre2;
    }

    /**
     * Set titre3
     *
     * @param string $titre3
     * @return SliderVO
     */
    public function setTitre3($titre3)
    {
	$this->titre3 = $titre3;

	return $this;
    }

    /**
     * Get titre3
     *
     * @return string 
     */
    public function getTitre3()
    {
	return $this->titre3;
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


    /**
     * Set url
     *
     * @param string $url
     * @return SliderVO
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
