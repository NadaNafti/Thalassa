<?php

namespace Back\ProgrammeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description
 *
 * @ORM\Table(name="ost_pr_descriptions")
 * @ORM\Entity()
 */
class Description
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
     * @ORM\ManyToOne(targetEntity="Programme", inversedBy="descriptions")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $programme;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lateral", type="boolean")
     */
    private $lateral;
    
    public function __construct()
    {
        $this->lateral=FALSE;
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
     * Set libelle
     *
     * @param string $libelle
     * @return Description
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
     * Set texte
     *
     * @param string $texte
     * @return Description
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Description
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Description
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }
    
    public function showVisible()
    {
	if($this->visible)
	    return 'Oui';
	else
	    return 'Non';
    }

    /**
     * Set lateral
     *
     * @param boolean $lateral
     * @return Description
     */
    public function setLateral($lateral)
    {
        $this->lateral = $lateral;

        return $this;
    }

    /**
     * Get lateral
     *
     * @return boolean 
     */
    public function getLateral()
    {
        return $this->lateral;
    }

    /**
     * Set programme
     *
     * @param \Back\ProgrammeBundle\Entity\Programme $programme
     * @return Description
     */
    public function setProgramme(\Back\ProgrammeBundle\Entity\Programme $programme)
    {
        $this->programme = $programme;

        return $this;
    }

    /**
     * Get programme
     *
     * @return \Back\ProgrammeBundle\Entity\Programme 
     */
    public function getProgramme()
    {
        return $this->programme;
    }
}
