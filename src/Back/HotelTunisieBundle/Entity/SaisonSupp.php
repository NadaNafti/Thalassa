<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SaisonSupp
 *
 * @ORM\Table(name="ost_sht_saison_supp")
 * @ORM\Entity
 */
class SaisonSupp
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
     * @ORM\Column(name="suppSingle", type="decimal", precision=11, scale=3)
     */
    private $suppSingle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSinglePour", type="boolean",nullable=true)
     */
    private $suppSinglePour;

    /**
     * @var string
     *
     * @ORM\Column(name="sippSingleMarge", type="decimal", precision=11, scale=3)
     */
    private $sippSingleMarge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSingleMargePour", type="boolean",nullable=true)
     */
    private $suppSingleMargePour;
    /**
     * @var boolean
     *
     * @ORM\Column(name="suppSingleEnfant", type="boolean",nullable=true)
     */
    private $suppSingleEnfant;

    /**
     * @ORM\OneToOne(targetEntity="Saison", mappedBy="saisonSupp")
     * */
    private $saison;

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
     * Set suppSingle
     *
     * @param string $suppSingle
     * @return SaisonSupp
     */
    public function setSuppSingle($suppSingle)
    {
        $this->suppSingle = $suppSingle;

        return $this;
    }

    /**
     * Get suppSingle
     *
     * @return string 
     */
    public function getSuppSingle()
    {
        return $this->suppSingle;
    }

    /**
     * Set suppSinglePour
     *
     * @param boolean $suppSinglePour
     * @return SaisonSupp
     */
    public function setSuppSinglePour($suppSinglePour)
    {
        $this->suppSinglePour = $suppSinglePour;

        return $this;
    }

    /**
     * Get suppSinglePour
     *
     * @return boolean 
     */
    public function getSuppSinglePour()
    {
        return $this->suppSinglePour;
    }

    /**
     * Set sippSingleMarge
     *
     * @param string $sippSingleMarge
     * @return SaisonSupp
     */
    public function setSippSingleMarge($sippSingleMarge)
    {
        $this->sippSingleMarge = $sippSingleMarge;

        return $this;
    }

    /**
     * Get sippSingleMarge
     *
     * @return string 
     */
    public function getSippSingleMarge()
    {
        return $this->sippSingleMarge;
    }

    /**
     * Set suppSingleMargePour
     *
     * @param boolean $suppSingleMargePour
     * @return SaisonSupp
     */
    public function setSuppSingleMargePour($suppSingleMargePour)
    {
        $this->suppSingleMargePour = $suppSingleMargePour;

        return $this;
    }

    /**
     * Get suppSingleMargePour
     *
     * @return boolean 
     */
    public function getSuppSingleMargePour()
    {
        return $this->suppSingleMargePour;
    }

    /**
     * Set suppSingleEnfant
     *
     * @param boolean $suppSingleEnfant
     * @return SaisonSupp
     */
    public function setSuppSingleEnfant($suppSingleEnfant)
    {
        $this->suppSingleEnfant = $suppSingleEnfant;

        return $this;
    }

    /**
     * Get suppSingleEnfant
     *
     * @return boolean 
     */
    public function getSuppSingleEnfant()
    {
        return $this->suppSingleEnfant;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return SaisonSupp
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
     * @return SaisonSupp
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

//    public function getSuppSingleAchat()
//    {
//        if($this->suppSinglePour)
//            return $this->;
//    }

    /**
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonSupp
     */
    public function setSaison(\Back\HotelTunisieBundle\Entity\Saison $saison = null)
    {
        $this->saison = $saison;

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

    public function getSuppSingleAchat($arrangement = null)
    {
        if ($this->suppSinglePour)
            $supp = $this->saison->prixBaseAchat($arrangement) * $this->suppSingle / 100;
        else
            $supp = $this->suppSingle;
        return number_format($supp, 3, '.', '');
    }

    public function getSuppSingleVente($arrangement = null)
    {
        if ($this->suppSinglePour)
            $supp = $this->saison->prixBaseVente($arrangement) * $this->suppSingle / 100;
        else
            $supp = $this->suppSingle;

        if ($this->suppSingleMargePour)
            $marge = $supp * $this->sippSingleMarge / 100;
        else
            $marge = $this->sippSingleMarge;

        return number_format($marge + $supp, 3, '.', '');
    }

    public function getSuppSingleEnfantAchat($arrangement = null)
    {
        if (!$this->suppSingleEnfant)
            return 0;
        return $this->getSuppSingleAchat($arrangement);
    }

    public function getSuppSingleEnfantVente($arrangement = null)
    {
        if (!$this->suppSingleEnfant)
            return 0;
        return $this->getSuppSingleVente($arrangement);
    }

    public function __clone()
    {
        if ($this->id)
        {
            $this->id = NULL;
        }
    }

}
