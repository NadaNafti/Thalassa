<?php
namespace Back\ResaBookingBundle\WSDL;

class chambs
{

    /**
     * @var ArrayOfchamb $chs
     */
    protected $chs = null;

    
    public function __construct()
    {
        $this->chs=array();
    }

    public function addChamb($chamb)
    {
        $this->chs[]=$chamb;
    }

    /**
     * @return ArrayOfchamb
     */
    public function getChs()
    {
      return $this->chs;
    }

    /**
     * @param ArrayOfchamb $chs
     * @return chambs
     */
    public function setChs($chs)
    {
      $this->chs = $chs;
      return $this;
    }

}
