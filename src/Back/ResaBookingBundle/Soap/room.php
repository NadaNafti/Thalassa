<?php

namespace Back\ResaBookingBundle\Soap;

class room
{

    /**
     * @var ArrayOfTraveller $Traveller
     */
    protected $Traveller = null;


    public function __construct()
    {

    }

    /**
     * @return Traveller[]
     */
    public function getTraveller()
    {
      return $this->Traveller;
    }

    /**
     * @param Traveller[] $Traveller
     * @return room
     */
    public function setTraveller($Traveller)
    {
      $this->Traveller = $Traveller;
      return $this;
    }

}
