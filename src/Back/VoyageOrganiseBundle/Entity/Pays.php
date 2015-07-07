<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="ost_vo_pays")
 * @ORM\Entity()
 */
class Pays
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="VoyageOrganise", mappedBy="id")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=255)
     */
    private $libelle;

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

    public function __toString()
    {
	return $this->libelle;
    }

}
