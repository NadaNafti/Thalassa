<?php

namespace Back\ResaBookingBundle\Soap ;

class rooms
{

    /**
     * @var ArrayOfroom $room
     */
    protected $room = null;


    public function __construct()
    {

    }

    /**
     * @return room[]
     */
    public function getRoom()
    {
      return $this->room;
    }

    /**
     * @param $room[]
     * @return rooms
     */
    public function setRoom($room)
    {
      $this->room = $room;
      return $this;
    }

}
