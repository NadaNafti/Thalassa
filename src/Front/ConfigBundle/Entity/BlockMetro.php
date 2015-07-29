<?php

namespace Front\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BlockMetro
 *
 * @ORM\Table(name="ost_front_blockmetro")
 * @ORM\Entity
 */
class BlockMetro
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
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme1;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo1;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme2;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo2;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme3;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo3;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme4;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo4;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme5;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo5;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme6;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo6;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme7;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo7;

    /**
     * @ORM\ManyToOne(targetEntity="Back\VoyageOrganiseBundle\Entity\Theme")
     */
    protected $theme8;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo8;

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
     * @return BlockMetro
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
     * Set theme1
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme1
     * @return BlockMetro
     */
    public function setTheme1(\Back\VoyageOrganiseBundle\Entity\Theme $theme1 = null)
    {
        $this->theme1 = $theme1;

        return $this;
    }

    /**
     * Get theme1
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme1()
    {
        return $this->theme1;
    }

    /**
     * Set photo1
     *
     * @param \Front\ConfigBundle\Entity\Media $photo1
     * @return BlockMetro
     */
    public function setPhoto1(\Front\ConfigBundle\Entity\Media $photo1 = null)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set theme2
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme2
     * @return BlockMetro
     */
    public function setTheme2(\Back\VoyageOrganiseBundle\Entity\Theme $theme2 = null)
    {
        $this->theme2 = $theme2;

        return $this;
    }

    /**
     * Get theme2
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme2()
    {
        return $this->theme2;
    }

    /**
     * Set photo2
     *
     * @param \Front\ConfigBundle\Entity\Media $photo2
     * @return BlockMetro
     */
    public function setPhoto2(\Front\ConfigBundle\Entity\Media $photo2 = null)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set theme3
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme3
     * @return BlockMetro
     */
    public function setTheme3(\Back\VoyageOrganiseBundle\Entity\Theme $theme3 = null)
    {
        $this->theme3 = $theme3;

        return $this;
    }

    /**
     * Get theme3
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme3()
    {
        return $this->theme3;
    }

    /**
     * Set photo3
     *
     * @param \Front\ConfigBundle\Entity\Media $photo3
     * @return BlockMetro
     */
    public function setPhoto3(\Front\ConfigBundle\Entity\Media $photo3 = null)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

    /**
     * Set theme4
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme4
     * @return BlockMetro
     */
    public function setTheme4(\Back\VoyageOrganiseBundle\Entity\Theme $theme4 = null)
    {
        $this->theme4 = $theme4;

        return $this;
    }

    /**
     * Get theme4
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme4()
    {
        return $this->theme4;
    }

    /**
     * Set photo4
     *
     * @param \Front\ConfigBundle\Entity\Media $photo4
     * @return BlockMetro
     */
    public function setPhoto4(\Front\ConfigBundle\Entity\Media $photo4 = null)
    {
        $this->photo4 = $photo4;

        return $this;
    }

    /**
     * Get photo4
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto4()
    {
        return $this->photo4;
    }

    /**
     * Set theme5
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme5
     * @return BlockMetro
     */
    public function setTheme5(\Back\VoyageOrganiseBundle\Entity\Theme $theme5 = null)
    {
        $this->theme5 = $theme5;

        return $this;
    }

    /**
     * Get theme5
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme5()
    {
        return $this->theme5;
    }

    /**
     * Set photo5
     *
     * @param \Front\ConfigBundle\Entity\Media $photo5
     * @return BlockMetro
     */
    public function setPhoto5(\Front\ConfigBundle\Entity\Media $photo5 = null)
    {
        $this->photo5 = $photo5;

        return $this;
    }

    /**
     * Get photo5
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto5()
    {
        return $this->photo5;
    }

    /**
     * Set theme6
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme6
     * @return BlockMetro
     */
    public function setTheme6(\Back\VoyageOrganiseBundle\Entity\Theme $theme6 = null)
    {
        $this->theme6 = $theme6;

        return $this;
    }

    /**
     * Get theme6
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme6()
    {
        return $this->theme6;
    }

    /**
     * Set photo6
     *
     * @param \Front\ConfigBundle\Entity\Media $photo6
     * @return BlockMetro
     */
    public function setPhoto6(\Front\ConfigBundle\Entity\Media $photo6 = null)
    {
        $this->photo6 = $photo6;

        return $this;
    }

    /**
     * Get photo6
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto6()
    {
        return $this->photo6;
    }

    /**
     * Set theme7
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme7
     * @return BlockMetro
     */
    public function setTheme7(\Back\VoyageOrganiseBundle\Entity\Theme $theme7 = null)
    {
        $this->theme7 = $theme7;

        return $this;
    }

    /**
     * Get theme7
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme7()
    {
        return $this->theme7;
    }

    /**
     * Set photo7
     *
     * @param \Front\ConfigBundle\Entity\Media $photo7
     * @return BlockMetro
     */
    public function setPhoto7(\Front\ConfigBundle\Entity\Media $photo7 = null)
    {
        $this->photo7 = $photo7;

        return $this;
    }

    /**
     * Get photo7
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto7()
    {
        return $this->photo7;
    }

    /**
     * Set theme8
     *
     * @param \Back\VoyageOrganiseBundle\Entity\Theme $theme8
     * @return BlockMetro
     */
    public function setTheme8(\Back\VoyageOrganiseBundle\Entity\Theme $theme8 = null)
    {
        $this->theme8 = $theme8;

        return $this;
    }

    /**
     * Get theme8
     *
     * @return \Back\VoyageOrganiseBundle\Entity\Theme 
     */
    public function getTheme8()
    {
        return $this->theme8;
    }

    /**
     * Set photo8
     *
     * @param \Front\ConfigBundle\Entity\Media $photo8
     * @return BlockMetro
     */
    public function setPhoto8(\Front\ConfigBundle\Entity\Media $photo8 = null)
    {
        $this->photo8 = $photo8;

        return $this;
    }

    /**
     * Get photo8
     *
     * @return \Front\ConfigBundle\Entity\Media 
     */
    public function getPhoto8()
    {
        return $this->photo8;
    }
    
}
