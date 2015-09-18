<?php
 namespace Back\ResaBookingBundle\Soap;

class comfirmbookingcancel
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $etat_commande
     */
    protected $etat_commande = null;


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
     * @return comfirmbookingcancel
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
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
     * @return comfirmbookingcancel
     */
    public function setEtat_commande($etat_commande)
    {
      $this->etat_commande = $etat_commande;
      return $this;
    }

}
