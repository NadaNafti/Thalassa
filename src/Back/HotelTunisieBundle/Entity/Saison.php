<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Saison
 *
 * @ORM\Table(name="ost_sht_hotels_saison")
 * @ORM\Entity
 */
class Saison
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
     * @ORM\Column(name="libelle", type="string", length=255,nullable=true)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer",nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="delaiAnnulation", type="integer", nullable=true)
     */
    private $delaiAnnulation;

    /**
     * @var integer
     *
     * @ORM\Column(name="delaiRetrocession", type="integer", nullable=true)
     */
    private $delaiRetrocession;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombrePlace", type="integer", nullable=true)
     */
    private $nombrePlace;

    /**
     * @var integer
     *
     * @ORM\Column(name="aCompte", type="integer", nullable=true)
     */
    private $aCompte;

    /**
     * @var integer
     * @Assert\Range(min = 1)
     * @ORM\Column(name="minStay", type="integer")
     */
    private $minStay;

    /**
     * @var integer
     *
     * @ORM\Column(name="totalContingent", type="integer")
     */
    private $totalContingent;

    /**
     * @ORM\ManyToOne(targetEntity="Arrangement",fetch="EAGER")
     * @ORM\JoinColumn(name="arr_base", referencedColumnName="id")
     * @ORM\OrderBy({"libelle" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $ArrBase;

    /**
     * @var decimal
     * @Assert\Range(min = 1)
     * @ORM\Column(name="prixConvention", type="decimal", precision=11, scale=3)
     */
    private $prixConvention;

    /**
     * @var string
     * @Assert\Range(min = 1)
     * @ORM\Column(name="margeVente", type="decimal", precision=11, scale=3)
     */
    private $margeVente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pourcentage", type="boolean", nullable=true)
     */
    private $pourcentage;
    
    /**
     * @ORM\OneToMany(targetEntity="SaisonChambre", mappedBy="saison")
     */
    protected $chambres;
    
    /**
     * @ORM\OneToMany(targetEntity="SaisonArrangement", mappedBy="saison")
     */
    protected $arrangements;
    
    /**
     * @ORM\OneToOne(targetEntity="SaisonReduc", cascade={"persist"})
     */
    private $saisonReduc;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column( type="datetime")
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column( type="datetime")
     */
    private $updated;

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
     * Set libelle
     *
     * @param string $libelle
     * @return Saison
     */
    public function setLibelle($libelle)
    {
        $this->libelle=$libelle;

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
     * Set delaiAnnulation
     *
     * @param integer $delaiAnnulation
     * @return Saison
     */
    public function setDelaiAnnulation($delaiAnnulation)
    {
        $this->delaiAnnulation=$delaiAnnulation;

        return $this;
    }

    /**
     * Get delaiAnnulation
     *
     * @return integer 
     */
    public function getDelaiAnnulation()
    {
        return $this->delaiAnnulation;
    }

    /**
     * Set delaiRetrocession
     *
     * @param integer $delaiRetrocession
     * @return Saison
     */
    public function setDelaiRetrocession($delaiRetrocession)
    {
        $this->delaiRetrocession=$delaiRetrocession;

        return $this;
    }

    /**
     * Get delaiRetrocession
     *
     * @return integer 
     */
    public function getDelaiRetrocession()
    {
        return $this->delaiRetrocession;
    }

    /**
     * Set nombrePlace
     *
     * @param integer $nombrePlace
     * @return Saison
     */
    public function setNombrePlace($nombrePlace)
    {
        $this->nombrePlace=$nombrePlace;

        return $this;
    }

    /**
     * Get nombrePlace
     *
     * @return integer 
     */
    public function getNombrePlace()
    {
        return $this->nombrePlace;
    }

    /**
     * Set aCompte
     *
     * @param integer $aCompte
     * @return Saison
     */
    public function setACompte($aCompte)
    {
        $this->aCompte=$aCompte;

        return $this;
    }

    /**
     * Get aCompte
     *
     * @return integer 
     */
    public function getACompte()
    {
        return $this->aCompte;
    }

    /**
     * Set minStay
     *
     * @param integer $minStay
     * @return Saison
     */
    public function setMinStay($minStay)
    {
        $this->minStay=$minStay;

        return $this;
    }

    /**
     * Get minStay
     *
     * @return integer 
     */
    public function getMinStay()
    {
        return $this->minStay;
    }

    /**
     * Set totalContingent
     *
     * @param integer $totalContingent
     * @return Saison
     */
    public function setTotalContingent($totalContingent)
    {
        $this->totalContingent=$totalContingent;

        return $this;
    }

    /**
     * Get totalContingent
     *
     * @return integer 
     */
    public function getTotalContingent()
    {
        return $this->totalContingent;
    }

    /**
     * Set prixConvention
     *
     * @param string $prixConvention
     * @return Saison
     */
    public function setPrixConvention($prixConvention)
    {
        $this->prixConvention=$prixConvention;

        return $this;
    }

    /**
     * Get prixConvention
     *
     * @return string 
     */
    public function getPrixConvention()
    {
        return $this->prixConvention;
    }

    /**
     * Set margeVente
     *
     * @param string $margeVente
     * @return Saison
     */
    public function setMargeVente($margeVente)
    {
        $this->margeVente=$margeVente;

        return $this;
    }

    /**
     * Get margeVente
     *
     * @return string 
     */
    public function getMargeVente()
    {
        return $this->margeVente;
    }

    /**
     * Set pourcentage
     *
     * @param boolean $pourcentage
     * @return Saison
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage=$pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return boolean 
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Saison
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Saison
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set ArrBase
     *
     * @param \Back\HotelTunisieBundle\Entity\Arrangement $arrBase
     * @return Saison
     */
    public function setArrBase(\Back\HotelTunisieBundle\Entity\Arrangement $arrBase = null)
    {
        $this->ArrBase = $arrBase;

        return $this;
    }

    /**
     * Get ArrBase
     *
     * @return \Back\HotelTunisieBundle\Entity\Arrangement 
     */
    public function getArrBase()
    {
        return $this->ArrBase;
    }

    /**
     * Set type
     * Null:Base
     * 1:Saison
     * 2:Promotion
     * @param integer $type
     * @return Saison
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     * Null:Base
     * 1:Saison
     * 2:Promotion
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function showSaison()
    {
        if($this->type==null)
            return "Saison de base";
        if($this->type==1)
            return "Saison";
        if($this->type==2)
            return "Promotion";
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chambres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonChambre $chambres
     * @return Saison
     */
    public function addChambre(\Back\HotelTunisieBundle\Entity\SaisonChambre $chambres)
    {
        $this->chambres[] = $chambres;

        return $this;
    }

    /**
     * Remove chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonChambre $chambres
     */
    public function removeChambre(\Back\HotelTunisieBundle\Entity\SaisonChambre $chambres)
    {
        $this->chambres->removeElement($chambres);
    }

    /**
     * Get chambres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChambres()
    {
        return $this->chambres;
    }

    /**
     * Set saisonReduc
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonReduc $saisonReduc
     * @return Saison
     */
    public function setSaisonReduc(\Back\HotelTunisieBundle\Entity\SaisonReduc $saisonReduc = null)
    {
        $this->saisonReduc = $saisonReduc;

        return $this;
    }

    /**
     * Get saisonReduc
     *
     * @return \Back\HotelTunisieBundle\Entity\SaisonReduc 
     */
    public function getSaisonReduc()
    {
        return $this->saisonReduc;
    }

    /**
     * Add arrangements
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements
     * @return Saison
     */
    public function addArrangement(\Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements)
    {
        $this->arrangements[] = $arrangements;

        return $this;
    }

    /**
     * Remove arrangements
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements
     */
    public function removeArrangement(\Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements)
    {
        $this->arrangements->removeElement($arrangements);
    }

    /**
     * Get arrangements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArrangements()
    {
        return $this->arrangements;
    }
}
