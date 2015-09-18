<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfchambres
{

    /**
     * @var chambres[] $ArrayOfchambres
     */
    protected $ArrayOfchambres = null;

    /**
     * @param chambres[] $ArrayOfchambres
     */
    public function __construct(array $ArrayOfchambres)
    {
      $this->ArrayOfchambres = $ArrayOfchambres;
    }

    /**
     * @return chambres[]
     */
    public function getArrayOfchambres()
    {
      return $this->ArrayOfchambres;
    }

    /**
     * @param chambres[] $ArrayOfchambres
     * @return ArrayOfchambres
     */
    public function setArrayOfchambres(array $ArrayOfchambres)
    {
      $this->ArrayOfchambres = $ArrayOfchambres;
      return $this;
    }

}
