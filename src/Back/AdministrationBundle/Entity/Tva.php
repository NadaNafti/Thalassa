<?php

namespace Back\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tva
 *
 * @ORM\Table(name="ost_tva")
 * @ORM\Entity
 */
class Tva
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
     * @ORM\Column(name="compteComptable", type="string", length=255)
     */
    private $compteComptable;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="decimal", precision=4, scale=2)
     */
    private $valeur;


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
     * Set compteComptable
     *
     * @param string $compteComptable
     * @return Tva
     */
    public function setCompteComptable($compteComptable)
    {
        $this->compteComptable = $compteComptable;

        return $this;
    }

    /**
     * Get compteComptable
     *
     * @return string 
     */
    public function getCompteComptable()
    {
        return $this->compteComptable;
    }

    /**
     * Set valeur
     *
     * @param string $valeur
     * @return Tva
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    public function __toString()
    {
        return $this->valeur."%";
    }
}
