<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description
 *
 * @ORM\Table(name="ost_vo_descriptions")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Description
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
     * @ORM\ManyToOne(targetEntity="VoyageOrganise", inversedBy="descriptions")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $voyage;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean",nullable=true)
     */
    private $visible;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lateral", type="boolean",nullable=true)
     */
    private $lateral;

    /**
     * @var \DateTime
     *
     * @ORM\COlumn(name="updated_at",type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="photoVisible", type="boolean",nullable=true)
     */
    private $photoVisible;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    public $path;

    public $file;
    
    public function __construct()
    {
        $this->lateral=FALSE;
    }

    public function getUploadRootDir()
    {
        return __dir__ . '/../../../../web/' . $this->getDirectory();
    }

    public function getDirectory()
    {
            return 'uploads/VoyageOrganise/Description';
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

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Description
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
     * Set texte
     *
     * @param string $texte
     * @return Description
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Description
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
     * @return Description
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
     * Set voyage
     *
     * @param \Back\VoyageOrganiseBundle\Entity\VoyageOrganise $voyage
     * @return Description
     */
    public function setVoyage(\Back\VoyageOrganiseBundle\Entity\VoyageOrganise $voyage)
    {
        $this->voyage = $voyage;

        return $this;
    }

    /**
     * Get voyage
     *
     * @return \Back\VoyageOrganiseBundle\Entity\VoyageOrganise 
     */
    public function getVoyage()
    {
        return $this->voyage;
    }
    
    public function showVisible()
    {
	if($this->visible)
	    return 'Oui';
	else
	    return 'Non';
    }

    /**
     * Set lateral
     *
     * @param boolean $lateral
     * @return Description
     */
    public function setLateral($lateral)
    {
        $this->lateral = $lateral;

        return $this;
    }

    /**
     * Get lateral
     *
     * @return boolean 
     */
    public function getLateral()
    {
        return $this->lateral;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Description
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
     * Set photoVisible
     *
     * @param boolean $photoVisible
     * @return Description
     */
    public function setPhotoVisible($photoVisible)
    {
        $this->photoVisible = $photoVisible;

        return $this;
    }

    /**
     * Get photoVisible
     *
     * @return boolean 
     */
    public function getPhotoVisible()
    {
        return $this->photoVisible;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Description
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
