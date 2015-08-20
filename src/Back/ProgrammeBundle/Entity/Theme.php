<?php

namespace Back\ProgrammeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="ost_pr_themes")
 * @ORM\Entity
 */
class Theme
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
     * @ORM\ManyToMany(targetEntity="Programme", mappedBy="themes")
     **/
    private $programmes;

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
     * @return Theme
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

    public function __toString()
    {
	return $this->libelle;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->programmes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add programmes
     *
     * @param \Back\ProgrammeBundle\Entity\Programme $programmes
     * @return Theme
     */
    public function addProgramme(\Back\ProgrammeBundle\Entity\Programme $programmes)
    {
        $this->programmes[] = $programmes;

        return $this;
    }

    /**
     * Remove programmes
     *
     * @param \Back\ProgrammeBundle\Entity\Programme $programmes
     */
    public function removeProgramme(\Back\ProgrammeBundle\Entity\Programme $programmes)
    {
        $this->programmes->removeElement($programmes);
    }

    /**
     * Get programmes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgrammes()
    {
        return $this->programmes;
    }
}
