<?php
 namespace Back\ResaBookingBundle\Soap;

class vol
{

    /**
     * @var string $numvolaller
     */
    protected $numvolaller = null;

    /**
     * @var string $numvolretour
     */
    protected $numvolretour = null;

    /**
     * @var string $datealler
     */
    protected $datealler = null;

    /**
     * @var string $dateretour
     */
    protected $dateretour = null;

    /**
     * @var string $heuraller
     */
    protected $heuraller = null;

    /**
     * @var string $heurretour
     */
    protected $heurretour = null;

    /**
     * @var string $aeroport
     */
    protected $aeroport = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getNumvolaller()
    {
      return $this->numvolaller;
    }

    /**
     * @param string $numvolaller
     * @return vol
     */
    public function setNumvolaller($numvolaller)
    {
      $this->numvolaller = $numvolaller;
      return $this;
    }

    /**
     * @return string
     */
    public function getNumvolretour()
    {
      return $this->numvolretour;
    }

    /**
     * @param string $numvolretour
     * @return vol
     */
    public function setNumvolretour($numvolretour)
    {
      $this->numvolretour = $numvolretour;
      return $this;
    }

    /**
     * @return string
     */
    public function getDatealler()
    {
      return $this->datealler;
    }

    /**
     * @param string $datealler
     * @return vol
     */
    public function setDatealler($datealler)
    {
      $this->datealler = $datealler;
      return $this;
    }

    /**
     * @return string
     */
    public function getDateretour()
    {
      return $this->dateretour;
    }

    /**
     * @param string $dateretour
     * @return vol
     */
    public function setDateretour($dateretour)
    {
      $this->dateretour = $dateretour;
      return $this;
    }

    /**
     * @return string
     */
    public function getHeuraller()
    {
      return $this->heuraller;
    }

    /**
     * @param string $heuraller
     * @return vol
     */
    public function setHeuraller($heuraller)
    {
      $this->heuraller = $heuraller;
      return $this;
    }

    /**
     * @return string
     */
    public function getHeurretour()
    {
      return $this->heurretour;
    }

    /**
     * @param string $heurretour
     * @return vol
     */
    public function setHeurretour($heurretour)
    {
      $this->heurretour = $heurretour;
      return $this;
    }

    /**
     * @return string
     */
    public function getAeroport()
    {
      return $this->aeroport;
    }

    /**
     * @param string $aeroport
     * @return vol
     */
    public function setAeroport($aeroport)
    {
      $this->aeroport = $aeroport;
      return $this;
    }

}
