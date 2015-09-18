<?php
 namespace Back\ResaBookingBundle\Soap;

class policy
{

    /**
     * @var string $type_penalite
     */
    protected $type_penalite = null;

    /**
     * @var string $daysbefore
     */
    protected $daysbefore = null;

    /**
     * @var string $penalite
     */
    protected $penalite = null;

    /**
     * @var string $type
     */
    protected $type = null;

    /**
     * @var ArrayOftype_arrangement $arrangement
     */
    protected $arrangement = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getType_penalite()
    {
      return $this->type_penalite;
    }

    /**
     * @param string $type_penalite
     * @return policy
     */
    public function setType_penalite($type_penalite)
    {
      $this->type_penalite = $type_penalite;
      return $this;
    }

    /**
     * @return string
     */
    public function getDaysbefore()
    {
      return $this->daysbefore;
    }

    /**
     * @param string $daysbefore
     * @return policy
     */
    public function setDaysbefore($daysbefore)
    {
      $this->daysbefore = $daysbefore;
      return $this;
    }

    /**
     * @return string
     */
    public function getPenalite()
    {
      return $this->penalite;
    }

    /**
     * @param string $penalite
     * @return policy
     */
    public function setPenalite($penalite)
    {
      $this->penalite = $penalite;
      return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
      return $this->type;
    }

    /**
     * @param string $type
     * @return policy
     */
    public function setType($type)
    {
      $this->type = $type;
      return $this;
    }

    /**
     * @return ArrayOftype_arrangement
     */
    public function getArrangement()
    {
      return $this->arrangement;
    }

    /**
     * @param ArrayOftype_arrangement $arrangement
     * @return policy
     */
    public function setArrangement($arrangement)
    {
      $this->arrangement = $arrangement;
      return $this;
    }

}
