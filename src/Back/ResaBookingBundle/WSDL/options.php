<?php
namespace Back\ResaBookingBundle\WSDL;

class options
{

    /**
     * @var ArrayOfoption $opt
     */
    protected $opt = null;

    
    public function __construct()
    {
        $this->opt=array();
    }

    public function addOption(option  $option)
    {
        $this->opt[]=$option;
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
