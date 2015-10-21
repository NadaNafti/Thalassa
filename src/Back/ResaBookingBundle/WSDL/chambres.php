<?php
namespace Back\ResaBookingBundle\WSDL;

class chambres
{

    /**
     * @var ArrayOfchambre $chambre
     */
    protected $chambre = null;

    
    public function __construct()
    {
        $this->chambre=array();
    }

    public function addChambre($chambre)
    {
        $this-$chambre[]=$chambre;
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
