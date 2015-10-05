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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

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
     * @ORM\ManyToMany(targetEntity="Back\HotelTunisieBundle\Entity\Saison", mappedBy="amicales")
     */
    private $saisons;

    /**
     * @ORM\ManyToMany(targetEntity="Produit")
     * @ORM\JoinTable(name="ost_amicale_produit",
     *      joinColumns={@ORM\JoinColumn(name="id_amicale", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_produit", referencedColumnName="id")}
     * )
     */
    protected $produits;

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
     * Set adresse
     *
     * @param string $adresse
     * @return Amicale
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

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
        $this->tel = $tel;

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
        $this->fax = $fax;

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
        $this->plafond = $plafond;

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
        $this->montant = $montant;

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
        $this->slug = $slug;

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
     * @return Amicale
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
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Amicale
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

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
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function hasProduit($code)
    {
        foreach ($this->produits as $produit) {
            if ($produit->getCode() == $code)
                return true;
        }
        return false;
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


    /**
     * Add saisons
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saisons
     * @return Amicale
     */
    public function addSaison(\Back\HotelTunisieBundle\Entity\Saison $saisons)
    {
        $this->saisons[] = $saisons;

        return $this;
    }

    /**
     * Remove saisons
     *
     * @param \Back\HotelTunisieBundle\Entity\Saison $saisons
     */
    public function removeSaison(\Back\HotelTunisieBundle\Entity\Saison $saisons)
    {
        $this->saisons->removeElement($saisons);
    }

    /**
     * Get saisons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSaisons()
    {
        return $this->saisons;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Amicale
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    public function showType()
    {
        switch ($this->type) {
            case '1':
                return "Association";
            case '2' :
                return "Amicale";
            case '3' :
                return "Eétablissement public";
            case '4' :
                return "Fondation";
            case '4' :
                return "Société";
        }
    }

    public function countResponsable()
    {
        $count=0;
        foreach($this->clients as $client)
        {
            if($client->getResponsable())
                $count++;
        }
        return $count;
    }

    public function countEmploye()
    {
        $count=0;
        foreach($this->clients as $client)
        {
            if(!$client->getResponsable())
                $count++;
        }
        return $count;
    }
}
