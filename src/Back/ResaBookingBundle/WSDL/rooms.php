<?php
namespace Back\ResaBookingBundle\WSDL;
class rooms
{

    /**
     * @var ArrayOfroom $room
     */
    protected $room = null;

    
    public function __construct()
    {
        $this->room=array();
    }

    public function addRoom(room $room)
    {
        $this->room[]=$room;
        return $this;
    }

    /**
     * @return ArrayOfroom
     */
    public function getRoom()
    {
      return $this->room;
    }

    /**
     * @param ArrayOfroom $room
     * @return rooms
     */
    public function setRoom($room)
    {
      $this->room = $room;
      return $this;
    }

}
