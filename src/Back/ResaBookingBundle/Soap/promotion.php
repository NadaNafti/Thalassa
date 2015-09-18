<?php
 namespace Back\ResaBookingBundle\Soap;

class promotion
{

    /**
     * @var string $libelle_promotion
     */
    protected $libelle_promotion = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getLibelle_promotion()
    {
      return $this->libelle_promotion;
    }

    /**
     * @param string $libelle_promotion
     * @return promotion
     */
    public function setLibelle_promotion($libelle_promotion)
    {
      $this->libelle_promotion = $libelle_promotion;
      return $this;
    }

}
