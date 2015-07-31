<?php

namespace Front\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BlockMetro
 *
 * @ORM\Table(name="ost_front_blockmetro_sht")
 * @ORM\Entity
 */
class BlockMetroSHT
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
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag1;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo1;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag2;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo2;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag3;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo3;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag4;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo4;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag5;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo5;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag6;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo6;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag7;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo7;

    /**
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Tag")
     */
    protected $tag8;
    
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
     * Set tag1
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag1
     * @return BlockMetro
     */
    public function setTag1(\Back\HotelTunisieBundle\Entity\Tag $tag1 = null)
    {
        $this->tag1 = $tag1;

        return $this;
    }

    /**
     * Get tag1
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag1()
    {
        return $this->tag1;
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
     * Set tag2
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag2
     * @return BlockMetro
     */
    public function setTag2(\Back\HotelTunisieBundle\Entity\Tag $tag2 = null)
    {
        $this->tag2 = $tag2;

        return $this;
    }

    /**
     * Get tag2
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag2()
    {
        return $this->tag2;
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
     * Set tag3
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag3
     * @return BlockMetro
     */
    public function setTag3(\Back\HotelTunisieBundle\Entity\Tag $tag3 = null)
    {
        $this->tag3 = $tag3;

        return $this;
    }

    /**
     * Get tag3
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag3()
    {
        return $this->tag3;
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
     * Set tag4
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag4
     * @return BlockMetro
     */
    public function setTag4(\Back\HotelTunisieBundle\Entity\Tag $tag4 = null)
    {
        $this->tag4 = $tag4;

        return $this;
    }

    /**
     * Get tag4
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag4()
    {
        return $this->tag4;
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
     * Set tag5
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag5
     * @return BlockMetro
     */
    public function setTag5(\Back\HotelTunisieBundle\Entity\Tag $tag5 = null)
    {
        $this->tag5 = $tag5;

        return $this;
    }

    /**
     * Get tag5
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag5()
    {
        return $this->tag5;
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
     * Set tag6
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag6
     * @return BlockMetro
     */
    public function setTag6(\Back\HotelTunisieBundle\Entity\Tag $tag6 = null)
    {
        $this->tag6 = $tag6;

        return $this;
    }

    /**
     * Get tag6
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag6()
    {
        return $this->tag6;
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
     * Set tag7
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag7
     * @return BlockMetro
     */
    public function setTag7(\Back\HotelTunisieBundle\Entity\Tag $tag7 = null)
    {
        $this->tag7 = $tag7;

        return $this;
    }

    /**
     * Get tag7
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag7()
    {
        return $this->tag7;
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
     * Set tag8
     *
     * @param \Back\HotelTunisieBundle\Entity\Tag $tag8
     * @return BlockMetro
     */
    public function setTag8(\Back\HotelTunisieBundle\Entity\Tag $tag8 = null)
    {
        $this->tag8 = $tag8;

        return $this;
    }

    /**
     * Get tag8
     *
     * @return \Back\HotelTunisieBundle\Entity\Tag 
     */
    public function getTag8()
    {
        return $this->tag8;
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
