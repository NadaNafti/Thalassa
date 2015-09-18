<?php
 namespace Back\ResaBookingBundle\Soap;

class resbooking
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $numResult
     */
    protected $numResult = null;

    /**
     * @var ArrayOfdetailresa $inforesa
     */
    protected $inforesa = null;


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
     * @return resbooking
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
      return $this;
    }

    /**
     * @return string
     */
    public function getNumResult()
    {
      return $this->numResult;
    }

    /**
     * @param string $numResult
     * @return resbooking
     */
    public function setNumResult($numResult)
    {
      $this->numResult = $numResult;
      return $this;
    }

    /**
     * @return ArrayOfdetailresa
     */
    public function getInforesa()
    {
      return $this->inforesa;
    }

    /**
     * @param ArrayOfdetailresa $inforesa
     * @return resbooking
     */
    public function setInforesa($inforesa)
    {
      $this->inforesa = $inforesa;
      return $this;
    }

}
