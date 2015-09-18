<?php
 namespace Back\ResaBookingBundle\Soap;

class enfant_age
{

    /**
     * @var string $age
     */
    protected $age = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getAge()
    {
      return $this->age;
    }

    /**
     * @param string $age
     * @return enfant_age
     */
    public function setAge($age)
    {
      $this->age = $age;
      return $this;
    }

}
