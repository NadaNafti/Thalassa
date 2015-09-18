<?php
 namespace Back\ResaBookingBundle\Soap;

class destock
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
     * @var string $typ_reglement
     */
    protected $typ_reglement = null;

    /**
     * @var string $etat_p
     */
    protected $etat_p = null;

    /**
     * @var string $prix_total
     */
    protected $prix_total = null;

    /**
     * @var string $avance
     */
    protected $avance = null;

    /**
     * @var string $prix_restant
     */
    protected $prix_restant = null;


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
     * @return destock
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
     * @return destock
     */
    public function setInfo($info)
    {
      $this->info = $info;
      return $this;
    }

    /**
     * @return string
     */
    public function getTyp_reglement()
    {
      return $this->typ_reglement;
    }

    /**
     * @param string $typ_reglement
     * @return destock
     */
    public function setTyp_reglement($typ_reglement)
    {
      $this->typ_reglement = $typ_reglement;
      return $this;
    }

    /**
     * @return string
     */
    public function getEtat_p()
    {
      return $this->etat_p;
    }

    /**
     * @param string $etat_p
     * @return destock
     */
    public function setEtat_p($etat_p)
    {
      $this->etat_p = $etat_p;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrix_total()
    {
      return $this->prix_total;
    }

    /**
     * @param string $prix_total
     * @return destock
     */
    public function setPrix_total($prix_total)
    {
      $this->prix_total = $prix_total;
      return $this;
    }

    /**
     * @return string
     */
    public function getAvance()
    {
      return $this->avance;
    }

    /**
     * @param string $avance
     * @return destock
     */
    public function setAvance($avance)
    {
      $this->avance = $avance;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrix_restant()
    {
      return $this->prix_restant;
    }

    /**
     * @param string $prix_restant
     * @return destock
     */
    public function setPrix_restant($prix_restant)
    {
      $this->prix_restant = $prix_restant;
      return $this;
    }

}
