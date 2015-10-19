<?php

namespace Back\ResaBookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Configuration
 *
 * @ORM\Table(name="ost_resa_configuration")
 * @ORM\Entity
 */
class Configuration
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="lien_produit", type="string", length=255)
     */
    private $lienProduit;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="lien_prix", type="string", length=255)
     */
    private $lienPrix;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="wsdl", type="string", length=255)
     */
    private $wsdl;

    /**
     * @return string
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * @param string $wsdl
     */
    public function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;
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
     * Set login
     *
     * @param string $login
     * @return Configuration
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Configuration
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set lienProduit
     *
     * @param string $lienProduit
     * @return Configuration
     */
    public function setLienProduit($lienProduit)
    {
        $this->lienProduit = $lienProduit;

        return $this;
    }

    /**
     * Get lienProduit
     *
     * @return string 
     */
    public function getLienProduit()
    {
        return $this->lienProduit;
    }

    /**
     * Set lienPrix
     *
     * @param string $lienPrix
     * @return Configuration
     */
    public function setLienPrix($lienPrix)
    {
        $this->lienPrix = $lienPrix;

        return $this;
    }

    /**
     * Get lienPrix
     *
     * @return string 
     */
    public function getLienPrix()
    {
        return $this->lienPrix;
    }
}
