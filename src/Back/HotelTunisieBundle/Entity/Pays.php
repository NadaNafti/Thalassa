<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table("ost_sht_pays")
 * @ORM\Entity
 */
class Pays
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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=5)
     */
    private $code;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Ville", mappedBy="pays")
     * @ORM\OrderBy({"libelle" = "ASC"})
     */
    protected $villes;
    

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
     * @return Pays
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
     * Set slug
     *
     * @param string $slug
     * @return Pays
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Pays
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->villes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add villes
     *
     * @param \Back\HotelTunisieBundle\Entity\Ville $villes
     * @return Pays
     */
    public function addVille(\Back\HotelTunisieBundle\Entity\Ville $villes)
    {
        $this->villes[] = $villes;

        return $this;
    }

    /**
     * Remove villes
     *
     * @param \Back\HotelTunisieBundle\Entity\Ville $villes
     */
    public function removeVille(\Back\HotelTunisieBundle\Entity\Ville $villes)
    {
        $this->villes->removeElement($villes);
    }

    /**
     * Get villes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVilles()
    {
        return $this->villes;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }
}
