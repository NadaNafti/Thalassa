<?php

namespace Back\BienEtreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\validator\Constraints as Assert;

/**
 * Photo
 *
 * @ORM\Table(name="ost_be_photos")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Photo
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
     * @ORM\ManyToOne(targetEntity="Centre", inversedBy="photos")
     * @ORM\JoinColumn(name="id_centre", referencedColumnName="id",onDelete="CASCADE")
     */
    private $centre;

    /**
     * @ORM\ManyToOne(targetEntity="Soin", inversedBy="photos")
     * @ORM\JoinColumn(name="id_soin", referencedColumnName="id",onDelete="CASCADE")
     */
    private $soin;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cure", inversedBy="photos")
     * @ORM\JoinColumn(name="id_cure", referencedColumnName="id",onDelete="CASCADE")
     */
    private $cure;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pack", inversedBy="photos")
     * @ORM\JoinColumn(name="id_pack", referencedColumnName="id",onDelete="CASCADE")
     */
    private $pack;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;
    
    public $file;

    public function getUploadRootDir()
    {
	return __dir__ . '/../../../../web/' . $this->getDirectory();
    }

    public function getDirectory()
    {
	return 'uploads/Bien-Etre';
    }

    public function getAssetPath()
    {
	return $this->getDirectory() . '/' . $this->url;
    }

    public function getAbsolutePath()
    {
	return null === $this->url ? null : $this->getUploadRootDir() . '/' . $this->url;
    }

    public function showType()
    {
	if ($this->type == 1)
	    return 'Principale';
	if ($this->type == 2)
	    return 'Album';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
	$this->tempFile = $this->getAbsolutePath();
	$this->oldFile = $this->getUrl();
	$this->updateAt = new \DateTime();

	if (null !== $this->file)
	    $this->url = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
	if (null !== $this->file)
	{
	    $this->file->move($this->getUploadRootDir(), $this->url);
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
     * Set url
     *
     * @param string $url
     * @return Photo
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

    /**
     * Set type
     *
     * @param integer $type
     * @return Photo
     */
    public function setType($type)
    {
	$this->type = $type;

	return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
	return $this->type;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Photo
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
     * Set visible
     *
     * @param boolean $visible
     * @return Photo
     */
    public function setVisible($visible)
    {
	$this->visible = $visible;

	return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
	return $this->visible;
    }

    /**
     * Set soin
     *
     * @param \Back\BienEtreBundle\Entity\Soin $soin
     * @return Photo
     */
    public function setSoin(\Back\BienEtreBundle\Entity\Soin $soin)
    {
        $this->soin = $soin;

        return $this;
    }

    /**
     * Get soin
     *
     * @return \Back\BienEtreBundle\Entity\Soin 
     */
    public function getSoin()
    {
        return $this->soin;
    }

    /**
     * Set centre
     *
     * @param \Back\BienEtreBundle\Entity\Centre $centre
     * @return Photo
     */
    public function setCentre(\Back\BienEtreBundle\Entity\Centre $centre)
    {
        $this->centre = $centre;

        return $this;
    }

    /**
     * Get centre
     *
     * @return \Back\BienEtreBundle\Entity\Centre 
     */
    public function getCentre()
    {
        return $this->centre;
    }

    /**
     * Set cure
     *
     * @param \Back\BienEtreBundle\Entity\Cure $cure
     * @return Photo
     */
    public function setCure(\Back\BienEtreBundle\Entity\Cure $cure)
    {
        $this->cure = $cure;

        return $this;
    }

    /**
     * Get cure
     *
     * @return \Back\BienEtreBundle\Entity\Cure 
     */
    public function getCure()
    {
        return $this->cure;
    }

    /**
     * Set pack
     *
     * @param \Back\BienEtreBundle\Entity\Pack $pack
     * @return Photo
     */
    public function setPack(\Back\BienEtreBundle\Entity\Pack $pack)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return \Back\BienEtreBundle\Entity\Pack 
     */
    public function getPack()
    {
        return $this->pack;
    }
}
