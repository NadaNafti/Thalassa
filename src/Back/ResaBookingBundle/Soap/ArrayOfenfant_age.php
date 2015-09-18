<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfenfant_age
{

    /**
     * @var enfant_age[] $ArrayOfenfant_age
     */
    protected $ArrayOfenfant_age = null;

    /**
     * @param enfant_age[] $ArrayOfenfant_age
     */
    public function __construct(array $ArrayOfenfant_age)
    {
      $this->ArrayOfenfant_age = $ArrayOfenfant_age;
    }

    /**
     * @return enfant_age[]
     */
    public function getArrayOfenfant_age()
    {
      return $this->ArrayOfenfant_age;
    }

    /**
     * @param enfant_age[] $ArrayOfenfant_age
     * @return ArrayOfenfant_age
     */
    public function setArrayOfenfant_age(array $ArrayOfenfant_age)
    {
      $this->ArrayOfenfant_age = $ArrayOfenfant_age;
      return $this;
    }

}
