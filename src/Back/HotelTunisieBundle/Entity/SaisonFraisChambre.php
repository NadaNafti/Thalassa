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
         * @var string
         *
         * @ORM\Column(name="valeur1Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur1Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge1Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge1Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc1Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc1Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf1Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf1Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf1Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf1Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf1Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf1Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf1Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf1Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur2Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur2Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge2Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge2Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc2Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc2Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf2Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf2Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf2Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf2Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf2Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf2Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf2Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf2Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur3Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur3Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge3Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge3Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc3Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc3Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf3Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf3Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf3Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf3Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf3Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf3Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf3Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf3Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur4Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur4Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge4Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge4Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc4Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc4Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf4Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf4Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf4Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf4Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf4Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf4Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf4Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf4Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur5Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur5Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge5Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge5Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc5Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc5Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf5Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf5Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf5Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf5Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf5Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf5Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf5Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf5Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur6Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur6Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge6Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge6Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc6Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc6Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf6Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf6Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf6Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf6Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf6Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf6Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf6Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf6Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur7Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur7Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge7Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge7Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc7Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc7Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf7Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf7Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf7Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf7Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf7Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf7Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf7Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf7Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur8Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur8Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge8Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge8Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc8Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc8Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf8Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf8Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf8Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf8Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf8Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf8Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf8Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf8Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur9Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur9Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge9Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge9Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc9Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc9Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf9Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf9Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf9Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf9Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf9Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf9Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf9Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf9Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="valeur10Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $valeur10Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="marge10Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $marge10Adulte;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourc10Adulte", type="boolean" ,nullable=true)
         */
        private $margePourc10Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction1Enf10Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction1Enf10Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reduction2Enf10Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reduction2Enf10Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr1Enf10Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr1Enf10Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="reductionArr2Enf10Adulte", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $reductionArr2Enf10Adulte;

        /**
         * @var string
         *
         * @ORM\Column(name="suppSingle", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $suppSingle;

        /**
         * @var string
         *
         * @ORM\Column(name="margeSuppSingle", type="decimal", precision=11, scale=3,nullable=true)
         */
        private $margeSuppSingle;

        /**
         * @var boolean
         *
         * @ORM\Column(name="margePourcSuppSingle", type="boolean" ,nullable=true)
         */
        private $margePourcSuppSingle;

        /**
         * @var boolean
         *
         * @ORM\Column(name="suppSingle1Enf", type="boolean" ,nullable=true)
         */
        private $suppSingle1Enf;

        /**
         * @var boolean
         *
         * @ORM\Column(name="suppSingle2Enf", type="boolean" ,nullable=true)
         */
        private $suppSingle2Enf;

        public function __construct()
        {
            $this->valeur1Adulte = 0;
            $this->marge1Adulte = 0;
            $this->margePourc1Adulte = 0;
            $this->reduction1Enf1Adulte = 0;
            $this->reduction2Enf1Adulte = 0;
            $this->valeur2Adulte = 0;
            $this->marge2Adulte = 0;
            $this->margePourc2Adulte = 0;
            $this->reduction1Enf2Adulte = 0;
            $this->reduction2Enf2Adulte = 0;
            $this->valeur3Adulte = 0;
            $this->marge3Adulte = 0;
            $this->margePourc3Adulte = 0;
            $this->reduction1Enf3Adulte = 0;
            $this->reduction2Enf3Adulte = 0;
            $this->valeur4Adulte = 0;
            $this->marge4Adulte = 0;
            $this->margePourc4Adulte = 0;
            $this->reduction1Enf4Adulte = 0;
            $this->reduction2Enf4Adulte = 0;
            $this->valeur5Adulte = 0;
            $this->marge5Adulte = 0;
            $this->margePourc5Adulte = 0;
            $this->reduction1Enf5Adulte = 0;
            $this->reduction2Enf5Adulte = 0;
            $this->valeur6Adulte = 0;
            $this->marge6Adulte = 0;
            $this->margePourc6Adulte = 0;
            $this->reduction1Enf6Adulte = 0;
            $this->reduction2Enf6Adulte = 0;
            $this->valeur7Adulte = 0;
            $this->marge7Adulte = 0;
            $this->margePourc7Adulte = 0;
            $this->reduction1Enf7Adulte = 0;
            $this->reduction2Enf7Adulte = 0;
            $this->valeur8Adulte = 0;
            $this->marge8Adulte = 0;
            $this->margePourc8Adulte = 0;
            $this->reduction1Enf8Adulte = 0;
            $this->reduction2Enf8Adulte = 0;
            $this->valeur8Adulte = 0;
            $this->marge8Adulte = 0;
            $this->margePourc8Adulte = 0;
            $this->reduction1Enf8Adulte = 0;
            $this->reduction2Enf8Adulte = 0;
            $this->valeur9Adulte = 0;
            $this->marge9Adulte = 0;
            $this->margePourc9Adulte = 0;
            $this->reduction1Enf9Adulte = 0;
            $this->reduction2Enf9Adulte = 0;
            $this->valeur10Adulte = 0;
            $this->marge10Adulte = 0;
            $this->margePourc10Adulte = 0;
            $this->reduction1Enf10Adulte = 0;
            $this->reduction2Enf10Adulte = 0;
            $this->suppSingle = 0;
            $this->margeSuppSingle = 0;
            $this->margePourcSuppSingle = 0;
            $this->suppSingle1Enf = 1;
            $this->suppSingle2Enf = 1;
            $this->reductionArr1Enf1Adulte = 0;
            $this->reductionArr2Enf1Adulte = 0;
            $this->reductionArr1Enf2Adulte = 0;
            $this->reductionArr2Enf2Adulte = 0;
            $this->reductionArr1Enf3Adulte = 0;
            $this->reductionArr2Enf3Adulte = 0;
            $this->reductionArr1Enf4Adulte = 0;
            $this->reductionArr2Enf4Adulte = 0;
            $this->reductionArr1Enf5Adulte = 0;
            $this->reductionArr2Enf5Adulte = 0;
            $this->reductionArr1Enf6Adulte = 0;
            $this->reductionArr2Enf6Adulte = 0;
            $this->reductionArr1Enf7Adulte = 0;
            $this->reductionArr2Enf7Adulte = 0;
            $this->reductionArr1Enf8Adulte = 0;
            $this->reductionArr2Enf8Adulte = 0;
            $this->reductionArr1Enf9Adulte = 0;
            $this->reductionArr2Enf9Adulte = 0;
            $this->reductionArr1Enf10Adulte = 0;
            $this->reductionArr2Enf10Adulte = 0;
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
         * Set valeur1Adulte
         *
         * @param string $valeur1Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur1Adulte($valeur1Adulte)
        {
            $this->valeur1Adulte = $valeur1Adulte;
            return $this;
        }

        /**
         * Get valeur1Adulte
         *
         * @return string
         */
        public function getValeur1Adulte()
        {
            return $this->valeur1Adulte;
        }

        /**
         * Set marge1Adulte
         *
         * @param string $marge1Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge1Adulte($marge1Adulte)
        {
            $this->marge1Adulte = $marge1Adulte;
            return $this;
        }

        /**
         * Get marge1Adulte
         *
         * @return string
         */
        public function getMarge1Adulte()
        {
            return $this->marge1Adulte;
        }

        /**
         * Set margePourc1Adulte
         *
         * @param boolean $margePourc1Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc1Adulte($margePourc1Adulte)
        {
            $this->margePourc1Adulte = $margePourc1Adulte;
            return $this;
        }

        /**
         * Get margePourc1Adulte
         *
         * @return boolean
         */
        public function getMargePourc1Adulte()
        {
            return $this->margePourc1Adulte;
        }

        /**
         * Set reduction1Enf1Adulte
         *
         * @param string $reduction1Enf1Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf1Adulte($reduction1Enf1Adulte)
        {
            $this->reduction1Enf1Adulte = $reduction1Enf1Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf1Adulte
         *
         * @return string
         */
        public function getReduction1Enf1Adulte()
        {
            return $this->reduction1Enf1Adulte;
        }

        /**
         * Set reduction2Enf1Adulte
         *
         * @param string $reduction2Enf1Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf1Adulte($reduction2Enf1Adulte)
        {
            $this->reduction2Enf1Adulte = $reduction2Enf1Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf1Adulte
         *
         * @return string
         */
        public function getReduction2Enf1Adulte()
        {
            return $this->reduction2Enf1Adulte;
        }

        /**
         * Set valeur2Adulte
         *
         * @param string $valeur2Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur2Adulte($valeur2Adulte)
        {
            $this->valeur2Adulte = $valeur2Adulte;
            return $this;
        }

        /**
         * Get valeur2Adulte
         *
         * @return string
         */
        public function getValeur2Adulte()
        {
            return $this->valeur2Adulte;
        }

        /**
         * Set marge2Adulte
         *
         * @param string $marge2Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge2Adulte($marge2Adulte)
        {
            $this->marge2Adulte = $marge2Adulte;
            return $this;
        }

        /**
         * Get marge2Adulte
         *
         * @return string
         */
        public function getMarge2Adulte()
        {
            return $this->marge2Adulte;
        }

        /**
         * Set margePourc2Adulte
         *
         * @param boolean $margePourc2Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc2Adulte($margePourc2Adulte)
        {
            $this->margePourc2Adulte = $margePourc2Adulte;
            return $this;
        }

        /**
         * Get margePourc2Adulte
         *
         * @return boolean
         */
        public function getMargePourc2Adulte()
        {
            return $this->margePourc2Adulte;
        }

        /**
         * Set reduction1Enf2Adulte
         *
         * @param string $reduction1Enf2Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf2Adulte($reduction1Enf2Adulte)
        {
            $this->reduction1Enf2Adulte = $reduction1Enf2Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf2Adulte
         *
         * @return string
         */
        public function getReduction1Enf2Adulte()
        {
            return $this->reduction1Enf2Adulte;
        }

        /**
         * Set reduction2Enf2Adulte
         *
         * @param string $reduction2Enf2Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf2Adulte($reduction2Enf2Adulte)
        {
            $this->reduction2Enf2Adulte = $reduction2Enf2Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf2Adulte
         *
         * @return string
         */
        public function getReduction2Enf2Adulte()
        {
            return $this->reduction2Enf2Adulte;
        }

        /**
         * Set valeur3Adulte
         *
         * @param string $valeur3Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur3Adulte($valeur3Adulte)
        {
            $this->valeur3Adulte = $valeur3Adulte;
            return $this;
        }

        /**
         * Get valeur3Adulte
         *
         * @return string
         */
        public function getValeur3Adulte()
        {
            return $this->valeur3Adulte;
        }

        /**
         * Set marge3Adulte
         *
         * @param string $marge3Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge3Adulte($marge3Adulte)
        {
            $this->marge3Adulte = $marge3Adulte;
            return $this;
        }

        /**
         * Get marge3Adulte
         *
         * @return string
         */
        public function getMarge3Adulte()
        {
            return $this->marge3Adulte;
        }

        /**
         * Set margePourc3Adulte
         *
         * @param boolean $margePourc3Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc3Adulte($margePourc3Adulte)
        {
            $this->margePourc3Adulte = $margePourc3Adulte;
            return $this;
        }

        /**
         * Get margePourc3Adulte
         *
         * @return boolean
         */
        public function getMargePourc3Adulte()
        {
            return $this->margePourc3Adulte;
        }

        /**
         * Set reduction1Enf3Adulte
         *
         * @param string $reduction1Enf3Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf3Adulte($reduction1Enf3Adulte)
        {
            $this->reduction1Enf3Adulte = $reduction1Enf3Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf3Adulte
         *
         * @return string
         */
        public function getReduction1Enf3Adulte()
        {
            return $this->reduction1Enf3Adulte;
        }

        /**
         * Set reduction2Enf3Adulte
         *
         * @param string $reduction2Enf3Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf3Adulte($reduction2Enf3Adulte)
        {
            $this->reduction2Enf3Adulte = $reduction2Enf3Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf3Adulte
         *
         * @return string
         */
        public function getReduction2Enf3Adulte()
        {
            return $this->reduction2Enf3Adulte;
        }

        /**
         * Set valeur4Adulte
         *
         * @param string $valeur4Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur4Adulte($valeur4Adulte)
        {
            $this->valeur4Adulte = $valeur4Adulte;
            return $this;
        }

        /**
         * Get valeur4Adulte
         *
         * @return string
         */
        public function getValeur4Adulte()
        {
            return $this->valeur4Adulte;
        }

        /**
         * Set marge4Adulte
         *
         * @param string $marge4Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge4Adulte($marge4Adulte)
        {
            $this->marge4Adulte = $marge4Adulte;
            return $this;
        }

        /**
         * Get marge4Adulte
         *
         * @return string
         */
        public function getMarge4Adulte()
        {
            return $this->marge4Adulte;
        }

        /**
         * Set margePourc4Adulte
         *
         * @param boolean $margePourc4Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc4Adulte($margePourc4Adulte)
        {
            $this->margePourc4Adulte = $margePourc4Adulte;
            return $this;
        }

        /**
         * Get margePourc4Adulte
         *
         * @return boolean
         */
        public function getMargePourc4Adulte()
        {
            return $this->margePourc4Adulte;
        }

        /**
         * Set reduction1Enf4Adulte
         *
         * @param string $reduction1Enf4Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf4Adulte($reduction1Enf4Adulte)
        {
            $this->reduction1Enf4Adulte = $reduction1Enf4Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf4Adulte
         *
         * @return string
         */
        public function getReduction1Enf4Adulte()
        {
            return $this->reduction1Enf4Adulte;
        }

        /**
         * Set reduction2Enf4Adulte
         *
         * @param string $reduction2Enf4Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf4Adulte($reduction2Enf4Adulte)
        {
            $this->reduction2Enf4Adulte = $reduction2Enf4Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf4Adulte
         *
         * @return string
         */
        public function getReduction2Enf4Adulte()
        {
            return $this->reduction2Enf4Adulte;
        }

        /**
         * Set valeur5Adulte
         *
         * @param string $valeur5Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur5Adulte($valeur5Adulte)
        {
            $this->valeur5Adulte = $valeur5Adulte;
            return $this;
        }

        /**
         * Get valeur5Adulte
         *
         * @return string
         */
        public function getValeur5Adulte()
        {
            return $this->valeur5Adulte;
        }

        /**
         * Set marge5Adulte
         *
         * @param string $marge5Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge5Adulte($marge5Adulte)
        {
            $this->marge5Adulte = $marge5Adulte;
            return $this;
        }

        /**
         * Get marge5Adulte
         *
         * @return string
         */
        public function getMarge5Adulte()
        {
            return $this->marge5Adulte;
        }

        /**
         * Set margePourc5Adulte
         *
         * @param boolean $margePourc5Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc5Adulte($margePourc5Adulte)
        {
            $this->margePourc5Adulte = $margePourc5Adulte;
            return $this;
        }

        /**
         * Get margePourc5Adulte
         *
         * @return boolean
         */
        public function getMargePourc5Adulte()
        {
            return $this->margePourc5Adulte;
        }

        /**
         * Set reduction1Enf5Adulte
         *
         * @param string $reduction1Enf5Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf5Adulte($reduction1Enf5Adulte)
        {
            $this->reduction1Enf5Adulte = $reduction1Enf5Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf5Adulte
         *
         * @return string
         */
        public function getReduction1Enf5Adulte()
        {
            return $this->reduction1Enf5Adulte;
        }

        /**
         * Set reduction2Enf5Adulte
         *
         * @param string $reduction2Enf5Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf5Adulte($reduction2Enf5Adulte)
        {
            $this->reduction2Enf5Adulte = $reduction2Enf5Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf5Adulte
         *
         * @return string
         */
        public function getReduction2Enf5Adulte()
        {
            return $this->reduction2Enf5Adulte;
        }

        /**
         * Set valeur6Adulte
         *
         * @param string $valeur6Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur6Adulte($valeur6Adulte)
        {
            $this->valeur6Adulte = $valeur6Adulte;
            return $this;
        }

        /**
         * Get valeur6Adulte
         *
         * @return string
         */
        public function getValeur6Adulte()
        {
            return $this->valeur6Adulte;
        }

        /**
         * Set marge6Adulte
         *
         * @param string $marge6Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge6Adulte($marge6Adulte)
        {
            $this->marge6Adulte = $marge6Adulte;
            return $this;
        }

        /**
         * Get marge6Adulte
         *
         * @return string
         */
        public function getMarge6Adulte()
        {
            return $this->marge6Adulte;
        }

        /**
         * Set margePourc6Adulte
         *
         * @param boolean $margePourc6Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc6Adulte($margePourc6Adulte)
        {
            $this->margePourc6Adulte = $margePourc6Adulte;
            return $this;
        }

        /**
         * Get margePourc6Adulte
         *
         * @return boolean
         */
        public function getMargePourc6Adulte()
        {
            return $this->margePourc6Adulte;
        }

        /**
         * Set reduction1Enf6Adulte
         *
         * @param string $reduction1Enf6Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf6Adulte($reduction1Enf6Adulte)
        {
            $this->reduction1Enf6Adulte = $reduction1Enf6Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf6Adulte
         *
         * @return string
         */
        public function getReduction1Enf6Adulte()
        {
            return $this->reduction1Enf6Adulte;
        }

        /**
         * Set reduction2Enf6Adulte
         *
         * @param string $reduction2Enf6Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf6Adulte($reduction2Enf6Adulte)
        {
            $this->reduction2Enf6Adulte = $reduction2Enf6Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf6Adulte
         *
         * @return string
         */
        public function getReduction2Enf6Adulte()
        {
            return $this->reduction2Enf6Adulte;
        }

        /**
         * Set valeur7Adulte
         *
         * @param string $valeur7Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur7Adulte($valeur7Adulte)
        {
            $this->valeur7Adulte = $valeur7Adulte;
            return $this;
        }

        /**
         * Get valeur7Adulte
         *
         * @return string
         */
        public function getValeur7Adulte()
        {
            return $this->valeur7Adulte;
        }

        /**
         * Set marge7Adulte
         *
         * @param string $marge7Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge7Adulte($marge7Adulte)
        {
            $this->marge7Adulte = $marge7Adulte;
            return $this;
        }

        /**
         * Get marge7Adulte
         *
         * @return string
         */
        public function getMarge7Adulte()
        {
            return $this->marge7Adulte;
        }

        /**
         * Set margePourc7Adulte
         *
         * @param boolean $margePourc7Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc7Adulte($margePourc7Adulte)
        {
            $this->margePourc7Adulte = $margePourc7Adulte;
            return $this;
        }

        /**
         * Get margePourc7Adulte
         *
         * @return boolean
         */
        public function getMargePourc7Adulte()
        {
            return $this->margePourc7Adulte;
        }

        /**
         * Set reduction1Enf7Adulte
         *
         * @param string $reduction1Enf7Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf7Adulte($reduction1Enf7Adulte)
        {
            $this->reduction1Enf7Adulte = $reduction1Enf7Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf7Adulte
         *
         * @return string
         */
        public function getReduction1Enf7Adulte()
        {
            return $this->reduction1Enf7Adulte;
        }

        /**
         * Set reduction2Enf7Adulte
         *
         * @param string $reduction2Enf7Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf7Adulte($reduction2Enf7Adulte)
        {
            $this->reduction2Enf7Adulte = $reduction2Enf7Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf7Adulte
         *
         * @return string
         */
        public function getReduction2Enf7Adulte()
        {
            return $this->reduction2Enf7Adulte;
        }

        /**
         * Set valeur8Adulte
         *
         * @param string $valeur8Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur8Adulte($valeur8Adulte)
        {
            $this->valeur8Adulte = $valeur8Adulte;
            return $this;
        }

        /**
         * Get valeur8Adulte
         *
         * @return string
         */
        public function getValeur8Adulte()
        {
            return $this->valeur8Adulte;
        }

        /**
         * Set marge8Adulte
         *
         * @param string $marge8Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge8Adulte($marge8Adulte)
        {
            $this->marge8Adulte = $marge8Adulte;
            return $this;
        }

        /**
         * Get marge8Adulte
         *
         * @return string
         */
        public function getMarge8Adulte()
        {
            return $this->marge8Adulte;
        }

        /**
         * Set margePourc8Adulte
         *
         * @param boolean $margePourc8Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc8Adulte($margePourc8Adulte)
        {
            $this->margePourc8Adulte = $margePourc8Adulte;
            return $this;
        }

        /**
         * Get margePourc8Adulte
         *
         * @return boolean
         */
        public function getMargePourc8Adulte()
        {
            return $this->margePourc8Adulte;
        }

        /**
         * Set reduction1Enf8Adulte
         *
         * @param string $reduction1Enf8Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf8Adulte($reduction1Enf8Adulte)
        {
            $this->reduction1Enf8Adulte = $reduction1Enf8Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf8Adulte
         *
         * @return string
         */
        public function getReduction1Enf8Adulte()
        {
            return $this->reduction1Enf8Adulte;
        }

        /**
         * Set reduction2Enf8Adulte
         *
         * @param string $reduction2Enf8Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf8Adulte($reduction2Enf8Adulte)
        {
            $this->reduction2Enf8Adulte = $reduction2Enf8Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf8Adulte
         *
         * @return string
         */
        public function getReduction2Enf8Adulte()
        {
            return $this->reduction2Enf8Adulte;
        }

        /**
         * Set valeur9Adulte
         *
         * @param string $valeur9Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur9Adulte($valeur9Adulte)
        {
            $this->valeur9Adulte = $valeur9Adulte;
            return $this;
        }

        /**
         * Get valeur9Adulte
         *
         * @return string
         */
        public function getValeur9Adulte()
        {
            return $this->valeur9Adulte;
        }

        /**
         * Set marge9Adulte
         *
         * @param string $marge9Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge9Adulte($marge9Adulte)
        {
            $this->marge9Adulte = $marge9Adulte;
            return $this;
        }

        /**
         * Get marge9Adulte
         *
         * @return string
         */
        public function getMarge9Adulte()
        {
            return $this->marge9Adulte;
        }

        /**
         * Set margePourc9Adulte
         *
         * @param boolean $margePourc9Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc9Adulte($margePourc9Adulte)
        {
            $this->margePourc9Adulte = $margePourc9Adulte;
            return $this;
        }

        /**
         * Get margePourc9Adulte
         *
         * @return boolean
         */
        public function getMargePourc9Adulte()
        {
            return $this->margePourc9Adulte;
        }

        /**
         * Set reduction1Enf9Adulte
         *
         * @param string $reduction1Enf9Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf9Adulte($reduction1Enf9Adulte)
        {
            $this->reduction1Enf9Adulte = $reduction1Enf9Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf9Adulte
         *
         * @return string
         */
        public function getReduction1Enf9Adulte()
        {
            return $this->reduction1Enf9Adulte;
        }

        /**
         * Set reduction2Enf9Adulte
         *
         * @param string $reduction2Enf9Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf9Adulte($reduction2Enf9Adulte)
        {
            $this->reduction2Enf9Adulte = $reduction2Enf9Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf9Adulte
         *
         * @return string
         */
        public function getReduction2Enf9Adulte()
        {
            return $this->reduction2Enf9Adulte;
        }

        /**
         * Set valeur10Adulte
         *
         * @param string $valeur10Adulte
         * @return SaisonFraisChambre
         */
        public function setValeur10Adulte($valeur10Adulte)
        {
            $this->valeur10Adulte = $valeur10Adulte;
            return $this;
        }

        /**
         * Get valeur10Adulte
         *
         * @return string
         */
        public function getValeur10Adulte()
        {
            return $this->valeur10Adulte;
        }

        /**
         * Set marge10Adulte
         *
         * @param string $marge10Adulte
         * @return SaisonFraisChambre
         */
        public function setMarge10Adulte($marge10Adulte)
        {
            $this->marge10Adulte = $marge10Adulte;
            return $this;
        }

        /**
         * Get marge10Adulte
         *
         * @return string
         */
        public function getMarge10Adulte()
        {
            return $this->marge10Adulte;
        }

        /**
         * Set margePourc10Adulte
         *
         * @param boolean $margePourc10Adulte
         * @return SaisonFraisChambre
         */
        public function setMargePourc10Adulte($margePourc10Adulte)
        {
            $this->margePourc10Adulte = $margePourc10Adulte;
            return $this;
        }

        /**
         * Get margePourc10Adulte
         *
         * @return boolean
         */
        public function getMargePourc10Adulte()
        {
            return $this->margePourc10Adulte;
        }

        /**
         * Set reduction1Enf10Adulte
         *
         * @param string $reduction1Enf10Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction1Enf10Adulte($reduction1Enf10Adulte)
        {
            $this->reduction1Enf10Adulte = $reduction1Enf10Adulte;
            return $this;
        }

        /**
         * Get reduction1Enf10Adulte
         *
         * @return string
         */
        public function getReduction1Enf10Adulte()
        {
            return $this->reduction1Enf10Adulte;
        }

        /**
         * Set reduction2Enf10Adulte
         *
         * @param string $reduction2Enf10Adulte
         * @return SaisonFraisChambre
         */
        public function setReduction2Enf10Adulte($reduction2Enf10Adulte)
        {
            $this->reduction2Enf10Adulte = $reduction2Enf10Adulte;
            return $this;
        }

        /**
         * Get reduction2Enf10Adulte
         *
         * @return string
         */
        public function getReduction2Enf10Adulte()
        {
            return $this->reduction2Enf10Adulte;
        }

        /**
         * Set suppSingle
         *
         * @param string $suppSingle
         * @return SaisonFraisChambre
         */
        public function setSuppSingle($suppSingle)
        {
            $this->suppSingle = $suppSingle;
            return $this;
        }

        /**
         * Get suppSingle
         *
         * @return string
         */
        public function getSuppSingle()
        {
            return $this->suppSingle;
        }

        /**
         * Set suppSingle1Enf
         *
         * @param boolean $suppSingle1Enf
         * @return SaisonFraisChambre
         */
        public function setSuppSingle1Enf($suppSingle1Enf)
        {
            $this->suppSingle1Enf = $suppSingle1Enf;
            return $this;
        }

        /**
         * Get suppSingle1Enf
         *
         * @return boolean
         */
        public function getSuppSingle1Enf()
        {
            return $this->suppSingle1Enf;
        }

        /**
         * Set suppSingle2Enf
         *
         * @param boolean $suppSingle2Enf
         * @return SaisonFraisChambre
         */
        public function setSuppSingle2Enf($suppSingle2Enf)
        {
            $this->suppSingle2Enf = $suppSingle2Enf;
            return $this;
        }

        /**
         * Get suppSingle2Enf
         *
         * @return boolean
         */
        public function getSuppSingle2Enf()
        {
            return $this->suppSingle2Enf;
        }

        /**
         * Set saison
         *
         * @param \Back\HotelTunisieBundle\Entity\Saison $saison
         * @return SaisonFraisChambre
         */
        public function setSaison(\Back\HotelTunisieBundle\Entity\Saison $saison = NULL)
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
        public function setChambre(\Back\HotelTunisieBundle\Entity\Chambre $chambre = NULL)
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

        public function getAchatAdultes($nbrAdulte)
        {
            $valeurFunction = 'getValeur' . $nbrAdulte . 'Adulte';
            return $this->$valeurFunction();
        }

        public function getVenteAdultes($nbrAdulte)
        {
            $valeurFunction = 'getValeur' . $nbrAdulte . 'Adulte';
            $margeFunction = 'getMarge' . $nbrAdulte . 'Adulte';
            $margePourFunction = 'getMargePourc' . $nbrAdulte . 'Adulte';
            if($this->$margePourFunction())
                return $this->$valeurFunction() / 100 * $this->$margeFunction() + $this->$valeurFunction();
            else
                return $this->$valeurFunction() + $this->$margeFunction();
        }

        public function getVenteEnfant($nbrAdulte,$ordre)
        {
            $reduc1Enfant = 'getReduction1Enf' . $nbrAdulte . 'Adulte';
            $reduc2Enfant = 'getReduction2Enf' . $nbrAdulte . 'Adulte';
            if($ordre == 1)
                return $this->$reduc1Enfant();
            else
                return $this->$reduc2Enfant();
        }

        public function getReducArr($nbrAdulte,$ordre)
        {
            $reduc1Enfant = 'getReductionArr1Enf' . $nbrAdulte . 'Adulte';
            $reduc2Enfant = 'getReductionArr2Enf' . $nbrAdulte . 'Adulte';
            if($ordre == 1)
                return $this->$reduc1Enfant();
            else
                return $this->$reduc2Enfant();
        }

        public function hasSuppSingle($nbrAdultes,$nbrEnfants)
        {
            if($nbrAdultes == 1){
                if($nbrEnfants == 0)
                    return TRUE;
                if($nbrEnfants == 1 && $this->suppSingle1Enf == 1)
                    return TRUE;
                if($nbrEnfants > 1 && $this->suppSingle2Enf == 1)
                    return TRUE;
            }
            return FALSE;
        }

        public function getAchatSuppSingle()
        {
            return $this->suppSingle;
        }

        public function getVenteSuppSingle()
        {
            if($this->margePourcSuppSingle == 1)
                return $this->suppSingle / 100 * $this->margeSuppSingle + $this->suppSingle;
            else
                return $this->suppSingle + $this->margeSuppSingle;
        }

        /**
         * Set margeSuppSingle
         *
         * @param string $margeSuppSingle
         * @return SaisonFraisChambre
         */
        public function setMargeSuppSingle($margeSuppSingle)
        {
            $this->margeSuppSingle = $margeSuppSingle;
            return $this;
        }

        /**
         * Get margeSuppSingle
         *
         * @return string
         */
        public function getMargeSuppSingle()
        {
            return $this->margeSuppSingle;
        }

        /**
         * Set margePourcSuppSingle
         *
         * @param boolean $margePourcSuppSingle
         * @return SaisonFraisChambre
         */
        public function setMargePourcSuppSingle($margePourcSuppSingle)
        {
            $this->margePourcSuppSingle = $margePourcSuppSingle;
            return $this;
        }

        /**
         * Get margePourcSuppSingle
         *
         * @return boolean
         */
        public function getMargePourcSuppSingle()
        {
            return $this->margePourcSuppSingle;
        }

        /**
         * Set reductionArr1Enf1Adulte
         *
         * @param string $reductionArr1Enf1Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf1Adulte($reductionArr1Enf1Adulte)
        {
            $this->reductionArr1Enf1Adulte = $reductionArr1Enf1Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf1Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf1Adulte()
        {
            return $this->reductionArr1Enf1Adulte;
        }

        /**
         * Set reductionArr2Enf1Adulte
         *
         * @param string $reductionArr2Enf1Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf1Adulte($reductionArr2Enf1Adulte)
        {
            $this->reductionArr2Enf1Adulte = $reductionArr2Enf1Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf1Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf1Adulte()
        {
            return $this->reductionArr2Enf1Adulte;
        }

        /**
         * Set reductionArr1Enf2Adulte
         *
         * @param string $reductionArr1Enf2Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf2Adulte($reductionArr1Enf2Adulte)
        {
            $this->reductionArr1Enf2Adulte = $reductionArr1Enf2Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf2Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf2Adulte()
        {
            return $this->reductionArr1Enf2Adulte;
        }

        /**
         * Set reductionArr2Enf2Adulte
         *
         * @param string $reductionArr2Enf2Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf2Adulte($reductionArr2Enf2Adulte)
        {
            $this->reductionArr2Enf2Adulte = $reductionArr2Enf2Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf2Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf2Adulte()
        {
            return $this->reductionArr2Enf2Adulte;
        }

        /**
         * Set reductionArr1Enf3Adulte
         *
         * @param string $reductionArr1Enf3Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf3Adulte($reductionArr1Enf3Adulte)
        {
            $this->reductionArr1Enf3Adulte = $reductionArr1Enf3Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf3Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf3Adulte()
        {
            return $this->reductionArr1Enf3Adulte;
        }

        /**
         * Set reductionArr2Enf3Adulte
         *
         * @param string $reductionArr2Enf3Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf3Adulte($reductionArr2Enf3Adulte)
        {
            $this->reductionArr2Enf3Adulte = $reductionArr2Enf3Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf3Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf3Adulte()
        {
            return $this->reductionArr2Enf3Adulte;
        }

        /**
         * Set reductionArr1Enf4Adulte
         *
         * @param string $reductionArr1Enf4Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf4Adulte($reductionArr1Enf4Adulte)
        {
            $this->reductionArr1Enf4Adulte = $reductionArr1Enf4Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf4Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf4Adulte()
        {
            return $this->reductionArr1Enf4Adulte;
        }

        /**
         * Set reductionArr2Enf4Adulte
         *
         * @param string $reductionArr2Enf4Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf4Adulte($reductionArr2Enf4Adulte)
        {
            $this->reductionArr2Enf4Adulte = $reductionArr2Enf4Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf4Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf4Adulte()
        {
            return $this->reductionArr2Enf4Adulte;
        }

        /**
         * Set reductionArr1Enf5Adulte
         *
         * @param string $reductionArr1Enf5Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf5Adulte($reductionArr1Enf5Adulte)
        {
            $this->reductionArr1Enf5Adulte = $reductionArr1Enf5Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf5Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf5Adulte()
        {
            return $this->reductionArr1Enf5Adulte;
        }

        /**
         * Set reductionArr2Enf5Adulte
         *
         * @param string $reductionArr2Enf5Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf5Adulte($reductionArr2Enf5Adulte)
        {
            $this->reductionArr2Enf5Adulte = $reductionArr2Enf5Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf5Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf5Adulte()
        {
            return $this->reductionArr2Enf5Adulte;
        }

        /**
         * Set reductionArr1Enf6Adulte
         *
         * @param string $reductionArr1Enf6Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf6Adulte($reductionArr1Enf6Adulte)
        {
            $this->reductionArr1Enf6Adulte = $reductionArr1Enf6Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf6Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf6Adulte()
        {
            return $this->reductionArr1Enf6Adulte;
        }

        /**
         * Set reductionArr2Enf6Adulte
         *
         * @param string $reductionArr2Enf6Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf6Adulte($reductionArr2Enf6Adulte)
        {
            $this->reductionArr2Enf6Adulte = $reductionArr2Enf6Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf6Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf6Adulte()
        {
            return $this->reductionArr2Enf6Adulte;
        }

        /**
         * Set reductionArr1Enf7Adulte
         *
         * @param string $reductionArr1Enf7Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf7Adulte($reductionArr1Enf7Adulte)
        {
            $this->reductionArr1Enf7Adulte = $reductionArr1Enf7Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf7Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf7Adulte()
        {
            return $this->reductionArr1Enf7Adulte;
        }

        /**
         * Set reductionArr2Enf7Adulte
         *
         * @param string $reductionArr2Enf7Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf7Adulte($reductionArr2Enf7Adulte)
        {
            $this->reductionArr2Enf7Adulte = $reductionArr2Enf7Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf7Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf7Adulte()
        {
            return $this->reductionArr2Enf7Adulte;
        }

        /**
         * Set reductionArr1Enf8Adulte
         *
         * @param string $reductionArr1Enf8Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf8Adulte($reductionArr1Enf8Adulte)
        {
            $this->reductionArr1Enf8Adulte = $reductionArr1Enf8Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf8Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf8Adulte()
        {
            return $this->reductionArr1Enf8Adulte;
        }

        /**
         * Set reductionArr2Enf8Adulte
         *
         * @param string $reductionArr2Enf8Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf8Adulte($reductionArr2Enf8Adulte)
        {
            $this->reductionArr2Enf8Adulte = $reductionArr2Enf8Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf8Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf8Adulte()
        {
            return $this->reductionArr2Enf8Adulte;
        }

        /**
         * Set reductionArr1Enf9Adulte
         *
         * @param string $reductionArr1Enf9Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf9Adulte($reductionArr1Enf9Adulte)
        {
            $this->reductionArr1Enf9Adulte = $reductionArr1Enf9Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf9Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf9Adulte()
        {
            return $this->reductionArr1Enf9Adulte;
        }

        /**
         * Set reductionArr2Enf9Adulte
         *
         * @param string $reductionArr2Enf9Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf9Adulte($reductionArr2Enf9Adulte)
        {
            $this->reductionArr2Enf9Adulte = $reductionArr2Enf9Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf9Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf9Adulte()
        {
            return $this->reductionArr2Enf9Adulte;
        }

        /**
         * Set reductionArr1Enf10Adulte
         *
         * @param string $reductionArr1Enf10Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr1Enf10Adulte($reductionArr1Enf10Adulte)
        {
            $this->reductionArr1Enf10Adulte = $reductionArr1Enf10Adulte;
            return $this;
        }

        /**
         * Get reductionArr1Enf10Adulte
         *
         * @return string
         */
        public function getReductionArr1Enf10Adulte()
        {
            return $this->reductionArr1Enf10Adulte;
        }

        /**
         * Set reductionArr2Enf10Adulte
         *
         * @param string $reductionArr2Enf10Adulte
         * @return SaisonFraisChambre
         */
        public function setReductionArr2Enf10Adulte($reductionArr2Enf10Adulte)
        {
            $this->reductionArr2Enf10Adulte = $reductionArr2Enf10Adulte;
            return $this;
        }

        /**
         * Get reductionArr2Enf10Adulte
         *
         * @return string
         */
        public function getReductionArr2Enf10Adulte()
        {
            return $this->reductionArr2Enf10Adulte;
        }

        public function aPartirDe()
        {
            if($this->margePourc1Adulte)
                return $this->valeur2Adulte + $this->valeur2Adulte / 100 * $this->marge2Adulte;
            else
                return $this->valeur2Adulte + $this->marge2Adulte;
        }
    }
