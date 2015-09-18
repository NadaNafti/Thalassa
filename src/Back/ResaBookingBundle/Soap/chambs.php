<?php
 namespace Back\ResaBookingBundle\Soap;

class chambs
{

    /**
     * @var ArrayOfchamb $chs
     */
    protected $chs = null;


    public function __construct()
    {

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
