<?php
 namespace Back\ResaBookingBundle\Soap;

class book
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $ref
     */
    protected $ref = null;


    public function __construct()
    {

    }

    /**
     * @return reponse
     */
    public function getRep()
    {
      return $this->rep;
    }

    /**
     * @param reponse $rep
     * @return book
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
      return $this;
    }

    /**
     * @return string
     */
    public function getRef()
    {
      return $this->ref;
    }

    /**
     * @param string $ref
     * @return book
     */
    public function setRef($ref)
    {
      $this->ref = $ref;
      return $this;
    }

}
