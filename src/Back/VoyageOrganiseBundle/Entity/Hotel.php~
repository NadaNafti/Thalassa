<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="ost_vo_hotel")
 * @ORM\Entity
 */
class Hotel
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
     * @ORM\ManyToOne(targetEntity="Back\HotelTunisieBundle\Entity\Categorie", fetch="EAGER")
     * @ORM\OrderBy({"libelle" = "ASC"})
     */
    protected $categorie;


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
     * @return Hotel
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
     * Set categorie
     *
     * @param \Back\HotelTunisieBundle\Entity\Categorie $categorie
     * @return Hotel
     */
    public function setCategorie(\Back\HotelTunisieBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Back\HotelTunisieBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }
}
