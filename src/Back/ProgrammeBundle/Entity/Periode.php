<?php
    namespace Back\ProgrammeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * Periode
     *
     * @ORM\Table()
     * @ORM\Entity(repositoryClass="Back\ProgrammeBundle\Entity\Repository\PeriodeRepository")
     */
    class Periode
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
         * @var \DateTime
         *
         * @ORM\Column(name="depart", type="date")
         */
        private $depart;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="retour", type="date")
         */
        private $retour;

        /**
         * @var integer
         *
         * @ORM\Column(name="min", type="integer")
         */
        private $min;

        /**
         * @var integer
         *
         * @ORM\Column(name="max", type="integer")
         */
        private $max;

        /**
         * @var integer
         *
         * @ORM\Column(name="nombreInscription", type="integer")
         */
        private $nombreInscription;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="debutInscription", type="date")
         */
        private $debutInscription;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="finInscription", type="date")
         */
        private $finInscription;

        /**
         * @var integer
         *
         * @ORM\Column(name="nombreInscriptionInitiale", type="integer")
         */
        private $nombreInscriptionInitiale;

        /**
         * @var string
         *
         * @ORM\Column(name="prixAdulteAchat", type="decimal", precision=11 ,scale=3)
         */
        private $prixAdulteAchat;

        /**
         * @var string
         *
         * @ORM\Column(name="prixEnfantAchat", type="decimal", precision=11 ,scale=3)
         */
        private $prixEnfantAchat;

        /**
         * @var string
         *
         * @ORM\Column(name="prixAdulteVente", type="decimal", precision=11 ,scale=3)
         */
        private $prixAdulteVente;

        /**
         * @var string
         *
         * @ORM\Column(name="prixEnfantVente", type="decimal", precision=11 ,scale=3)
         */
        private $prixEnfantVente;

        /**
         * @ORM\ManyToOne(targetEntity="Programme", inversedBy="periodes")
         * @ORM\JoinColumn(onDelete="CASCADE")
         */
        private $programme;

        /**
         * @ORM\OneToMany(targetEntity="Ligne", mappedBy="periode", cascade={"remove"})
         * @ORM\OrderBy({"id" = "ASC"})
         */
        private $supplements;

        public function __construct()
        {
            $this->supplements = new \Doctrine\Common\Collections\ArrayCollection();
            $this->nombreInscription = 0;
            $this->nombreInscriptionInitiale = 0;
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
         * @return Periode
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
         * Set depart
         *
         * @param \DateTime $depart
         * @return Periode
         */
        public function setDepart($depart)
        {
            $this->depart = $depart;
            return $this;
        }

        /**
         * Get depart
         *
         * @return \DateTime
         */
        public function getDepart()
        {
            return $this->depart;
        }

        /**
         * Set retour
         *
         * @param \DateTime $retour
         * @return Periode
         */
        public function setRetour($retour)
        {
            $this->retour = $retour;
            return $this;
        }

        /**
         * Get retour
         *
         * @return \DateTime
         */
        public function getRetour()
        {
            return $this->retour;
        }

        /**
         * Set min
         *
         * @param integer $min
         * @return Periode
         */
        public function setMin($min)
        {
            $this->min = $min;
            return $this;
        }

        /**
         * Get min
         *
         * @return integer
         */
        public function getMin()
        {
            return $this->min;
        }

        /**
         * Set max
         *
         * @param integer $max
         * @return Periode
         */
        public function setMax($max)
        {
            $this->max = $max;
            return $this;
        }

        /**
         * Get max
         *
         * @return integer
         */
        public function getMax()
        {
            return $this->max;
        }

        /**
         * Set nombreInscription
         *
         * @param integer $nombreInscription
         * @return Periode
         */
        public function setNombreInscription($nombreInscription)
        {
            $this->nombreInscription = $nombreInscription;
            return $this;
        }

        /**
         * Get nombreInscription
         *
         * @return integer
         */
        public function getNombreInscription()
        {
            return $this->nombreInscription;
        }

        /**
         * Set debutInscription
         *
         * @param \DateTime $debutInscription
         * @return Periode
         */
        public function setDebutInscription($debutInscription)
        {
            $this->debutInscription = $debutInscription;
            return $this;
        }

        /**
         * Get debutInscription
         *
         * @return \DateTime
         */
        public function getDebutInscription()
        {
            return $this->debutInscription;
        }

        /**
         * Set finInscription
         *
         * @param \DateTime $finInscription
         * @return Periode
         */
        public function setFinInscription($finInscription)
        {
            $this->finInscription = $finInscription;
            return $this;
        }

        /**
         * Get finInscription
         *
         * @return \DateTime
         */
        public function getFinInscription()
        {
            return $this->finInscription;
        }

        /**
         * Set nombreInscriptionInitiale
         *
         * @param integer $nombreInscriptionInitiale
         * @return Periode
         */
        public function setNombreInscriptionInitiale($nombreInscriptionInitiale)
        {
            $this->nombreInscriptionInitiale = $nombreInscriptionInitiale;
            return $this;
        }

        /**
         * Get nombreInscriptionInitiale
         *
         * @return integer
         */
        public function getNombreInscriptionInitiale()
        {
            return $this->nombreInscriptionInitiale;
        }

        /**
         * Set programme
         *
         * @param \Back\ProgrammeBundle\Entity\Programme $programme
         * @return Periode
         */
        public function setProgramme(\Back\ProgrammeBundle\Entity\Programme $programme = NULL)
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

        public function __toString()
        {
            return $this->libelle;
        }

        /**
         * Remove supplements
         *
         * @param \Back\ProgrammeBundle\Entity\Ligne $supplements
         */
        public function removeSupplement(\Back\ProgrammeBundle\Entity\Ligne $supplements)
        {
            $this->supplements->removeElement($supplements);
        }

        /**
         * Get supplements
         *
         * @return \Doctrine\Common\Collections\Collection
         */
        public function getSupplements()
        {
            return $this->supplements;
        }

        /**
         * Set prixAdulteAchat
         *
         * @param string $prixAdulteAchat
         * @return Periode
         */
        public function setPrixAdulteAchat($prixAdulteAchat)
        {
            $this->prixAdulteAchat = $prixAdulteAchat;
            return $this;
        }

        /**
         * Get prixAdulteAchat
         *
         * @return string
         */
        public function getPrixAdulteAchat()
        {
            return $this->prixAdulteAchat;
        }

        /**
         * Set prixEnfantAchat
         *
         * @param string $prixEnfantAchat
         * @return Periode
         */
        public function setPrixEnfantAchat($prixEnfantAchat)
        {
            $this->prixEnfantAchat = $prixEnfantAchat;
            return $this;
        }

        /**
         * Get prixEnfantAchat
         *
         * @return string
         */
        public function getPrixEnfantAchat()
        {
            return $this->prixEnfantAchat;
        }

        /**
         * Set prixAdulteVente
         *
         * @param string $prixAdulteVente
         * @return Periode
         */
        public function setPrixAdulteVente($prixAdulteVente)
        {
            $this->prixAdulteVente = $prixAdulteVente;
            return $this;
        }

        /**
         * Get prixAdulteVente
         *
         * @return string
         */
        public function getPrixAdulteVente()
        {
            return $this->prixAdulteVente;
        }

        /**
         * Set prixEnfantVente
         *
         * @param string $prixEnfantVente
         * @return Periode
         */
        public function setPrixEnfantVente($prixEnfantVente)
        {
            $this->prixEnfantVente = $prixEnfantVente;
            return $this;
        }

        /**
         * Get prixEnfantVente
         *
         * @return string
         */
        public function getPrixEnfantVente()
        {
            return $this->prixEnfantVente;
        }

        /**
         * Add supplements
         *
         * @param \Back\ProgrammeBundle\Entity\Ligne $supplements
         * @return Periode
         */
        public function addSupplement(\Back\ProgrammeBundle\Entity\Ligne $supplements)
        {
            $this->supplements[] = $supplements;
            return $this;
        }

        public function isValide()
        {
            if($this->debutInscription()->format('Y-m-d') <= date('Y-m-d') && $this->finInscription()->format('Y-m-d') >= date('Y-m-d') &&  $this->nombreInscription() < $this->max())
                return TRUE;
            return FALSE;
        }
    }
