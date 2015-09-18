<?php
 namespace Back\ResaBookingBundle\Soap;

class bookingcancel
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $session
     */
    protected $session = null;

    /**
     * @var string $type_penalite
     */
    protected $type_penalite = null;

    /**
     * @var string $frais_annulation
     */
    protected $frais_annulation = null;

    /**
     * @var string $monnaie
     */
    protected $monnaie = null;


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
     * @return bookingcancel
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
      return $this;
    }

    /**
     * @return string
     */
    public function getSession()
    {
      return $this->session;
    }

    /**
     * @param string $session
     * @return bookingcancel
     */
    public function setSession($session)
    {
      $this->session = $session;
      return $this;
    }

    /**
     * @return string
     */
    public function getType_penalite()
    {
      return $this->type_penalite;
    }

    /**
     * @param string $type_penalite
     * @return bookingcancel
     */
    public function setType_penalite($type_penalite)
    {
      $this->type_penalite = $type_penalite;
      return $this;
    }

    /**
     * @return string
     */
    public function getFrais_annulation()
    {
      return $this->frais_annulation;
    }

    /**
     * @param string $frais_annulation
     * @return bookingcancel
     */
    public function setFrais_annulation($frais_annulation)
    {
      $this->frais_annulation = $frais_annulation;
      return $this;
    }

    /**
     * @return string
     */
    public function getMonnaie()
    {
      return $this->monnaie;
    }

    /**
     * @param string $monnaie
     * @return bookingcancel
     */
    public function setMonnaie($monnaie)
    {
      $this->monnaie = $monnaie;
      return $this;
    }

}
