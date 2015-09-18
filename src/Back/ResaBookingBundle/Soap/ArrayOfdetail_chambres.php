<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfdetail_chambres
{

    /**
     * @var detail_chambres[] $ArrayOfdetail_chambres
     */
    protected $ArrayOfdetail_chambres = null;

    /**
     * @param detail_chambres[] $ArrayOfdetail_chambres
     */
    public function __construct(array $ArrayOfdetail_chambres)
    {
      $this->ArrayOfdetail_chambres = $ArrayOfdetail_chambres;
    }

    /**
     * @return detail_chambres[]
     */
    public function getArrayOfdetail_chambres()
    {
      return $this->ArrayOfdetail_chambres;
    }

    /**
     * @param detail_chambres[] $ArrayOfdetail_chambres
     * @return ArrayOfdetail_chambres
     */
    public function setArrayOfdetail_chambres(array $ArrayOfdetail_chambres)
    {
      $this->ArrayOfdetail_chambres = $ArrayOfdetail_chambres;
      return $this;
    }

}
