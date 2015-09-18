<?php
 namespace Back\ResaBookingBundle\Soap;

class chambres
{

    /**
     * @var ArrayOfchambre $chambre
     */
    protected $chambre = null;


    public function __construct()
    {

    }

    /**
     * @return ArrayOfchambre
     */
    public function getChambre()
    {
      return $this->chambre;
    }

    /**
     * @param ArrayOfchambre $chambre
     * @return chambres
     */
    public function setChambre($chambre)
    {
      $this->chambre = $chambre;
      return $this;
    }

}
