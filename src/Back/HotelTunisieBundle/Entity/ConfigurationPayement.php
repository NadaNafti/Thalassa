<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigurationPayement
 *
 * @ORM\Table(name="ost_sht_configuration_payement")
 * @ORM\Entity
 */
class ConfigurationPayement
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
     * @ORM\Column(name="remiseInternet", type="decimal", precision=11, scale=3)
     */
    private $remiseInternet;

    /**
     * @var boolean
     *
     * @ORM\Column(name="remiseInternetPourcentage", type="boolean",nullable=true)
     */
    private $remiseInternetPourcentage;

    /**
     * @var string
     *
     * @ORM\Column(name="avance", type="decimal", precision=11, scale=3)
     */
    private $avance;


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
     * Set remiseInternet
     *
     * @param string $remiseInternet
     * @return ConfigurationPayement
     */
    public function setRemiseInternet($remiseInternet)
    {
        $this->remiseInternet = $remiseInternet;

        return $this;
    }

    /**
     * Get remiseInternet
     *
     * @return string 
     */
    public function getRemiseInternet()
    {
        return $this->remiseInternet;
    }

    /**
     * Set remiseInternetPourcentage
     *
     * @param boolean $remiseInternetPourcentage
     * @return ConfigurationPayement
     */
    public function setRemiseInternetPourcentage($remiseInternetPourcentage)
    {
        $this->remiseInternetPourcentage = $remiseInternetPourcentage;

        return $this;
    }

    /**
     * Get remiseInternetPourcentage
     *
     * @return boolean 
     */
    public function getRemiseInternetPourcentage()
    {
        return $this->remiseInternetPourcentage;
    }


    /**
     * Set avance
     *
     * @param string $avance
     * @return ConfigurationPayement
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;

        return $this;
    }

    /**
     * Get avance
     *
     * @return string 
     */
    public function getAvance()
    {
        return $this->avance;
    }
}
