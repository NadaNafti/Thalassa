<?php
    namespace Back\HotelTunisieBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * configuration
     *
     * @ORM\Table(name="ost_sht_configuration_voucher")
     * @ORM\Entity
     */
    class ConfigurationVoucher
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
         * @var integer
         *
         * @ORM\Column(name="debutVoucher", type="integer")
         */
        private $debutVoucher;

        /**
         * @var string
         *
         * @ORM\Column(name="codeCouleur", type="string")
         */
        private $codeCouleur;

        /**
         * @var string
         *
         * @ORM\Column(name="texteVoucher", type="text", nullable=true)
         */
        private $texteVoucher;
        /**
         * @var integer
         *
         * @ORM\Column(name="typeNumerotation", type="integer")
         */
        private $typeNumerotation;

        /**
         * @var boolean
         *
         * @ORM\Column(name="gmaps", type="boolean",nullable=true)
         */
        private $gmaps;

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
         * Set debutVoucher
         *
         * @param integer $debutVoucher
         * @return configuration
         */
        public function setDebutVoucher($debutVoucher)
        {
            $this->debutVoucher = $debutVoucher;
            return $this;
        }

        /**
         * Get debutVoucher
         *
         * @return integer
         */
        public function getDebutVoucher()
        {
            return $this->debutVoucher;
        }

        /**
         * Set texteVoucher
         *
         * @param string $texteVoucher
         * @return configuration
         */
        public function setTexteVoucher($texteVoucher)
        {
            $this->texteVoucher = $texteVoucher;
            return $this;
        }

        /**
         * Get texteVoucher
         *
         * @return string
         */
        public function getTexteVoucher()
        {
            return $this->texteVoucher;
        }

        /**
         * Set typeNumerotation
         *
         * @param integer $typeNumerotation
         * @return configuration
         */
        public function setTypeNumerotation($typeNumerotation)
        {
            $this->typeNumerotation = $typeNumerotation;
            return $this;
        }

        /**
         * Get typeNumerotation
         *
         * @return integer
         */
        public function getTypeNumerotation()
        {
            return $this->typeNumerotation;
        }
    
    /**Z
     * Set codeCouleur
     *
     * @param string $codeCouleur
     * @return ConfigurationVoucher
     */
    public function setCodeCouleur($codeCouleur)
    {
        $this->codeCouleur = $codeCouleur;

        return $this;
    }

    /**
     * Get codeCouleur
     *
     * @return string 
     */
    public function getCodeCouleur()
    {
        return $this->codeCouleur;
    }

    /**
     * Set gmaps
     *
     * @param boolean $gmaps
     * @return ConfigurationVoucher
     */
    public function setGmaps($gmaps)
    {
        $this->gmaps = $gmaps;

        return $this;
    }

    /**
     * Get gmaps
     *
     * @return boolean 
     */
    public function getGmaps()
    {
        return $this->gmaps;
    }
}
