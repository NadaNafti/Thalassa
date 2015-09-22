<?php

namespace Front\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Accueil
 *
 * @ORM\Table(name="ost_front_accueil")
 * @ORM\Entity
 */
class Accueil
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
     * @ORM\ManyToOne(targetEntity="MediaAccueil", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo1;

    /**
     * @var string
     *
     * @ORM\Column(name="titre1", type="string", length=255)
     */
    private $titre1;

    /**
     * @var string
     *
     * @ORM\Column(name="texte1", type="text")
     */
    private $texte1;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="lien1", type="string", length=255)
     */
    private $lien1;

    /**
     * @ORM\ManyToOne(targetEntity="MediaAccueil", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo2;

    /**
     * @var string
     *
     * @ORM\Column(name="titre2", type="string", length=255)
     */
    private $titre2;

    /**
     * @var string
     *
     * @ORM\Column(name="texte2", type="text")
     */
    private $texte2;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="lien2", type="string", length=255)
     */
    private $lien2;

    /**
     * @ORM\ManyToOne(targetEntity="MediaAccueil", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $photo3;

    /**
     * @var string
     *
     * @ORM\Column(name="titre3", type="string", length=255)
     */
    private $titre3;

    /**
     * @var string
     *
     * @ORM\Column(name="texte3", type="text")
     */
    private $texte3;

    /**
     * @var string
     * @Assert\Url()
     * @ORM\Column(name="lien3", type="string", length=255)
     */
    private $lien3;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="skype", type="string", length=255)
     */
    private $skype;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="googlePlus", type="string", length=255)
     */
    private $googlePlus;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string", length=255)
     */
    private $youtube;


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
     * Set titre1
     *
     * @param string $titre1
     * @return Accueil
     */
    public function setTitre1($titre1)
    {
        $this->titre1 = $titre1;

        return $this;
    }

    /**
     * Get titre1
     *
     * @return string
     */
    public function getTitre1()
    {
        return $this->titre1;
    }

    /**
     * Set texte1
     *
     * @param string $texte1
     * @return Accueil
     */
    public function setTexte1($texte1)
    {
        $this->texte1 = $texte1;

        return $this;
    }

    /**
     * Get texte1
     *
     * @return string
     */
    public function getTexte1()
    {
        return $this->texte1;
    }

    /**
     * Set lien1
     *
     * @param string $lien1
     * @return Accueil
     */
    public function setLien1($lien1)
    {
        $this->lien1 = $lien1;

        return $this;
    }

    /**
     * Get lien1
     *
     * @return string
     */
    public function getLien1()
    {
        return $this->lien1;
    }

    /**
     * Set titre2
     *
     * @param string $titre2
     * @return Accueil
     */
    public function setTitre2($titre2)
    {
        $this->titre2 = $titre2;

        return $this;
    }

    /**
     * Get titre2
     *
     * @return string
     */
    public function getTitre2()
    {
        return $this->titre2;
    }

    /**
     * Set texte2
     *
     * @param string $texte2
     * @return Accueil
     */
    public function setTexte2($texte2)
    {
        $this->texte2 = $texte2;

        return $this;
    }

    /**
     * Get texte2
     *
     * @return string
     */
    public function getTexte2()
    {
        return $this->texte2;
    }

    /**
     * Set lien2
     *
     * @param string $lien2
     * @return Accueil
     */
    public function setLien2($lien2)
    {
        $this->lien2 = $lien2;

        return $this;
    }

    /**
     * Get lien2
     *
     * @return string
     */
    public function getLien2()
    {
        return $this->lien2;
    }

    /**
     * Set titre3
     *
     * @param string $titre3
     * @return Accueil
     */
    public function setTitre3($titre3)
    {
        $this->titre3 = $titre3;

        return $this;
    }

    /**
     * Get titre3
     *
     * @return string
     */
    public function getTitre3()
    {
        return $this->titre3;
    }

    /**
     * Set texte3
     *
     * @param string $texte3
     * @return Accueil
     */
    public function setTexte3($texte3)
    {
        $this->texte3 = $texte3;

        return $this;
    }

    /**
     * Get texte3
     *
     * @return string
     */
    public function getTexte3()
    {
        return $this->texte3;
    }

    /**
     * Set lien3
     *
     * @param string $lien3
     * @return Accueil
     */
    public function setLien3($lien3)
    {
        $this->lien3 = $lien3;

        return $this;
    }

    /**
     * Get lien3
     *
     * @return string
     */
    public function getLien3()
    {
        return $this->lien3;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Accueil
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set skype
     *
     * @param string $skype
     * @return Accueil
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Accueil
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set googlePlus
     *
     * @param string $googlePlus
     * @return Accueil
     */
    public function setGooglePlus($googlePlus)
    {
        $this->googlePlus = $googlePlus;

        return $this;
    }

    /**
     * Get googlePlus
     *
     * @return string
     */
    public function getGooglePlus()
    {
        return $this->googlePlus;
    }

    /**
     * Set youtube
     *
     * @param string $youtube
     * @return Accueil
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set photo1
     *
     * @param \Front\ConfigBundle\Entity\MediaAccueil $photo1
     * @return Accueil
     */
    public function setPhoto1(\Front\ConfigBundle\Entity\MediaAccueil $photo1 = null)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1
     *
     * @return \Front\ConfigBundle\Entity\MediaAccueil
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set photo2
     *
     * @param \Front\ConfigBundle\Entity\MediaAccueil $photo2
     * @return Accueil
     */
    public function setPhoto2(\Front\ConfigBundle\Entity\MediaAccueil $photo2 = null)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2
     *
     * @return \Front\ConfigBundle\Entity\MediaAccueil
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set photo3
     *
     * @param \Front\ConfigBundle\Entity\MediaAccueil $photo3
     * @return Accueil
     */
    public function setPhoto3(\Front\ConfigBundle\Entity\MediaAccueil $photo3 = null)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3
     *
     * @return \Front\ConfigBundle\Entity\MediaAccueil
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

    public function getPhoto($i)
    {
        $methode = 'getPhoto' . $i;
        return $this->$methode();
    }

    public function getTitre($i)
    {
        $methode = 'getTitre' . $i;
        return $this->$methode();
    }

    public function getTexte($i)
    {
        $methode = 'getTexte' . $i;
        return $this->$methode();
    }

    public function getLien($i)
    {
        $methode = 'getLien' . $i;
        return $this->$methode();
    }
}