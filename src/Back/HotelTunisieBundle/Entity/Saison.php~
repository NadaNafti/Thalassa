<?php

namespace Back\HotelTunisieBundle\Entity ;

use Doctrine\ORM\Mapping as ORM ;
use Gedmo\Mapping\Annotation as Gedmo ;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Saison
 *
 * @ORM\Table(name="ost_sht_saison")
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
    private $id ;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255,nullable=true)
     */
    private $libelle ;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer",nullable=true)
     */
    private $type ;

    /**
     * @var integer
     *
     * @ORM\Column(name="delaiAnnulation", type="integer", nullable=true)
     */
    private $delaiAnnulation ;

    /**
     * @var integer
     *
     * @ORM\Column(name="delaiRetrocession", type="integer", nullable=true)
     */
    private $delaiRetrocession ;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombrePlace", type="integer", nullable=true)
     */
    private $nombrePlace ;

    /**
     * @var integer
     *
     * @ORM\Column(name="aCompte", type="integer", nullable=true)
     */
    private $aCompte ;

    /**
     * @var integer
     * @Assert\Range(min = 1)
     * @ORM\Column(name="minStay", type="integer")
     */
    private $minStay ;

    /**
     * @var integer
     * @Assert\Range(min = 1)
     * @ORM\Column(name="totalContingent", type="integer")
     */
    private $totalContingent ;

    /**
     * @ORM\ManyToOne(targetEntity="Arrangement",fetch="EAGER")
     * @ORM\JoinColumn(name="arr_base", referencedColumnName="id")
     * @ORM\OrderBy({"libelle" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $ArrBase ;

    /**
     * @var decimal
     * @Assert\Range(min = 1)
     * @ORM\Column(name="prixConvention", type="decimal", precision=11, scale=3)
     */
    private $prixConvention ;

    /**
     * @var string
     * @Assert\Range(min = 1)
     * @ORM\Column(name="margeVente", type="decimal", precision=11, scale=3)
     */
    private $margeVente ;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pourcentage", type="boolean", nullable=true)
     */
    private $pourcentage ;

    /**
     * @ORM\OneToMany(targetEntity="SaisonChambre", mappedBy="saison")
     */
    protected $chambres ;

    /**
     * @ORM\OneToMany(targetEntity="SaisonSuppChambre", mappedBy="saison")
     */
    protected $suppChambres ;

    /**
     * @ORM\OneToMany(targetEntity="SaisonVue", mappedBy="saison")
     */
    protected $vues ;

    /**
     * @ORM\OneToMany(targetEntity="SaisonArrangement", mappedBy="saison")
     */
    protected $arrangements ;

    /**
     * @ORM\OneToMany(targetEntity="SaisonAutreSupp", mappedBy="saison")
     */
    protected $autresSupplements ;

    /**
     * @ORM\OneToMany(targetEntity="SaisonAutreReduc", mappedBy="saison")
     */
    protected $autresReductions ;
    
    /**
     * @ORM\OneToMany(targetEntity="Periode", mappedBy="saison")
     * @ORM\OrderBy({"dateDebut" = "ASC"})
     */
    protected $periodes ;

    /**
     * @ORM\OneToOne(targetEntity="SaisonReduc", inversedBy="saison", cascade={"persist"})
     */
    private $saisonReduc ;

    /**
     * @ORM\OneToOne(targetEntity="SaisonSupp", inversedBy="saison", cascade={"persist"})
     */
    private $saisonSupp ;

    /**
     * @ORM\OneToOne(targetEntity="SaisonWeekend", inversedBy="saison", cascade={"persist"})
     */
    private $saisonWeekend ;

    /**
     * @ORM\OneToOne(targetEntity="Hotel", mappedBy="saisonBase")
     * */
    private $hotelBase ;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="saisons")
     */
    protected $hotel ;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column( type="datetime")
     */
    private $created ;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column( type="datetime")
     */
    private $updated ;

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
     * Set libelle
     *
     * @param string $libelle
     * @return Saison
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle ;

        return $this ;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle ;
    }

    /**
     * Set delaiAnnulation
     *
     * @param integer $delaiAnnulation
     * @return Saison
     */
    public function setDelaiAnnulation($delaiAnnulation)
    {
        $this->delaiAnnulation = $delaiAnnulation ;

        return $this ;
    }

    /**
     * Get delaiAnnulation
     *
     * @return integer 
     */
    public function getDelaiAnnulation()
    {
        return $this->delaiAnnulation ;
    }

    /**
     * Set delaiRetrocession
     *
     * @param integer $delaiRetrocession
     * @return Saison
     */
    public function setDelaiRetrocession($delaiRetrocession)
    {
        $this->delaiRetrocession = $delaiRetrocession ;

        return $this ;
    }

    /**
     * Get delaiRetrocession
     *
     * @return integer 
     */
    public function getDelaiRetrocession()
    {
        return $this->delaiRetrocession ;
    }

    /**
     * Set nombrePlace
     *
     * @param integer $nombrePlace
     * @return Saison
     */
    public function setNombrePlace($nombrePlace)
    {
        $this->nombrePlace = $nombrePlace ;

        return $this ;
    }

    /**
     * Get nombrePlace
     *
     * @return integer 
     */
    public function getNombrePlace()
    {
        return $this->nombrePlace ;
    }

    /**
     * Set aCompte
     *
     * @param integer $aCompte
     * @return Saison
     */
    public function setACompte($aCompte)
    {
        $this->aCompte = $aCompte ;

        return $this ;
    }

    /**
     * Get aCompte
     *
     * @return integer 
     */
    public function getACompte()
    {
        return $this->aCompte ;
    }

    /**
     * Set minStay
     *
     * @param integer $minStay
     * @return Saison
     */
    public function setMinStay($minStay)
    {
        $this->minStay = $minStay ;

        return $this ;
    }

    /**
     * Get minStay
     *
     * @return integer 
     */
    public function getMinStay()
    {
        return $this->minStay ;
    }

    /**
     * Set totalContingent
     *
     * @param integer $totalContingent
     * @return Saison
     */
    public function setTotalContingent($totalContingent)
    {
        $this->totalContingent = $totalContingent ;

        return $this ;
    }

    /**
     * Get totalContingent
     *
     * @return integer 
     */
    public function getTotalContingent()
    {
        return $this->totalContingent ;
    }

    /**
     * Set prixConvention
     *
     * @param string $prixConvention
     * @return Saison
     */
    public function setPrixConvention($prixConvention)
    {
        $this->prixConvention = $prixConvention ;

        return $this ;
    }

    /**
     * Get prixConvention
     *
     * @return string 
     */
    public function getPrixConvention()
    {
        return $this->prixConvention ;
    }

    /**
     * Set margeVente
     *
     * @param string $margeVente
     * @return Saison
     */
    public function setMargeVente($margeVente)
    {
        $this->margeVente = $margeVente ;

        return $this ;
    }

    /**
     * Get margeVente
     *
     * @return string 
     */
    public function getMargeVente()
    {
        return $this->margeVente ;
    }

    /**
     * Set pourcentage
     *
     * @param boolean $pourcentage
     * @return Saison
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage ;

        return $this ;
    }

    /**
     * Get pourcentage
     *
     * @return boolean 
     */
    public function getPourcentage()
    {
        return $this->pourcentage ;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Saison
     */
    public function setCreated($created)
    {
        $this->created = $created ;

        return $this ;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created ;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Saison
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated ;

        return $this ;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated ;
    }

    /**
     * Set ArrBase
     *
     * @param \Back\HotelTunisieBundle\Entity\Arrangement $arrBase
     * @return Saison
     */
    public function setArrBase(\Back\HotelTunisieBundle\Entity\Arrangement $arrBase = null)
    {
        $this->ArrBase = $arrBase ;

        return $this ;
    }

    /**
     * Get ArrBase
     *
     * @return \Back\HotelTunisieBundle\Entity\Arrangement 
     */
    public function getArrBase()
    {
        return $this->ArrBase ;
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
        $this->type = $type ;

        return $this ;
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
        return $this->type ;
    }

    public function showSaison()
    {
        if ($this->type == null)
            return "Saison de base" ;
        if ($this->type == 1)
            return "Saison" ;
        if ($this->type == 2)
            return "Promotion" ;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chambres = new \Doctrine\Common\Collections\ArrayCollection() ;
    }

    /**
     * Add chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonChambre $chambres
     * @return Saison
     */
    public function addChambre(\Back\HotelTunisieBundle\Entity\SaisonChambre $chambres)
    {
        $this->chambres[] = $chambres ;

        return $this ;
    }

    /**
     * Remove chambres
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonChambre $chambres
     */
    public function removeChambre(\Back\HotelTunisieBundle\Entity\SaisonChambre $chambres)
    {
        $this->chambres->removeElement($chambres) ;
    }

    /**
     * Get chambres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChambres()
    {
        return $this->chambres ;
    }

    /**
     * Set saisonReduc
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonReduc $saisonReduc
     * @return Saison
     */
    public function setSaisonReduc(\Back\HotelTunisieBundle\Entity\SaisonReduc $saisonReduc = null)
    {
        $this->saisonReduc = $saisonReduc ;

        return $this ;
    }

    /**
     * Get saisonReduc
     *
     * @return \Back\HotelTunisieBundle\Entity\SaisonReduc 
     */
    public function getSaisonReduc()
    {
        return $this->saisonReduc ;
    }

    /**
     * Add arrangements
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements
     * @return Saison
     */
    public function addArrangement(\Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements)
    {
        $this->arrangements[] = $arrangements ;

        return $this ;
    }

    /**
     * Remove arrangements
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements
     */
    public function removeArrangement(\Back\HotelTunisieBundle\Entity\SaisonArrangement $arrangements)
    {
        $this->arrangements->removeElement($arrangements) ;
    }

    /**
     * Get arrangements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArrangements()
    {
        return $this->arrangements ;
    }

    /**
     * Get arrangements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrixDeBase()
    {
        if ($this->pourcentage == 1)
            return $this->prixConvention + ($this->prixConvention * $this->margeVente / 100) ;
        else
            return $this->prixConvention + $this->margeVente ;
    }

    /**
     * Add suppChambres
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonSuppChambre $suppChambres
     * @return Saison
     */
    public function addSuppChambre(\Back\HotelTunisieBundle\Entity\SaisonSuppChambre $suppChambres)
    {
        $this->suppChambres[] = $suppChambres ;

        return $this ;
    }

    /**
     * Remove suppChambres
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonSuppChambre $suppChambres
     */
    public function removeSuppChambre(\Back\HotelTunisieBundle\Entity\SaisonSuppChambre $suppChambres)
    {
        $this->suppChambres->removeElement($suppChambres) ;
    }

    /**
     * Get suppChambres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuppChambres()
    {
        return $this->suppChambres ;
    }

    /**
     * Add vues
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonVue $vues
     * @return Saison
     */
    public function addVue(\Back\HotelTunisieBundle\Entity\SaisonVue $vues)
    {
        $this->vues[] = $vues ;

        return $this ;
    }

    /**
     * Remove vues
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonVue $vues
     */
    public function removeVue(\Back\HotelTunisieBundle\Entity\SaisonVue $vues)
    {
        $this->vues->removeElement($vues) ;
    }

    /**
     * Get vues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVues()
    {
        return $this->vues ;
    }

    /**
     * Set saisonSupp
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonSupp $saisonSupp
     * @return Saison
     */
    public function setSaisonSupp(\Back\HotelTunisieBundle\Entity\SaisonSupp $saisonSupp = null)
    {
        $this->saisonSupp = $saisonSupp ;

        return $this ;
    }

    /**
     * Get saisonSupp
     *
     * @return \Back\HotelTunisieBundle\Entity\SaisonSupp 
     */
    public function getSaisonSupp()
    {
        return $this->saisonSupp ;
    }

    /**
     * Set saisonWeekend
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonWeekend $saisonWeekend
     * @return Saison
     */
    public function setSaisonWeekend(\Back\HotelTunisieBundle\Entity\SaisonWeekend $saisonWeekend = null)
    {
        $this->saisonWeekend = $saisonWeekend ;

        return $this ;
    }

    /**
     * Get saisonWeekend
     *
     * @return \Back\HotelTunisieBundle\Entity\SaisonWeekend 
     */
    public function getSaisonWeekend()
    {
        return $this->saisonWeekend ;
    }

    /**
     * Add autresSupplements
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonAutreSupp $autresSupplements
     * @return Saison
     */
    public function addAutresSupplement(\Back\HotelTunisieBundle\Entity\SaisonAutreSupp $autresSupplements)
    {
        $this->autresSupplements[] = $autresSupplements ;

        return $this ;
    }

    /**
     * Remove autresSupplements
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonAutreSupp $autresSupplements
     */
    public function removeAutresSupplement(\Back\HotelTunisieBundle\Entity\SaisonAutreSupp $autresSupplements)
    {
        $this->autresSupplements->removeElement($autresSupplements) ;
    }

    /**
     * Get autresSupplements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAutresSupplements()
    {
        return $this->autresSupplements ;
    }

    /**
     * Add autresReductions
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonAutreReduc $autresReductions
     * @return Saison
     */
    public function addAutresReduction(\Back\HotelTunisieBundle\Entity\SaisonAutreReduc $autresReductions)
    {
        $this->autresReductions[] = $autresReductions ;

        return $this ;
    }

    /**
     * Remove autresReductions
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonAutreReduc $autresReductions
     */
    public function removeAutresReduction(\Back\HotelTunisieBundle\Entity\SaisonAutreReduc $autresReductions)
    {
        $this->autresReductions->removeElement($autresReductions) ;
    }

    /**
     * Get autresReductions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAutresReductions()
    {
        return $this->autresReductions ;
    }

    /**
     * Set hotelBase
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotelBase
     * @return Saison
     */
    public function setHotelBase(\Back\HotelTunisieBundle\Entity\Hotel $hotelBase = null)
    {
        $this->hotelBase = $hotelBase ;

        return $this ;
    }

    /**
     * Get hotelBase
     *
     * @return \Back\HotelTunisieBundle\Entity\Hotel 
     */
    public function getHotelBase()
    {
        return $this->hotelBase ;
    }

    public function isValidSaisonBase()
    {
        if (count($this->chambres) != count($this->hotelBase->getChambres()))
            return FALSE ;
        elseif (count($this->arrangements) + 1 != count($this->hotelBase->getArrangements()))
            return FALSE ;
        elseif (count($this->suppChambres) != $this->hotelBase->getCountAutresChambres())
            return FALSE ;
        elseif (count($this->vues) != count($this->hotelBase->getVues()))
            return FALSE ;
        elseif ($this->saisonReduc == null)
            return FALSE ;
        elseif ($this->saisonSupp == null)
            return FALSE ;
        elseif ($this->saisonWeekend == null && $this->hotelBase->getFicheTechnique()->getTarifWeekend())
            return FALSE ;
        else
            return TRUE ;
    }
    
    
    public function isValid()
    {
        if (count($this->chambres) != count($this->hotel->getChambres()))
            return FALSE ;
        elseif (count($this->arrangements) + 1 != count($this->hotel->getArrangements()))
            return FALSE ;
        elseif (count($this->suppChambres) != $this->hotel->getCountAutresChambres())
            return FALSE ;
        elseif (count($this->vues) != count($this->hotel->getVues()))
            return FALSE ;
        elseif ($this->saisonReduc == null)
            return FALSE ;
        elseif ($this->saisonSupp == null)
            return FALSE ;
        elseif ($this->saisonWeekend == null && $this->hotel->getFicheTechnique()->getTarifWeekend())
            return FALSE ;
        else
            return TRUE ;
    }

    /**
     * Calcule Prix Achat de base
     */
    public function prixBaseAchat()
    {
        return $this->prixConvention ;
    }

    /**
     * Calcule Prix vente de base
     */
    public function prixBaseVente()
    {
        if ($this->pourcentage)
            return $this->prixConvention + ($this->prixConvention * $this->margeVente / 100) ;
        else
            return $this->prixConvention + $this->margeVente ;
    }

    public function __toString()
    {
        return $this->libelle ;
    }

    /**
     * Set hotel
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotel
     * @return Saison
     */
    public function setHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel ;

        return $this ;
    }

    /**
     * Get hotel
     *
     * @return \Back\HotelTunisieBundle\Entity\Hotel 
     */
    public function getHotel()
    {
        return $this->hotel ;
    }

    public function clearId()
    {
        $this->id = NULL ;
        return $this ;
    }

    public function __clone()
    {
        if ($this->id)
        {
            $this->id = null ;
            if ($this->saisonReduc != null)
                $this->saisonReduc = clone $this->saisonReduc ;
            if ($this->saisonSupp != null)
                $this->saisonSupp = clone $this->saisonSupp ;
            if ($this->arrangements != null)
                $this->arrangements = clone $this->arrangements ;
            if ($this->saisonWeekend != null)
                $this->saisonWeekend = clone $this->saisonWeekend ;
        }
    }


    /**
     * Add periodes
     *
     * @param \Back\HotelTunisieBundle\Entity\Periode $periodes
     * @return Saison
     */
    public function addPeriode(\Back\HotelTunisieBundle\Entity\Periode $periodes)
    {
        $this->periodes[] = $periodes;

        return $this;
    }

    /**
     * Remove periodes
     *
     * @param \Back\HotelTunisieBundle\Entity\Periode $periodes
     */
    public function removePeriode(\Back\HotelTunisieBundle\Entity\Periode $periodes)
    {
        $this->periodes->removeElement($periodes);
    }

    /**
     * Get periodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPeriodes()
    {
        return $this->periodes;
    }
}
