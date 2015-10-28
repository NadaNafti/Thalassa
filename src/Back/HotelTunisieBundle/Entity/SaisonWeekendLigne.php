<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonWeekendLigne
 *
 * @ORM\Table(name="ost_sht_saison_weekend_lignes")
 * @ORM\Entity
 */
class SaisonWeekendLigne
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
     * @ORM\ManyToOne(targetEntity="SaisonWeekend", inversedBy="lignes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $saisonWeekend;

    /**
     * @ORM\ManyToOne(targetEntity="Chambre",fetch="EAGER")
     * @ORM\JoinColumn(name="chambre_id", referencedColumnName="id")
     */
    protected $chambre;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="decimal")
     */
    private $valeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valeurPour", type="boolean",nullable=true)
     */
    private $valeurPour;


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
     * @return SaisonWeekendLigne
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

    /**
     * Set valeurPour
     *
     * @param boolean $valeurPour
     * @return SaisonWeekendLigne
     */
    public function setValeurPour($valeurPour)
    {
        $this->valeurPour = $valeurPour;

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
     * Set saisonWeekend
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonWeekend $saisonWeekend
     * @return SaisonWeekendLigne
     */
    public function setSaisonWeekend(\Back\HotelTunisieBundle\Entity\SaisonWeekend $saisonWeekend = null)
    {
        $this->saisonWeekend = $saisonWeekend;

        return $this;
    }

    /**
     * Get saisonWeekend
     *
     * @return \Back\HotelTunisieBundle\Entity\SaisonWeekend 
     */
    public function getSaisonWeekend()
    {
        return $this->saisonWeekend;
    }

    /**
     * Set chambre
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambre
     * @return SaisonWeekendLigne
     */
    public function setChambre(\Back\HotelTunisieBundle\Entity\Chambre $chambre = null)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return \Back\HotelTunisieBundle\Entity\Chambre 
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    public function getReducSuppAchat($arrangement = null)
    {
        if($this->saisonWeekend->getType() == 1)
            $x=1;
        else
            $x=-1;
        if($this->valeurPour)
            $suppReduc =  $x * $this->saisonWeekend->getSaison()->prixBaseAchat($arrangement) * $this->valeur / 100;
        else
            $suppReduc = $x * $this->valeur;
        return number_format($suppReduc, 3, '.', '');
    }

    public function getReducSuppVente($arrangement = null)
    {
        if($this->saisonWeekend->getType() == 1)
            $x=1;
        else
            $x=-1;
        if($this->valeurPour)
            $suppReduc =  $x * $this->saisonWeekend->getSaison()->prixBaseVente($arrangement) * $this->valeur / 100;
        else
            $suppReduc = $x * $this->valeur;

        if($this->saisonWeekend->getMargePour())
            $marge = abs($suppReduc) * $this->saisonWeekend->getMarge() / 100;
        else
            $marge = $this->saisonWeekend->getMarge() ;
        return number_format($suppReduc + $marge, 3, '.', '');
    }
}
