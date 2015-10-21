<?php
namespace Back\ResaBookingBundle\WSDL;

class vol
{

    protected $numvolaller = null;
    protected $numvolretour = null;
    protected $datealler = null;
    protected $dateretour = null;
    protected $heuraller = null;
    protected $heurretour = null;
    protected $aeroport = null;

    /**
     * vol constructor.
     * @param null $numvolaller
     * @param null $numvolretour
     * @param null $datealler
     * @param null $dateretour
     * @param null $heuraller
     * @param null $heurretour
     * @param null $aeroport
     */
    public function __construct($numvolaller = null, $numvolretour = null, $datealler = null, $dateretour = null, $heuraller = null, $heurretour = null, $aeroport = null)
    {
        $this->numvolaller = $numvolaller;
        $this->numvolretour = $numvolretour;
        $this->datealler = $datealler;
        $this->dateretour = $dateretour;
        $this->heuraller = $heuraller;
        $this->heurretour = $heurretour;
        $this->aeroport = $aeroport;
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
