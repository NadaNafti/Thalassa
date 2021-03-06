<?php
    namespace Back\ProgrammeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * ReservationLigne
     *
     * @ORM\Table(name="ost_pr_reservations_lignes")
     * @ORM\Entity
     */
    class ReservationLigne
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
         * @ORM\Column(name="code", type="string", length=255)
         */
        private $code;

        /**
         * @var string
         *
         * @ORM\Column(name="libelle", type="string", length=255)
         */
        private $libelle;

        /**
         * @var string
         *
         * @ORM\Column(name="achat", type="decimal", precision=11 ,scale=3)
         */
        private $achat;

        /**
         * @var string
         *
         * @ORM\Column(name="vente", type="decimal", precision=11 ,scale=3)
         */
        private $vente;

        /**
         * @ORM\ManyToOne(targetEntity="ReservationPersonne", inversedBy="lignes",cascade={"persist"})
         * @ORM\JoinColumn(onDelete="CASCADE")
         */
        private $personne;

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
         * Set code
         *
         * @param string $code
         * @return ReservationLigne
         */
        public function setCode($code)
        {
            $this->code = $code;
            return $this;
        }

        /**
         * Get code
         *
         * @return string
         */
        public function getCode()
        {
            return $this->code;
        }

        /**
         * Set libelle
         *
         * @param string $libelle
         * @return ReservationLigne
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
         * Set achat
         *
         * @param string $achat
         * @return ReservationLigne
         */
        public function setAchat($achat)
        {
            $this->achat = $achat;
            return $this;
        }

        /**
         * Get achat
         *
         * @return string
         */
        public function getAchat()
        {
            return $this->achat;
        }

        /**
         * Set vente
         *
         * @param string $vente
         * @return ReservationLigne
         */
        public function setVente($vente)
        {
            $this->vente = $vente;
            return $this;
        }

        /**
         * Get vente
         *
         * @return string
         */
        public function getVente()
        {
            return $this->vente;
        }

        /**
         * Set personne
         *
         * @param \Back\ProgrammeBundle\Entity\ReservationPersonne $personne
         * @return ReservationLigne
         */
        public function setPersonne(\Back\ProgrammeBundle\Entity\ReservationPersonne $personne = NULL)
        {
            $this->personne = $personne;
            return $this;
        }

        /**
         * Get personne
         *
         * @return \Back\ProgrammeBundle\Entity\ReservationPersonne
         */
        public function getPersonne()
        {
            return $this->personne;
        }

        public function __toString()
        {
            return $this->libelle;
        }
    }
