<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Reduction
 *
 * @ORM\Table(name="ost_sht_reduction")
 * @ORM\Entity
 */
class Reduction
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
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="jourDebut", type="integer")
     */
    private $jourDebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="moisDebut", type="integer")
     */
    private $moisDebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="jourFin", type="integer")
     */
    private $jourFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="moisFin", type="integer")
     */
    private $moisFin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="parNuit", type="boolean", nullable=true)
     */
    private $parNuit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="parChambre", type="boolean", nullable=true)
     */
    private $parChambre;

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
     * Set parNuit
     *
     * @param boolean $parNuit
     * @return Reduction
     */
    public function setParNuit($parNuit)
    {
        $this->parNuit=$parNuit;

        return $this;
    }

    /**
     * Get parNuit
     *
     * @return boolean 
     */
    public function getParNuit()
    {
        return $this->parNuit;
    }

    /**
     * Set parChambre
     *
     * @param boolean $parChambre
     * @return Reduction
     */
    public function setParChambre($parChambre)
    {
        $this->parChambre=$parChambre;

        return $this;
    }

    /**
     * Get parChambre
     *
     * @return boolean 
     */
    public function getParChambre()
    {
        return $this->parChambre;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Reduction
     */
    public function setCreated($created)
    {
        $this->created=$created;

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
     * @return Reduction
     */
    public function setUpdated($updated)
    {
        $this->updated=$updated;

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
     * Set jourDebut
     *
     * @param integer $jourDebut
     * @return Reduction
     */
    public function setJourDebut($jourDebut)
    {
        $this->jourDebut=$jourDebut;

        return $this;
    }

    /**
     * Get jourDebut
     *
     * @return integer 
     */
    public function getJourDebut()
    {
        return $this->jourDebut;
    }

    /**
     * Set moisDebut
     *
     * @param integer $moisDebut
     * @return Reduction
     */
    public function setMoisDebut($moisDebut)
    {
        $this->moisDebut=$moisDebut;

        return $this;
    }

    /**
     * Get moisDebut
     *
     * @return integer 
     */
    public function getMoisDebut()
    {
        return $this->moisDebut;
    }

    /**
     * Set jourFin
     *
     * @param integer $jourFin
     * @return Reduction
     */
    public function setJourFin($jourFin)
    {
        $this->jourFin=$jourFin;

        return $this;
    }

    /**
     * Get jourFin
     *
     * @return integer 
     */
    public function getJourFin()
    {
        return $this->jourFin;
    }

    /**
     * Set moisFin
     *
     * @param integer $moisFin
     * @return Reduction
     */
    public function setMoisFin($moisFin)
    {
        $this->moisFin=$moisFin;

        return $this;
    }

    /**
     * Get moisFin
     *
     * @return integer 
     */
    public function getMoisFin()
    {
        return $this->moisFin;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Reduction
     */
    public function setSlug($slug)
    {
        $this->slug=$slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Reduction
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

    public function showParChambre()
    {
        if($this->parChambre)
            return 'Par chambre';
        else
            return 'Par Personne';
    }

    public function showParNuit()
    {
        if($this->parNuit)
            return 'Chaque nuit';
        else
            return 'Une seul fois';
    }

    public function __toString()
    {
        return $this->libelle.' du '.$this->jourDebut.'/'.$this->moisDebut.'/'.date('Y').' au '.$this->jourFin.'/'.$this->moisFin.'/'.date('Y');
    }

    public function getDateDebut($year)
    {
        if($this->jourDebut<10)
            $jour='0'.$this->jourDebut;
        else
            $jour=$this->jourDebut;
        if($this->moisDebut<10)
            $mois='0'.$this->moisDebut;
        else
            $mois=$this->moisDebut;
        return $year.'-'.$mois.'-'.$jour;
    }

    public function getDateFin($year)
    {
        if($this->jourFin<10)
            $jour='0'.$this->jourFin;
        else
            $jour=$this->jourFin;
        if($this->moisFin<10)
            $mois='0'.$this->moisFin;
        else
            $mois=$this->moisFin;
        return $year.'-'.$mois.'-'.$jour;
    }

}
