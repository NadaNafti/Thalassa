<?php

namespace Back\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Email
 *
 * @ORM\Table(name="ost_emails")
 * @ORM\Entity(repositoryClass="Back\AdministrationBundle\Entity\EmailRepository")
 */
class Email
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
     * @Assert\Email(
     *     message = "'{{ value }}' n'est pas un email valide.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="emails")
     * @ORM\JoinTable(name="ost_emails_produits")
     */
    protected $produits;

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
     * Set email
     *
     * @param string $email
     * @return Email
     */
    public function setEmail($email)
    {
        $this->email=$email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produits
     *
     * @param \Back\AdministrationBundle\Entity\Produit $produits
     * @return Email
     */
    public function addProduit(\Back\AdministrationBundle\Entity\Produit $produits)
    {
        $this->produits[]=$produits;

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

}
