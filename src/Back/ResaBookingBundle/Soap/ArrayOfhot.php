<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfhot
{

    /**
     * @var hot[] $ArrayOfhot
     */
    protected $ArrayOfhot = null;

    /**
     * @param hot[] $ArrayOfhot
     */
    public function __construct(array $ArrayOfhot)
    {
      $this->ArrayOfhot = $ArrayOfhot;
    }

    /**
     * @return hot[]
     */
    public function getArrayOfhot()
    {
      return $this->ArrayOfhot;
    }

    /**
     * @param hot[] $ArrayOfhot
     * @return ArrayOfhot
     */
    public function setArrayOfhot(array $ArrayOfhot)
    {
      $this->ArrayOfhot = $ArrayOfhot;
      return $this;
    }

}
