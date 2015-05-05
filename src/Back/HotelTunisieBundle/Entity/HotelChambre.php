<?php

namespace Back\HotelTunisieBundle\Entity ;

use Doctrine\ORM\Mapping as ORM ;
use Gedmo\Mapping\Annotation as Gedmo ;

/**
 * HotelChambre
 *
 * @ORM\Table(name="ost_sht_hotelsChambre")
 * @ORM\Entity
 */
class HotelChambre
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id ;

    /**
     * @ORM\ManyToOne(targetEntity="Chambre",fetch="EAGER")
     * @ORM\JoinColumn(name="chambre_id", referencedColumnName="id")
     */
    protected $chambre ;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="hotelChambres")
     */
    protected $hotel ;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description ;

    /**
     * @ORM\OneToOne(targetEntity="Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image ;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id ;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return HotelChambre
     */
    public function setDescription($description)
    {
        $this->description = $description ;

        return $this ;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description ;
    }

    /**
     * Set chambre
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambre
     * @return HotelChambre
     */
    public function setChambre(\Back\HotelTunisieBundle\Entity\Chambre $chambre = null)
    {
        $this->chambre = $chambre ;

        return $this ;
    }

    /**
     * Get chambre
     *
     * @return \Back\HotelTunisieBundle\Entity\Chambre 
     */
    public function getChambre()
    {
        return $this->chambre ;
    }

    /**
     * Set hotel
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotel
     * @return HotelChambre
     */
    public function setHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel ;

        return $this ;
    }

    /**
     * Get hotel
     *
     * @return \Back\HotelTunisieBundle\Entity\Hotel 
     */
    public function getHotel()
    {
        return $this->hotel ;
    }

    /**
     * Set image
     *
     * @param \Back\HotelTunisieBundle\Entity\Media $image
     * @return HotelChambre
     */
    public function setImage(\Back\HotelTunisieBundle\Entity\Media $image = null)
    {
        $this->image = $image ;

        return $this ;
    }

    /**
     * Get image
     *
     * @return \Back\HotelTunisieBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image ;
    }

}
