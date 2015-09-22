<?php

namespace Back\BilletterieMaritimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BilletterieLigne
 *
 * @ORM\Table(name="ost_billetterie_reservation_ligne")
 * @ORM\Entity
 */
class BilletterieReservationLigne
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
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPrenom", type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="naissance", type="datetime")
     */
    private $naissance;

    /**
     * @var string
     *
     * @ORM\Column(name="passport", type="string", length=255)
     */
    private $passport;

    /**
     * @ORM\ManyToOne(targetEntity="BilletterieReservation", inversedBy="lignes",cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $reservation;


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
     * Set type
     *
     * @param integer $type
     * @return BilletterieLigne
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return BilletterieLigne
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
     * Set naissance
     *
     * @param \DateTime $naissance
     * @return BilletterieLigne
     */
    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;

        return $this;
    }

    /**
     * Get naissance
     *
     * @return \DateTime 
     */
    public function getNaissance()
    {
        return $this->naissance;
    }

    /**
     * Set passport
     *
     * @param string $passport
     * @return BilletterieLigne
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;

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
     * Set reservation
     *
     * @param \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservation
     * @return BilletterieReservationLigne
     */
    public function setReservation(\Back\BilletterieMaritimeBundle\Entity\BilletterieReservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Back\BilletterieMaritimeBundle\Entity\BilletterieReservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
