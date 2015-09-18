<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfoption
{

    /**
     * @var option[] $ArrayOfoption
     */
    protected $ArrayOfoption = null;

    /**
     * @param option[] $ArrayOfoption
     */
    public function __construct(array $ArrayOfoption)
    {
      $this->ArrayOfoption = $ArrayOfoption;
    }

    /**
     * @return option[]
     */
    public function getArrayOfoption()
    {
      return $this->ArrayOfoption;
    }

    /**
     * @param option[] $ArrayOfoption
     * @return ArrayOfoption
     */
    public function setArrayOfoption(array $ArrayOfoption)
    {
      $this->ArrayOfoption = $ArrayOfoption;
      return $this;
    }

}
