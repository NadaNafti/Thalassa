<?php

namespace Back\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Amicale
 *
 * @ORM\Table(name="ost_amicale")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt",timeAware=false)
 * @ORM\Entity
 */
class Amicale
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="plafond", type="decimal", precision=11, scale=3)
     */
    private $plafond;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", precision=11, scale=3)
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity="Back\UserBundle\Entity\Client", mappedBy="amicale")
     */
    protected $clients;
    
    /**
     * @ORM\OneToMany(targetEntity="Convention", mappedBy="amicale")
     * @ORM\OrderBy({"dateDebut" = "ASC"})
     */
    protected $conventions;

    /**
     * @ORM\ManyToMany(targetEntity="Produit")
     * @ORM\JoinTable(name="ost_amicale_produit",
     *      joinColumns={@ORM\JoinColumn(name="id_amicale", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_produit", referencedColumnName="id")}
     * )
     */
    protected $produits;
    
    /**
     * @ORM\ManyToMany(targetEntity="Back\HotelTunisieBundle\Entity\Hotel")
     * @ORM\JoinTable(name="ost_amicale_hotel",
     *      joinColumns={@ORM\JoinColumn(name="id_amicale", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_hotel", referencedColumnName="id")}
     * )
     */
    protected $hotels;

    /**
     * @Gedmo\slug(fields={"libelle"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

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
     * @ORM\Column( name="deletedAt",type="datetime",nullable=true)
     */
    private $deletedAt;

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
     * @return Amicale
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
     * Set adresse
     *
     * @param string $adresse
     * @return Amicale
     */
    public function setAdresse($adresse)
    {
        $this->adresse=$adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Amicale
     */
    public function setTel($tel)
    {
        $this->tel=$tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Amicale
     */
    public function setFax($fax)
    {
        $this->fax=$fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set plafond
     *
     * @param string $plafond
     * @return Amicale
     */
    public function setPlafond($plafond)
    {
        $this->plafond=$plafond;

        return $this;
    }

    /**
     * Get plafond
     *
     * @return string 
     */
    public function getPlafond()
    {
        return $this->plafond;
    }

    /**
     * Set montant
     *
     * @param string $montant
     * @return Amicale
     */
    public function setMontant($montant)
    {
        $this->montant=$montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Amicale
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
     * Set created
     *
     * @param \DateTime $created
     * @return Amicale
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
     * @return Amicale
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
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Amicale
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt=$deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->conventions=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add conventions
     *
     * @param \Back\AdministrationBundle\Entity\Convention $conventions
     * @return Amicale
     */
    public function addConvention(\Back\AdministrationBundle\Entity\Convention $conventions)
    {
        $this->conventions[]=$conventions;

        return $this;
    }

    /**
     * Remove conventions
     *
     * @param \Back\AdministrationBundle\Entity\Convention $conventions
     */
    public function removeConvention(\Back\AdministrationBundle\Entity\Convention $conventions)
    {
        $this->conventions->removeElement($conventions);
    }

    /**
     * Get conventions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConventions()
    {
        return $this->conventions;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function getConventionByDate($date)
    {
        $currentConvention=NULL;
        foreach($this->conventions as $convention)
        {
            if($convention->getDateDebut()->format('Y-m-d') <= $date && $convention->getDateFin()->format('Y-m-d') >= $date)
            {
                if(is_null($currentConvention))
                    $currentConvention=$convention;
                elseif($convention->getId() > $currentConvention->getId())
                    $currentConvention=$convention;
            }
        }
        return $currentConvention;
    }


    /**
     * Add produits
     *
     * @param \Back\AdministrationBundle\Entity\Produit $produits
     * @return Amicale
     */
    public function addProduit(\Back\AdministrationBundle\Entity\Produit $produits)
    {
        $this->produits[] = $produits;

        return $this;
    }

    /**
     * Remove produits
     *
     * @param \Back\AdministrationBundle\Entity\Produit $produits
     */
    public function removeProduit(\Back\AdministrationBundle\Entity\Produit $produits)
    {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Add hotels
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotels
     * @return Amicale
     */
    public function addHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotels)
    {
        $this->hotels[] = $hotels;

        return $this;
    }

    /**
     * Remove hotels
     *
     * @param \Back\HotelTunisieBundle\Entity\Hotel $hotels
     */
    public function removeHotel(\Back\HotelTunisieBundle\Entity\Hotel $hotels)
    {
        $this->hotels->removeElement($hotels);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * Add clients
     *
     * @param \Back\UserBundle\Entity\Client $clients
     * @return Amicale
     */
    public function addClient(\Back\UserBundle\Entity\Client $clients)
    {
        $this->clients[] = $clients;

        return $this;
    }

    /**
     * Remove clients
     *
     * @param \Back\UserBundle\Entity\Client $clients
     */
    public function removeClient(\Back\UserBundle\Entity\Client $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClients()
    {
        return $this->clients;
    }
}
