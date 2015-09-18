<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfpromotion
{

    /**
     * @var promotion[] $ArrayOfpromotion
     */
    protected $ArrayOfpromotion = null;

    /**
     * @param promotion[] $ArrayOfpromotion
     */
    public function __construct(array $ArrayOfpromotion)
    {
      $this->ArrayOfpromotion = $ArrayOfpromotion;
    }

    /**
     * @return promotion[]
     */
    public function getArrayOfpromotion()
    {
      return $this->ArrayOfpromotion;
    }

    /**
     * @param promotion[] $ArrayOfpromotion
     * @return ArrayOfpromotion
     */
    public function setArrayOfpromotion(array $ArrayOfpromotion)
    {
      $this->ArrayOfpromotion = $ArrayOfpromotion;
      return $this;
    }

}
