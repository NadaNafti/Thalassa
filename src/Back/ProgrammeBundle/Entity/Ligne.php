<?php
    namespace Back\ProgrammeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * Ligne
     *
     * @ORM\Table(name="ost_pr_ligne")
     * @ORM\Entity()
     */
    class Ligne
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
         * @ORM\Column(name="adulteAchat", type="decimal", precision=11 ,scale=3)
         */
        private $adulteAchat;

        /**
         * @var string
         *
         * @ORM\Column(name="adulteVente", type="decimal", precision=11 ,scale=3)
         */
        private $adulteVente;

        /**
         * @var string
         *
         * @ORM\Column(name="enfantAchat", type="decimal", precision=11 ,scale=3, nullable=true)
         */
        private $enfantAchat;

        /**
         * @var string
         *
         * @ORM\Column(name="enfantVente", type="decimal", precision=11 ,scale=3, nullable=true)
         */
        private $enfantVente;

        /**
         * @var boolean
         *
         * @ORM\Column(name="obligatoire", type="boolean" , nullable=true)
         */
        private $obligatoire;

        /**
         * @ORM\ManyToOne(targetEntity="Periode", inversedBy="supplements")
         * @ORM\JoinColumn(onDelete="CASCADE")
         */
        protected $periode;

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->enfantAchat = 0;
            $this->enfantVente = 0;
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
         * @return Ligne
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
         * Set adulteAchat
         *
         * @param string $adulteAchat
         * @return Ligne
         */
        public function setAdulteAchat($adulteAchat)
        {
            $this->adulteAchat = $adulteAchat;
            return $this;
        }

        /**
         * Get adulteAchat
         *
         * @return string
         */
        public function getAdulteAchat()
        {
            return $this->adulteAchat;
        }

        /**
         * Set adulteVente
         *
         * @param string $adulteVente
         * @return Ligne
         */
        public function setAdulteVente($adulteVente)
        {
            $this->adulteVente = $adulteVente;
            return $this;
        }

        /**
         * Get adulteVente
         *
         * @return string
         */
        public function getAdulteVente()
        {
            return $this->adulteVente;
        }

        /**
         * Set enfantAchat
         *
         * @param string $enfantAchat
         * @return Ligne
         */
        public function setEnfantAchat($enfantAchat)
        {
            $this->enfantAchat = $enfantAchat;
            return $this;
        }

        /**
         * Get enfantAchat
         *
         * @return string
         */
        public function getEnfantAchat()
        {
            return $this->enfantAchat;
        }

        /**
         * Set enfantVente
         *
         * @param string $enfantVente
         * @return Ligne
         */
        public function setEnfantVente($enfantVente)
        {
            $this->enfantVente = $enfantVente;
            return $this;
        }

        /**
         * Get enfantVente
         *
         * @return string
         */
        public function getEnfantVente()
        {
            return $this->enfantVente;
        }

        /**
         * Set obligatoire
         *
         * @param boolean $obligatoire
         * @return Ligne
         */
        public function setObligatoire($obligatoire)
        {
            $this->obligatoire = $obligatoire;
            return $this;
        }

        /**
         * Get obligatoire
         *
         * @return boolean
         */
        public function getObligatoire()
        {
            return $this->obligatoire;
        }

        public function __toString()
        {
            return $this->libelle;
        }

        /**
         * Set periode
         *
         * @param \Back\ProgrammeBundle\Entity\Periode $periode
         * @return Ligne
         */
        public function setPeriode(\Back\ProgrammeBundle\Entity\Periode $periode = NULL)
        {
            $this->periode = $periode;
            return $this;
        }

        /**
         * Get periode
         *
         * @return \Back\ProgrammeBundle\Entity\Periode
         */
        public function getPeriode()
        {
            return $this->periode;
        }
    }
