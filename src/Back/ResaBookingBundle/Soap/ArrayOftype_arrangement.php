<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOftype_arrangement
{

    /**
     * @var type_arrangement[] $ArrayOftype_arrangement
     */
    protected $ArrayOftype_arrangement = null;

    /**
     * @param type_arrangement[] $ArrayOftype_arrangement
     */
    public function __construct(array $ArrayOftype_arrangement)
    {
      $this->ArrayOftype_arrangement = $ArrayOftype_arrangement;
    }

    /**
     * @return type_arrangement[]
     */
    public function getArrayOftype_arrangement()
    {
      return $this->ArrayOftype_arrangement;
    }

    /**
     * @param type_arrangement[] $ArrayOftype_arrangement
     * @return ArrayOftype_arrangement
     */
    public function setArrayOftype_arrangement(array $ArrayOftype_arrangement)
    {
      $this->ArrayOftype_arrangement = $ArrayOftype_arrangement;
      return $this;
    }

}
