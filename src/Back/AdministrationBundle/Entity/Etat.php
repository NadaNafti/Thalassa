<?php

namespace Back\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="ost_etat")
 * @ORM\Entity
 */
class Etat
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
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="etats",fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $produit;


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
     * @return Etat
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

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Set produit
     *
     * @param \Back\AdministrationBundle\Entity\Produit $produit
     * @return Etat
     */
    public function setProduit(\Back\AdministrationBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Back\AdministrationBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
