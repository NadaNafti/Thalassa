<?php
 namespace Back\ResaBookingBundle\Soap;

class hotelliste
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var ArrayOfhot $hots
     */
    public $hots = null;

    /**
     * @var string $session
     */
    protected $session = null;

    /**
     * @var string $ville
     */
    protected $ville = null;

    /**
     * @var string $date_debut
     */
    protected $date_debut = null;

    /**
     * @var string $date_retour
     */
    protected $date_retour = null;

    /**
     * @var string $monnaie
     */
    protected $monnaie = null;

    /**
     * @var string $red_agence
     */
    protected $red_agence = null;


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
     * @return hotelliste
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
      return $this;
    }

    /**
     * @return ArrayOfhot
     */
    public function getHots()
    {
      return $this->hots;
    }

    /**
     * @param ArrayOfhot $hots
     * @return hotelliste
     */
    public function setHots($hots)
    {
      $this->hots = $hots;
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
     * @return hotelliste
     */
    public function setSession($session)
    {
      $this->session = $session;
      return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
      return $this->ville;
    }

    /**
     * @param string $ville
     * @return hotelliste
     */
    public function setVille($ville)
    {
      $this->ville = $ville;
      return $this;
    }

    /**
     * @return string
     */
    public function getDate_debut()
    {
      return $this->date_debut;
    }

    /**
     * @param string $date_debut
     * @return hotelliste
     */
    public function setDate_debut($date_debut)
    {
      $this->date_debut = $date_debut;
      return $this;
    }

    /**
     * @return string
     */
    public function getDate_retour()
    {
      return $this->date_retour;
    }

    /**
     * @param string $date_retour
     * @return hotelliste
     */
    public function setDate_retour($date_retour)
    {
      $this->date_retour = $date_retour;
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
     * @return hotelliste
     */
    public function setMonnaie($monnaie)
    {
      $this->monnaie = $monnaie;
      return $this;
    }

    /**
     * @return string
     */
    public function getRed_agence()
    {
      return $this->red_agence;
    }

    /**
     * @param string $red_agence
     * @return hotelliste
     */
    public function setRed_agence($red_agence)
    {
      $this->red_agence = $red_agence;
      return $this;
    }

}
