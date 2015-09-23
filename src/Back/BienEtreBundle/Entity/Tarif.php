<?php

namespace Back\BienEtreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarif
 *
 * @ORM\Table(name="ost_be_tarif")
 * @ORM\Entity
 */
class Tarif
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
     * @var decimal
     *
     * @ORM\Column(name="prixAchat", type="decimal", precision=11 ,scale=3)
     */
    private $prixAchat;

    /**
     * @var decimal
     *
     * @ORM\Column(name="prixVente", type="decimal", precision=11 ,scale=3)
     */
    private $prixVente;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateDeb", type="date")
     */
    private $dateDeb;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255,nullable=true)
     */
    private $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="promotion", type="boolean",nullable=true)
     */
    private $promotion;
    
    /**
     * @ORM\ManyToOne(targetEntity="Soin" , inversedBy="tarifs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $soin;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Back\BienEtreBundle\Entity\Cure",inversedBy="tarifs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $cure;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Back\BienEtreBundle\Entity\Pack",inversedBy="tarifs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $pack;

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
     * Set prixAchat
     *
     * @param string $prixAchat
     * @return Tarif
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return string 
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set prixVente
     *
     * @param string $prixVente
     * @return Tarif
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    /**
     * Get prixVente
     *
     * @return string 
     */
    public function getPrixVente()
    {
        return $this->prixVente;
    }

    /**
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     * @return Tarif
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime 
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Tarif
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Tarif
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

    /**
     * Set promotion
     *
     * @param boolean $promotion
     * @return Tarif
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return boolean 
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set soin
     *
     * @param \Back\BienEtreBundle\Entity\Soin $soin
     * @return Tarif
     */
    public function setSoin(\Back\BienEtreBundle\Entity\Soin $soin = null)
    {
        $this->soin = $soin;

        return $this;
    }

    /**
     * Get soin
     *
     * @return \Back\BienEtreBundle\Entity\Soin 
     */
    public function getSoin()
    {
        return $this->soin;
    }

    /**
     * Set cure
     *
     * @param \Back\BienEtreBundle\Entity\Cure $cure
     * @return Tarif
     */
    public function setCure(\Back\BienEtreBundle\Entity\Cure $cure = null)
    {
        $this->cure = $cure;

        return $this;
    }

    /**
     * Get cure
     *
     * @return \Back\BienEtreBundle\Entity\Cure 
     */
    public function getCure()
    {
        return $this->cure;
    }

    /**
     * Set pack
     *
     * @param \Back\BienEtreBundle\Entity\Pack $pack
     * @return Tarif
     */
    public function setPack(\Back\BienEtreBundle\Entity\Pack $pack = null)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return \Back\BienEtreBundle\Entity\Pack 
     */
    public function getPack()
    {
        return $this->pack;
    }
}
