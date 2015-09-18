<?php
 namespace Back\ResaBookingBundle\Soap;

class type_arrangement
{

    /**
     * @var string $code_arrangement
     */
    protected $code_arrangement = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getCode_arrangement()
    {
      return $this->code_arrangement;
    }

    /**
     * @param string $code_arrangement
     * @return type_arrangement
     */
    public function setCode_arrangement($code_arrangement)
    {
      $this->code_arrangement = $code_arrangement;
      return $this;
    }

}
