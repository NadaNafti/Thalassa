<?php
namespace Back\HotelTunisieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisonFraisChambre
 *
 * @ORM\Table(name="ost_sht_saison_chambres_frais"))
 * @ORM\Entity
 */
class SaisonFraisChambre
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
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="fraisChambres", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $saison;

    /**
     * @ORM\ManyToOne(targetEntity="Chambre",fetch="EAGER")
     * @ORM\JoinColumn(name="chambre_id", referencedColumnName="id")
     */
    protected $chambre;

    /**
     * @ORM\OneToMany(targetEntity="SaisonFraisChambreLigne", mappedBy="entete")
     */
    protected $lignes;


    public function __construct()
    {
        $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set saison
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saison
     * @return SaisonFraisChambre
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

    /**
     * Set chambre
     *
     * @param \Back\HotelTunisieBundle\Entity\Chambre $chambre
     * @return SaisonFraisChambre
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

    /**
     * Add lignes
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonFraisChambreLigne $lignes
     * @return SaisonFraisChambre
     */
    public function addLigne(\Back\HotelTunisieBundle\Entity\SaisonFraisChambreLigne $lignes)
    {
        $this->lignes[] = $lignes;

        return $this;
    }

    /**
     * Remove lignes
     *
     * @param \Back\HotelTunisieBundle\Entity\SaisonFraisChambreLigne $lignes
     */
    public function removeLigne(\Back\HotelTunisieBundle\Entity\SaisonFraisChambreLigne $lignes)
    {
        $this->lignes->removeElement($lignes);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignes()
    {
        return $this->lignes;
    }

    /*
     * type = Adulte ou Enfant
     */
    public function getPrixAchat($nbrAdulte, $nbrEnfant,$arr, $type, $ordre)
    {
        $tarif = 'get' . $type . $ordre;
        foreach ($this->lignes as $ligne) {
            if ($ligne->getNombreAdulte() == $nbrAdulte && $ligne->getNombreEnfant() == $nbrEnfant && $ligne->getArrangement()->getId()==$arr)
                return $ligne->$tarif();
        }
        return 0;
    }


    /*
     * type = Adulte ou Enfant
     */
    public function getPrixVente($nbrAdulte, $nbrEnfant,$arr, $type, $ordre)
    {
        $tarif = 'get' . $type . $ordre;
        foreach ($this->lignes as $ligne) {
            if ($ligne->getNombreAdulte() == $nbrAdulte && $ligne->getNombreEnfant() == $nbrEnfant && $ligne->getArrangement()->getId()==$arr)
            {
                if($type=='Adulte')
                    return $ligne->$tarif() + $ligne->getMargeAdulte();
                else
                    return $ligne->$tarif() + $ligne->getMargeEnfant();
            }
        }
        return 0;
    }

    public function aPartirDe()
    {
        return 10;
    }
}
