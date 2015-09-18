<?php
 namespace Back\ResaBookingBundle\Soap;

class reglement_commande
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $info
     */
    protected $info = null;

    /**
     * @var string $type_reglement
     */
    protected $type_reglement = null;

    /**
     * @var string $etat_paiement
     */
    protected $etat_paiement = null;

    /**
     * @var string $montant
     */
    protected $montant = null;

    /**
     * @var string $devise
     */
    protected $devise = null;


    public function __construct()
    {

    }

    /**
     * @return reponse
     */
    public function getRep()
    {
      return $this->rep;
    }

    /**
     * @param reponse $rep
     * @return reglement_commande
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
      return $this;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
      return $this->info;
    }

    /**
     * @param string $info
     * @return reglement_commande
     */
    public function setInfo($info)
    {
      $this->info = $info;
      return $this;
    }

    /**
     * @return string
     */
    public function getType_reglement()
    {
      return $this->type_reglement;
    }

    /**
     * @param string $type_reglement
     * @return reglement_commande
     */
    public function setType_reglement($type_reglement)
    {
      $this->type_reglement = $type_reglement;
      return $this;
    }

    /**
     * @return string
     */
    public function getEtat_paiement()
    {
      return $this->etat_paiement;
    }

    /**
     * @param string $etat_paiement
     * @return reglement_commande
     */
    public function setEtat_paiement($etat_paiement)
    {
      $this->etat_paiement = $etat_paiement;
      return $this;
    }

    /**
     * @return string
     */
    public function getMontant()
    {
      return $this->montant;
    }

    /**
     * @param string $montant
     * @return reglement_commande
     */
    public function setMontant($montant)
    {
      $this->montant = $montant;
      return $this;
    }

    /**
     * @return string
     */
    public function getDevise()
    {
      return $this->devise;
    }

    /**
     * @param string $devise
     * @return reglement_commande
     */
    public function setDevise($devise)
    {
      $this->devise = $devise;
      return $this;
    }

}
