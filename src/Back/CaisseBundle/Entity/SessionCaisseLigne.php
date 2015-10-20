<?php

namespace Back\CaisseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionCaisseLigne
 *
 * @ORM\Table("ost_c_sessioncaisseligne")
 * @ORM\Entity(repositoryClass="Back\CaisseBundle\Entity\Repository\CaisseRepository")
 */
class SessionCaisseLigne
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLigne", type="datetime")
     */
    private $dateLigne;

    /**
     * @var string
     *
     * @ORM\Column(name="montantLigne", type="decimal", precision=11, scale=3)
     */
    private $montantLigne;

    /**
     * @var string
     *
     * @ORM\Column(name="refPiece", type="string", length=255, nullable=true)
     */
    private $refPiece;
    
    /**
     * @ORM\ManyToOne(targetEntity="SessionCaisse", inversedBy="lignes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $session;
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeLigneCaisse")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $type;


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
     * Set dateLigne
     *
     * @param \DateTime $dateLigne
     * @return SessionCaisseLigne
     */
    public function setDateLigne($dateLigne)
    {
        $this->dateLigne = $dateLigne;

        return $this;
    }

    /**
     * Get dateLigne
     *
     * @return \DateTime 
     */
    public function getDateLigne()
    {
        return $this->dateLigne;
    }

    /**
     * Set montantLigne
     *
     * @param string $montantLigne
     * @return SessionCaisseLigne
     */
    public function setMontantLigne($montantLigne)
    {
        $this->montantLigne = $montantLigne;

        return $this;
    }

    /**
     * Get montantLigne
     *
     * @return string 
     */
    public function getMontantLigne()
    {
        return $this->montantLigne;
    }

    /**
     * Set refPiece
     *
     * @param string $refPiece
     * @return SessionCaisseLigne
     */
    public function setRefPiece($refPiece)
    {
        $this->refPiece = $refPiece;

        return $this;
    }

    /**
     * Get refPiece
     *
     * @return string 
     */
    public function getRefPiece()
    {
        return $this->refPiece;
    }

    /**
     * Set session
     *
     * @param \Back\CaisseBundle\Entity\SessionCaisse $session
     * @return SessionCaisseLigne
     */
    public function setSession(\Back\CaisseBundle\Entity\SessionCaisse $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \Back\CaisseBundle\Entity\SessionCaisse 
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set type
     *
     * @param \Back\CaisseBundle\Entity\TypeLigneCaisse $type
     * @return SessionCaisseLigne
     */
    public function setType(\Back\CaisseBundle\Entity\TypeLigneCaisse $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Back\CaisseBundle\Entity\TypeLigneCaisse 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return SessionCaisseLigne
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
    
    public function isDebit()
    {
        if($this->getType()->getSensMouvement()=="D")
                return TRUE;
            return FALSE;
    }
    
    public function isCredit()
    {
        if($this->getType()->getSensMouvement()=="C")
                return TRUE;
            return FALSE;
    }
    
    public function getUser() 
    {
        return $this->getSession()->getUser();
    }
    
    public function isOpen() 
    {
        return $this->getSession()->isOpen();
    }
    
    public function __toString() 
    {
        return $this->libelle;
    }
}
