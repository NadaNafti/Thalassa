<?php
 namespace Back\ResaBookingBundle\Soap;

class options
{

    /**
     * @var ArrayOfoption $opt
     */
    protected $opt = null;


    public function __construct()
    {

    }

    /**
     * @return ArrayOfoption
     */
    public function getOpt()
    {
      return $this->opt;
    }

    /**
     * @param ArrayOfoption $opt
     * @return options
     */
    public function setOpt($opt)
    {
      $this->opt = $opt;
      return $this;
    }

}
