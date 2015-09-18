<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfchambre
{

    /**
     * @var chambre[] $ArrayOfchambre
     */
    protected $ArrayOfchambre = null;

    /**
     * @param chambre[] $ArrayOfchambre
     */
    public function __construct(array $ArrayOfchambre)
    {
      $this->ArrayOfchambre = $ArrayOfchambre;
    }

    /**
     * @return chambre[]
     */
    public function getArrayOfchambre()
    {
      return $this->ArrayOfchambre;
    }

    /**
     * @param chambre[] $ArrayOfchambre
     * @return ArrayOfchambre
     */
    public function setArrayOfchambre(array $ArrayOfchambre)
    {
      $this->ArrayOfchambre = $ArrayOfchambre;
      return $this;
    }

}
