<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfroom
{

    /**
     * @var room[] $ArrayOfroom
     */
    protected $ArrayOfroom = null;

    /**
     * @param room[] $ArrayOfroom
     */
    public function __construct(array $ArrayOfroom)
    {
      $this->ArrayOfroom = $ArrayOfroom;
    }

    /**
     * @return room[]
     */
    public function getArrayOfroom()
    {
      return $this->ArrayOfroom;
    }

    /**
     * @param room[] $ArrayOfroom
     * @return ArrayOfroom
     */
    public function setArrayOfroom(array $ArrayOfroom)
    {
      $this->ArrayOfroom = $ArrayOfroom;
      return $this;
    }

}
