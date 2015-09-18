<?php
 namespace Back\ResaBookingBundle\Soap;

class detailresa
{

    /**
     * @var string $reference
     */
    protected $reference = null;

    /**
     * @var string $dateChekIn
     */
    protected $dateChekIn = null;

    /**
     * @var string $dateChekOut
     */
    protected $dateChekOut = null;

    /**
     * @var string $dateCreation
     */
    protected $dateCreation = null;

    /**
     * @var string $etat_commande
     */
    protected $etat_commande = null;

    /**
     * @var ArrayOfinfo_pass $liste_passager
     */
    protected $liste_passager = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getReference()
    {
      return $this->reference;
    }

    /**
     * @param string $reference
     * @return detailresa
     */
    public function setReference($reference)
    {
      $this->reference = $reference;
      return $this;
    }

    /**
     * @return string
     */
    public function getDateChekIn()
    {
      return $this->dateChekIn;
    }

    /**
     * @param string $dateChekIn
     * @return detailresa
     */
    public function setDateChekIn($dateChekIn)
    {
      $this->dateChekIn = $dateChekIn;
      return $this;
    }

    /**
     * @return string
     */
    public function getDateChekOut()
    {
      return $this->dateChekOut;
    }

    /**
     * @param string $dateChekOut
     * @return detailresa
     */
    public function setDateChekOut($dateChekOut)
    {
      $this->dateChekOut = $dateChekOut;
      return $this;
    }

    /**
     * @return string
     */
    public function getDateCreation()
    {
      return $this->dateCreation;
    }

    /**
     * @param string $dateCreation
     * @return detailresa
     */
    public function setDateCreation($dateCreation)
    {
      $this->dateCreation = $dateCreation;
      return $this;
    }

    /**
     * @return string
     */
    public function getEtat_commande()
    {
      return $this->etat_commande;
    }

    /**
     * @param string $etat_commande
     * @return detailresa
     */
    public function setEtat_commande($etat_commande)
    {
      $this->etat_commande = $etat_commande;
      return $this;
    }

    /**
     * @return ArrayOfinfo_pass
     */
    public function getListe_passager()
    {
      return $this->liste_passager;
    }

    /**
     * @param ArrayOfinfo_pass $liste_passager
     * @return detailresa
     */
    public function setListe_passager($liste_passager)
    {
      $this->liste_passager = $liste_passager;
      return $this;
    }

}
