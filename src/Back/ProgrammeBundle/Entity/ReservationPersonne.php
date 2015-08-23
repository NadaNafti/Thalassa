<?php
    namespace Back\ProgrammeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * ReservationPersonne
     *
     * @ORM\Table(name="ost_pr_reservation_personnes")
     * @ORM\Entity()
     */
    class ReservationPersonne
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
         * @ORM\Column(name="nom_prenom", type="string", length=255)
         */
        private $nomPrenom;

        /**
         * @var integer
         *
         * @ORM\Column(name="age", type="integer",nullable=true)
         */
        private $age;

        /**
         * @var string
         *
         * @ORM\Column(name="passport", type="string", length=100)
         */
        private $passport;

        /**
         * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="adultes",cascade={"persist"})
         * @ORM\JoinColumn(onDelete="CASCADE")
         */
        private $reservationA;

        /**
         * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="enfants",cascade={"persist"})
         * @ORM\JoinColumn(onDelete="CASCADE")
         */
        private $reservationE;

        /**
         * @ORM\OneToMany(targetEntity="ReservationLigne", mappedBy="personne")
         */
        protected $lignes;

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
         * Set nomPrenom
         *
         * @param string $nomPrenom
         * @return ReservationPersonne
         */
        public function setNomPrenom($nomPrenom)
        {
            $this->nomPrenom = $nomPrenom;
            return $this;
        }

        /**
         * Get nomPrenom
         *
         * @return string
         */
        public function getNomPrenom()
        {
            return $this->nomPrenom;
        }

        /**
         * Set age
         *
         * @param integer $age
         * @return ReservationPersonne
         */
        public function setAge($age)
        {
            $this->age = $age;
            return $this;
        }

        /**
         * Get age
         *
         * @return integer
         */
        public function getAge()
        {
            return $this->age;
        }

        /**
         * Set dateNaissance
         *
         * @param \DateTime $dateNaissance
         * @return ReservationPersonne
         */
        public function setDateNaissance($dateNaissance)
        {
            $this->dateNaissance = $dateNaissance;
            return $this;
        }

        /**
         * Get passport
         *
         * @return string
         */
        public function getPassport()
        {
            return $this->passport;
        }

        /**
         * Set passport
         *
         * @param string $passport
         * @return ReservationPersonne
         */
        public function setPassport($passport)
        {
            $this->passport = $passport;
            return $this;
        }

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
        }



        /**
         * Get lignes
         *
         * @return \Doctrine\Common\Collections\Collection
         */
        public function getLignes()
        {
            return $this->lignes;
        }

        /**
         * Get total Vente
         *
         * @return string
         */
        public function getTotalLigneVente()
        {
            $total = 0;
            foreach($this->lignes as $ligne)
                $total += $ligne->getVente();
            return $total;
        }

        /**
         * Get total Achat
         *
         * @return string
         */
        public function getTotalLigneAchat()
        {
            $total = 0;
            foreach($this->lignes as $ligne)
                $total += $ligne->getAchat();
            return $total;
        }

        public function __toString()
        {
            return $this->nomPrenom;
        }

        /**
         * Add lignes
         *
         * @param \Back\ProgrammeBundle\Entity\ReservationLigne $lignes
         * @return ReservationPersonne
         */
        public function addLigne(\Back\ProgrammeBundle\Entity\ReservationLigne $lignes)
        {
            $this->lignes[] = $lignes;
            return $this;
        }

        /**
         * Remove lignes
         *
         * @param \Back\ProgrammeBundle\Entity\ReservationLigne $lignes
         */
        public function removeLigne(\Back\ProgrammeBundle\Entity\ReservationLigne $lignes)
        {
            $this->lignes->removeElement($lignes);
        }
    
    /**
     * Set reservationA
     *
     * @param \Back\ProgrammeBundle\Entity\Reservation $reservationA
     * @return ReservationPersonne
     */
    public function setReservationA(\Back\ProgrammeBundle\Entity\Reservation $reservationA = null)
    {
        $this->reservationA = $reservationA;

        return $this;
    }

    /**
     * Get reservationA
     *
     * @return \Back\ProgrammeBundle\Entity\Reservation 
     */
    public function getReservationA()
    {
        return $this->reservationA;
    }

    /**
     * Set reservationE
     *
     * @param \Back\ProgrammeBundle\Entity\Reservation $reservationE
     * @return ReservationPersonne
     */
    public function setReservationE(\Back\ProgrammeBundle\Entity\Reservation $reservationE = null)
    {
        $this->reservationE = $reservationE;

        return $this;
    }

    /**
     * Get reservationE
     *
     * @return \Back\ProgrammeBundle\Entity\Reservation 
     */
    public function getReservationE()
    {
        return $this->reservationE;
    }
}
