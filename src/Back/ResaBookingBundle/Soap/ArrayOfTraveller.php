<?php

 namespace Back\ResaBookingBundle\Soap;

class ArrayOfTraveller
{

    /**
     * @var Traveller[] $ArrayOfTraveller
     */
    protected $Traveller = null;

    /**
     * @param Traveller[] $ArrayOfTraveller
     */
    public function __construct(array $ArrayOfTraveller)
    {
      $this->Traveller = $ArrayOfTraveller;
    }

    /**
     * @return Traveller[]
     */
    public function getArrayOfTraveller()
    {
      return $this->Traveller;
    }

    /**
     * @param Traveller[] $ArrayOfTraveller
     * @return ArrayOfTraveller
     */
    public function setArrayOfTraveller(array $ArrayOfTraveller)
    {
      $this->Traveller = $ArrayOfTraveller;
      return $this;
    }

}
