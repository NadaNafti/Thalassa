<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfinfo_pass
{

    /**
     * @var info_pass[] $ArrayOfinfo_pass
     */
    protected $ArrayOfinfo_pass = null;

    /**
     * @param info_pass[] $ArrayOfinfo_pass
     */
    public function __construct(array $ArrayOfinfo_pass)
    {
      $this->ArrayOfinfo_pass = $ArrayOfinfo_pass;
    }

    /**
     * @return info_pass[]
     */
    public function getArrayOfinfo_pass()
    {
      return $this->ArrayOfinfo_pass;
    }

    /**
     * @param info_pass[] $ArrayOfinfo_pass
     * @return ArrayOfinfo_pass
     */
    public function setArrayOfinfo_pass(array $ArrayOfinfo_pass)
    {
      $this->ArrayOfinfo_pass = $ArrayOfinfo_pass;
      return $this;
    }

}
