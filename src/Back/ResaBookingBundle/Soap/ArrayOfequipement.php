<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfequipement
{

    /**
     * @var equipement[] $ArrayOfequipement
     */
    protected $ArrayOfequipement = null;

    /**
     * @param equipement[] $ArrayOfequipement
     */
    public function __construct(array $ArrayOfequipement)
    {
      $this->ArrayOfequipement = $ArrayOfequipement;
    }

    /**
     * @return equipement[]
     */
    public function getArrayOfequipement()
    {
      return $this->ArrayOfequipement;
    }

    /**
     * @param equipement[] $ArrayOfequipement
     * @return ArrayOfequipement
     */
    public function setArrayOfequipement(array $ArrayOfequipement)
    {
      $this->ArrayOfequipement = $ArrayOfequipement;
      return $this;
    }

}
