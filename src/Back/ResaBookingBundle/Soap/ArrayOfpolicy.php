<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfpolicy
{

    /**
     * @var policy[] $ArrayOfpolicy
     */
    protected $ArrayOfpolicy = null;

    /**
     * @param policy[] $ArrayOfpolicy
     */
    public function __construct(array $ArrayOfpolicy)
    {
      $this->ArrayOfpolicy = $ArrayOfpolicy;
    }

    /**
     * @return policy[]
     */
    public function getArrayOfpolicy()
    {
      return $this->ArrayOfpolicy;
    }

    /**
     * @param policy[] $ArrayOfpolicy
     * @return ArrayOfpolicy
     */
    public function setArrayOfpolicy(array $ArrayOfpolicy)
    {
      $this->ArrayOfpolicy = $ArrayOfpolicy;
      return $this;
    }

}
