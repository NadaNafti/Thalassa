<?php

namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisonFraisChambreLigne
 *
 * @ORM\Table(name="ost_sht_saison_chambres_frais_lignes"))
 * @ORM\Entity
 */
class SaisonFraisChambreLigne
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
     * @ORM\ManyToOne(targetEntity="SaisonFraisChambre", inversedBy="lignes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $entete;


    /**
     * @var string
     *
     * @ORM\Column(name="NombreAdulte", type="integer")
     */
    private $nombreAdulte;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreEnfant", type="integer")
     */
    private $nombreEnfant;


    /**
     * @ORM\ManyToOne(targetEntity="Arrangement",fetch="EAGER")
     * @ORM\JoinColumn(name="arrangement_id", referencedColumnName="id")
     */
    protected $arrangement;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte1", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte1;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte2", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte2;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte3", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte3;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte4", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte4;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte5", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte5;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte6", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte6;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte7", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte7;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte8", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte8;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte9", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte9;

    /**
     * @var string
     *
     * @ORM\Column(name="adulte10", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $adulte10;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant1", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant1;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant2", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant2;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant3", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant3;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant4", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant4;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant5", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant5;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant6", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant6;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant7", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant7;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant8", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant8;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant9", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant9;

    /**
     * @var string
     *
     * @ORM\Column(name="enfant10", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $enfant10;

    /**
     * @var string
     *
     * @ORM\Column(name="margeAdulte", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $margeAdulte;

    /**
     * @var string
     *
     * @ORM\Column(name="margeEnfant", type="decimal", precision=11, scale=3,nullable=true)
     */
    private $margeEnfant;

    public function __construct()
    {
        $this->adulte1 = 0;
        $this->adulte2 = 0;
        $this->adulte3 = 0;
        $this->adulte4 = 0;
        $this->adulte5 = 0;
        $this->adulte6 = 0;
        $this->adulte7 = 0;
        $this->adulte8 = 0;
        $this->adulte9 = 0;
        $this->adulte10 = 0;

        $this->enfant1 = 0;
        $this->enfant2 = 0;
        $this->enfant3 = 0;
        $this->enfant4 = 0;
        $this->enfant5 = 0;
        $this->enfant6 = 0;
        $this->enfant7 = 0;
        $this->enfant8 = 0;
        $this->enfant9 = 0;
        $this->enfant10 = 0;

        $this->margeAdulte = 0;
        $this->margeEnfant = 0;

    }


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
     * Set adulte1
     *
     * @param string $adulte1
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte1($adulte1)
    {
        $this->adulte1 = $adulte1;

        return $this;
    }

    /**
     * Get adulte1
     *
     * @return string
     */
    public function getAdulte1()
    {
        return $this->adulte1;
    }

    /**
     * Set adulte2
     *
     * @param string $adulte2
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte2($adulte2)
    {
        $this->adulte2 = $adulte2;

        return $this;
    }

    /**
     * Get adulte2
     *
     * @return string
     */
    public function getAdulte2()
    {
        return $this->adulte2;
    }

    /**
     * Set adulte3
     *
     * @param string $adulte3
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte3($adulte3)
    {
        $this->adulte3 = $adulte3;

        return $this;
    }

    /**
     * Get adulte3
     *
     * @return string
     */
    public function getAdulte3()
    {
        return $this->adulte3;
    }

    /**
     * Set adulte4
     *
     * @param string $adulte4
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte4($adulte4)
    {
        $this->adulte4 = $adulte4;

        return $this;
    }

    /**
     * Get adulte4
     *
     * @return string
     */
    public function getAdulte4()
    {
        return $this->adulte4;
    }

    /**
     * Set adulte5
     *
     * @param string $adulte5
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte5($adulte5)
    {
        $this->adulte5 = $adulte5;

        return $this;
    }

    /**
     * Get adulte5
     *
     * @return string
     */
    public function getAdulte5()
    {
        return $this->adulte5;
    }

    /**
     * Set adulte6
     *
     * @param string $adulte6
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte6($adulte6)
    {
        $this->adulte6 = $adulte6;

        return $this;
    }

    /**
     * Get adulte6
     *
     * @return string
     */
    public function getAdulte6()
    {
        return $this->adulte6;
    }

    /**
     * Set adulte7
     *
     * @param string $adulte7
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte7($adulte7)
    {
        $this->adulte7 = $adulte7;

        return $this;
    }

    /**
     * Get adulte7
     *
     * @return string
     */
    public function getAdulte7()
    {
        return $this->adulte7;
    }

    /**
     * Set adulte8
     *
     * @param string $adulte8
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte8($adulte8)
    {
        $this->adulte8 = $adulte8;

        return $this;
    }

    /**
     * Get adulte8
     *
     * @return string
     */
    public function getAdulte8()
    {
        return $this->adulte8;
    }

    /**
     * Set adulte9
     *
     * @param string $adulte9
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte9($adulte9)
    {
        $this->adulte9 = $adulte9;

        return $this;
    }

    /**
     * Get adulte9
     *
     * @return string
     */
    public function getAdulte9()
    {
        return $this->adulte9;
    }

    /**
     * Set adulte10
     *
     * @param string $adulte10
     * @return SaisonFraisChambreLigne
     */
    public function setAdulte10($adulte10)
    {
        $this->adulte10 = $adulte10;

        return $this;
    }

    /**
     * Get adulte10
     *
     * @return string
     */
    public function getAdulte10()
    {
        return $this->adulte10;
    }

    /**
     * Set enfant1
     *
     * @param string $enfant1
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant1($enfant1)
    {
        $this->enfant1 = $enfant1;

        return $this;
    }

    /**
     * Get enfant1
     *
     * @return string
     */
    public function getEnfant1()
    {
        return $this->enfant1;
    }

    /**
     * Set enfant2
     *
     * @param string $enfant2
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant2($enfant2)
    {
        $this->enfant2 = $enfant2;

        return $this;
    }

    /**
     * Get enfant2
     *
     * @return string
     */
    public function getEnfant2()
    {
        return $this->enfant2;
    }

    /**
     * Set enfant3
     *
     * @param string $enfant3
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant3($enfant3)
    {
        $this->enfant3 = $enfant3;

        return $this;
    }

    /**
     * Get enfant3
     *
     * @return string
     */
    public function getEnfant3()
    {
        return $this->enfant3;
    }

    /**
     * Set enfant4
     *
     * @param string $enfant4
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant4($enfant4)
    {
        $this->enfant4 = $enfant4;

        return $this;
    }

    /**
     * Get enfant4
     *
     * @return string
     */
    public function getEnfant4()
    {
        return $this->enfant4;
    }

    /**
     * Set enfant5
     *
     * @param string $enfant5
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant5($enfant5)
    {
        $this->enfant5 = $enfant5;

        return $this;
    }

    /**
     * Get enfant5
     *
     * @return string
     */
    public function getEnfant5()
    {
        return $this->enfant5;
    }

    /**
     * Set enfant6
     *
     * @param string $enfant6
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant6($enfant6)
    {
        $this->enfant6 = $enfant6;

        return $this;
    }

    /**
     * Get enfant6
     *
     * @return string
     */
    public function getEnfant6()
    {
        return $this->enfant6;
    }

    /**
     * Set enfant7
     *
     * @param string $enfant7
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant7($enfant7)
    {
        $this->enfant7 = $enfant7;

        return $this;
    }

    /**
     * Get enfant7
     *
     * @return string
     */
    public function getEnfant7()
    {
        return $this->enfant7;
    }

    /**
     * Set enfant8
     *
     * @param string $enfant8
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant8($enfant8)
    {
        $this->enfant8 = $enfant8;

        return $this;
    }

    /**
     * Get enfant8
     *
     * @return string
     */
    public function getEnfant8()
    {
        return $this->enfant8;
    }

    /**
     * Set enfant9
     *
     * @param string $enfant9
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant9($enfant9)
    {
        $this->enfant9 = $enfant9;

        return $this;
    }

    /**
     * Get enfant9
     *
     * @return string
     */
    public function getEnfant9()
    {
        return $this->enfant9;
    }

    /**
     * Set enfant10
     *
     * @param string $enfant10
     * @return SaisonFraisChambreLigne
     */
    public function setEnfant10($enfant10)
    {
        $this->enfant10 = $enfant10;

        return $this;
    }

    /**
     * Get enfant10
     *
     * @return string
     */
    public function getEnfant10()
    {
        return $this->enfant10;
    }

    /**
     * Set margeAdulte
     *
     * @param string $margeAdulte
     * @return SaisonFraisChambreLigne
     */
    public function setMargeAdulte($margeAdulte)
    {
        $this->margeAdulte = $margeAdulte;

        return $this;
    }

    /**
     * Get margeAdulte
     *
     * @return string
     */
    public function getMargeAdulte()
    {
        return $this->margeAdulte;
    }

    /**
     * Set margeEnfant
     *
     * @param string $margeEnfant
     * @return SaisonFraisChambreLigne
     */
    public function setMargeEnfant($margeEnfant)
    {
        $this->margeEnfant = $margeEnfant;

        return $this;
    }

    /**
     * Get margeEnfant
     *
     * @return string
     */
    public function getMargeEnfant()
    {
        return $this->margeEnfant;
    }

    /**
     * Set nombreAdulte
     *
     * @param string $nombreAdulte
     * @return SaisonFraisChambreLigne
     */
    public function setNombreAdulte($nombreAdulte)
    {
        $this->nombreAdulte = $nombreAdulte;

        return $this;
    }

    /**
     * Get nombreAdulte
     *
     * @return string
     */
    public function getNombreAdulte()
    {
        return $this->nombreAdulte;
    }

    /**
     * Set nombreEnfant
     *
     * @param string $nombreEnfant
     * @return SaisonFraisChambreLigne
     */
    public function setNombreEnfant($nombreEnfant)
    {
        $this->nombreEnfant = $nombreEnfant;

        return $this;
    }

    /**
     * Get nombreEnfant
     *
     * @return string
     */
    public function getNombreEnfant()
    {
        return $this->nombreEnfant;
    }

    /**
     * Set arrangement
     *
     * @param \Back\HotelTunisieBundle\Entity\Arrangement $arrangement
     * @return SaisonFraisChambreLigne
     */
    public function setArrangement(\Back\HotelTunisieBundle\Entity\Arrangement $arrangement = null)
    {
        $this->arrangement = $arrangement;

        return $this;
    }

    /**
     * Get arrangement
     *
     * @return \Back\HotelTunisieBundle\Entity\Arrangement
     */
    public function getArrangement()
    {
        return $this->arrangement;
    }

    /**
     * Set entete
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonFraisChambre $entete
     * @return SaisonFraisChambreLigne
     */
    public function setEntete(\Back\HotelTunisieBundle\Entity\SaisonFraisChambre $entete = null)
    {
        $this->entete = $entete;

        return $this;
    }

    /**
     * Get entete
     *
     * @return \Back\HotelTunisieBundle\Entity\SaisonFraisChambre
     */
    public function getEntete()
    {
        return $this->entete;
    }
}
