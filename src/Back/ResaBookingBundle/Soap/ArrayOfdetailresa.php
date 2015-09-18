<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfdetailresa
{

    /**
     * @var detailresa[] $ArrayOfdetailresa
     */
    protected $ArrayOfdetailresa = null;

    /**
     * @param detailresa[] $ArrayOfdetailresa
     */
    public function __construct(array $ArrayOfdetailresa)
    {
      $this->ArrayOfdetailresa = $ArrayOfdetailresa;
    }

    /**
     * @return detailresa[]
     */
    public function getArrayOfdetailresa()
    {
      return $this->ArrayOfdetailresa;
    }

    /**
     * @param detailresa[] $ArrayOfdetailresa
     * @return ArrayOfdetailresa
     */
    public function setArrayOfdetailresa(array $ArrayOfdetailresa)
    {
      $this->ArrayOfdetailresa = $ArrayOfdetailresa;
      return $this;
    }

}
