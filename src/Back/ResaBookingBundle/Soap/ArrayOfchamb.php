<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfchamb
{

    /**
     * @var chamb[] $ArrayOfchamb
     */
    protected $ArrayOfchamb = null;

    /**
     * @param chamb[] $ArrayOfchamb
     */
    public function __construct(array $ArrayOfchamb)
    {
      $this->ArrayOfchamb = $ArrayOfchamb;
    }

    /**
     * @return chamb[]
     */
    public function getArrayOfchamb()
    {
      return $this->ArrayOfchamb;
    }

    /**
     * @param chamb[] $ArrayOfchamb
     * @return ArrayOfchamb
     */
    public function setArrayOfchamb(array $ArrayOfchamb)
    {
      $this->ArrayOfchamb = $ArrayOfchamb;
      return $this;
    }

}
