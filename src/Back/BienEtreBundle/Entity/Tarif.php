<?php

namespace Back\BienEtreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarif
 *
 * @ORM\Table(name="ost_be_tarif")
 * @ORM\Entity
 */
class Tarif {

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
     * @ORM\ManyToOne(targetEntity="Produit",inversedBy="tarifs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $produit;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set prixAchat
     *
     * @param string $prixAchat
     * @return Tarif
     */
    public function setPrixAchat($prixAchat) {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return string 
     */
    public function getPrixAchat() {
        return $this->prixAchat;
    }

    /**
     * Set prixVente
     *
     * @param string $prixVente
     * @return Tarif
     */
    public function setPrixVente($prixVente) {
        $this->prixVente = $prixVente;

        return $this;
    }

    /**
     * Get prixVente
     *
     * @return string 
     */
    public function getPrixVente() {
        return $this->prixVente;
    }

    /**
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     * @return Tarif
     */
    public function setDateDeb($dateDeb) {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime 
     */
    public function getDateDeb() {
        return $this->dateDeb;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Tarif
     */
    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin() {
        return $this->dateFin;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Tarif
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
     * Set promotion
     *
     * @param boolean $promotion
     * @return Tarif
     */
    public function setPromotion($promotion) {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return boolean 
     */
    public function getPromotion() {
        return $this->promotion;
    }

    /**
     * Set produit
     *
     * @param \Back\BienEtreBundle\Entity\Produit $produit
     * @return Tarif
     */
    public function setProduit(\Back\BienEtreBundle\Entity\Produit $produit = null) {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Back\BienEtreBundle\Entity\Produit 
     */
    public function getProduit() {
        return $this->produit;
    }

    public function __toString() {
        return $this->libelle;
    }

    public function isValide() {
        if ($this->dateDeb->format('Y-m-d') <= date('Y-m-d') && $this->dateFin->format('Y-m-d') >= date('Y-m-d'))
            return TRUE;
        return FALSE;
    }
    
    public function isValideByDate($date) {
        if ($this->dateDeb->format('Y-m-d') <= $date && $this->dateFin->format('Y-m-d') >= $date)
            return TRUE;
        return FALSE;
    }
    
    

}
