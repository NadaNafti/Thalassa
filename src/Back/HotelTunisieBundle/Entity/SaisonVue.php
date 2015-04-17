<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonVue
 *
 * @ORM\Table(name="ost_sht_hotels_saison_vue")
 * @ORM\Entity
 */
class SaisonVue
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
     * @ORM\Column(name="valeur", type="decimal", precision=11, scale=3)
     */
    private $valeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valeurPour", type="boolean",nullable=true)
     */
    private $valeurPour;

    /**
     * @var string
     *
     * @ORM\Column(name="marge", type="decimal", precision=11, scale=3)
     */
    private $marge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="margePour", type="boolean",nullable=true)
     */
    private $margePour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean",nullable=true)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Vue",fetch="EAGER")
     * @ORM\JoinColumn(name="vue_id", referencedColumnName="id")
     */
    protected $vue;

    /**
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="vues", fetch="EAGER")
     * @ORM\JoinColumn(name="saison_id", referencedColumnName="id")
     */
    protected $saison;

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
     * Set valeur
     *
     * @param string $valeur
     * @return SaisonVue
     */
    public function setValeur($valeur)
    {
        $this->valeur=$valeur;

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

    /**
     * Set valeurPour
     *
     * @param boolean $valeurPour
     * @return SaisonVue
     */
    public function setValeurPour($valeurPour)
    {
        $this->valeurPour=$valeurPour;

        return $this;
    }

    /**
     * Get valeurPour
     *
     * @return boolean 
     */
    public function getValeurPour()
    {
        return $this->valeurPour;
    }

    /**
     * Set marge
     *
     * @param string $marge
     * @return SaisonVue
     */
    public function setMarge($marge)
    {
        $this->marge=$marge;

        return $this;
    }

    /**
     * Get marge
     *
     * @return string 
     */
    public function getMarge()
    {
        return $this->marge;
    }

    /**
     * Set margePour
     *
     * @param boolean $margePour
     * @return SaisonVue
     */
    public function setMargePour($margePour)
    {
        $this->margePour=$margePour;

        return $this;
    }

    /**
     * Get margePour
     *
     * @return boolean 
     */
    public function getMargePour()
    {
        return $this->margePour;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     * @return SaisonVue
     */
    public function setEtat($etat)
    {
        $this->etat=$etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set vue
     *
     * @param \Back\HotelTunisieBundle\Entity\Vue $vue
     * @return SaisonVue
     */
    public function setVue(\Back\HotelTunisieBundle\Entity\Vue $vue=null)
    {
        $this->vue=$vue;

        return $this;
    }

    /**
     * Get vue
     *
     * @return \Back\HotelTunisieBundle\Entity\Vue 
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonVue
     */
    public function setSaison(\Back\HotelTunisieBundle\Entity\Saison $saison=null)
    {
        $this->saison=$saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return \Back\HotelTunisieBundle\Entity\Saison 
     */
    public function getSaison()
    {
        return $this->saison;
    }

    public function getSuppAchat()
    {
        if($this->getValeurPour())
            return $this->getSaison()->prixBaseAchat() * $this->valeur / 100;
        else
            return $this->valeur;
    }

    public function getSuppVente()
    {
        if($this->margePour)
            return $this->getSuppAchat() + abs($this->getSuppAchat()) * $this->marge / 100;
        else
            return $this->getSuppAchat() + $this->marge;
    }

}
