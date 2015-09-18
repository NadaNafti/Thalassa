<?php
 namespace Back\ResaBookingBundle\Soap;

class ArrayOfliste_suplement_obligatoire
{

    /**
     * @var liste_suplement_obligatoire[] $ArrayOfliste_suplement_obligatoire
     */
    protected $ArrayOfliste_suplement_obligatoire = null;

    /**
     * @param liste_suplement_obligatoire[] $ArrayOfliste_suplement_obligatoire
     */
    public function __construct(array $ArrayOfliste_suplement_obligatoire)
    {
      $this->ArrayOfliste_suplement_obligatoire = $ArrayOfliste_suplement_obligatoire;
    }

    /**
     * @return liste_suplement_obligatoire[]
     */
    public function getArrayOfliste_suplement_obligatoire()
    {
      return $this->ArrayOfliste_suplement_obligatoire;
    }

    /**
     * @param liste_suplement_obligatoire[] $ArrayOfliste_suplement_obligatoire
     * @return ArrayOfliste_suplement_obligatoire
     */
    public function setArrayOfliste_suplement_obligatoire(array $ArrayOfliste_suplement_obligatoire)
    {
      $this->ArrayOfliste_suplement_obligatoire = $ArrayOfliste_suplement_obligatoire;
      return $this;
    }

}
