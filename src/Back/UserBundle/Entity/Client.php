<?php

namespace Back\UserBundle\Entity ;

use Doctrine\ORM\Mapping as ORM ;

/**
 * Client
 *
 * @ORM\Table(name="ost_client")
 * @ORM\Entity
 */
class Client
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
     * @var string
     *
     * @ORM\Column(name="nomPrenom", type="string", length=255)
     */
    private $nomPrenom ;

    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=255)
     */
    private $tel1 ;

    /**
     * @var string
     *
     * @ORM\Column(name="tel2", type="string", length=255)
     */
    private $tel2 ;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse ;

    /**
     * @ORM\ManyToOne(targetEntity="Back\AdministrationBundle\Entity\Amicale", inversedBy="clients")
     */
    protected $amicale ;

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
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return Client
     */
    public function setNomPrenom($nomPrenom)
    {
        $this->nomPrenom = $nomPrenom ;

        return $this ;
    }

    /**
     * Get nomPrenom
     *
     * @return string 
     */
    public function getNomPrenom()
    {
        return $this->nomPrenom ;
    }

    /**
     * Set tel1
     *
     * @param string $tel1
     * @return Client
     */
    public function setTel1($tel1)
    {
        $this->tel1 = $tel1 ;

        return $this ;
    }

    /**
     * Get tel1
     *
     * @return string 
     */
    public function getTel1()
    {
        return $this->tel1 ;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     * @return Client
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2 ;

        return $this ;
    }

    /**
     * Get tel2
     *
     * @return string 
     */
    public function getTel2()
    {
        return $this->tel2 ;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Client
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse ;

        return $this ;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse ;
    }


    /**
     * Set amicale
     *
     * @param \Back\AdministrationBundle\Entity\Amicale $amicale
     * @return Client
     */
    public function setAmicale(\Back\AdministrationBundle\Entity\Amicale $amicale = null)
    {
        $this->amicale = $amicale;

        return $this;
    }

    /**
     * Get amicale
     *
     * @return \Back\AdministrationBundle\Entity\Amicale 
     */
    public function getAmicale()
    {
        return $this->amicale;
    }
}
