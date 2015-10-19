<?php
namespace Back\ResaBookingBundle\WSDL;

class room
{

    /**
     * @var ArrayOfTraveller $Traveller
     */
    protected $Traveller = null;

    
    public function __construct()
    {
        $this->Traveller=array();
    }

    public function addTraveller($Traveller)
    {
        $this->Traveller[]=$Traveller;
        return $this;
    }

    /**
     * @return ArrayOfTraveller
     */
    public function getTraveller()
    {
      return $this->Traveller;
    }

    /**
     * @param ArrayOfTraveller $Traveller
     * @return room
     */
    public function setTraveller($Traveller)
    {
      $this->Traveller = $Traveller;
      return $this;
    }

}
