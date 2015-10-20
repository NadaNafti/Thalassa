<?php

namespace Back\CaisseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TypeLigneCaisse
 *
 * @ORM\Table("ost_c_typeligne")
 * @ORM\Entity
 */
class TypeLigneCaisse {

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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     * @Assert\Choice(choices = {"C", "D"}, message = "Choisir un sens.")
     * @ORM\Column(name="sensMouvement", type="string", length=255)
     */
    private $sensMouvement;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="MouvementSysteme", type="boolean", nullable=true)
     */
    private $MouvementSysteme;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return TypeLigneCaisse
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set sensMouvement
     *
     * @param string $sensMouvement
     * @return TypeLigneCaisse
     */
    public function setSensMouvement($sensMouvement) {
        $this->sensMouvement = $sensMouvement;

        return $this;
    }

    /**
     * Get sensMouvement
     *
     * @return string 
     */
    public function getSensMouvement() {
        return $this->sensMouvement;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return TypeLigneCaisse
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set MouvementSysteme
     *
     * @param boolean $mouvementSysteme
     * @return TypeLigneCaisse
     */
    public function setMouvementSysteme($mouvementSysteme) {
        $this->MouvementSysteme = $mouvementSysteme;

        return $this;
    }

    /**
     * Get MouvementSysteme
     *
     * @return boolean 
     */
    public function getMouvementSysteme() {
        return $this->MouvementSysteme;
    }

    public function __toString() 
    {
        $type = $this->libelle;
        $type = $type . " (" . $this->getSensMouvement() . ")";
        return $type;
    }

}
