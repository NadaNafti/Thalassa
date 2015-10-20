<?php

namespace Back\ResaBookingBundle\Services;

use Back\HotelTunisieBundle\Entity\ReservationChambreJour;
use Back\HotelTunisieBundle\Entity\Saison;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\HotelTunisieBundle\Entity\Reservation;
use Back\HotelTunisieBundle\Entity\ReservationPersonne;
use Back\HotelTunisieBundle\Entity\ReservationLigne;
use Back\HotelTunisieBundle\Entity\ReservationJour;
use Back\HotelTunisieBundle\Entity\ReservationChambre;
use Back\HotelTunisieBundle\Entity\ReservationRepository;
use Back\HotelTunisieBundle\Entity\Hotel;
use Back\AdministrationBundle\Entity\EmailRepository;
use Back\UserBundle\Entity\Client;
use Back\ResaBookingBundle\WSDL\rooms;
use Back\ResaBookingBundle\WSDL\Traveller;
use Back\ResaBookingBundle\WSDL\room;

class ResaBookingService
{

    protected $em;
    protected $session;
    protected $container;
    protected $mailer;
    protected $templating;

    public function __construct(EntityManager $em, Session $session, Container $container, \Swift_Mailer $mailer, $templating)
    {
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function availabilityHotel($ville,$debut,$fin,rooms $rooms,$idHotel=null)
    {
        $configResaBooking= $this->em->find('BackResaBookingBundle:Configuration',1);
        $client = new \SoapClient($configResaBooking->getWsdl());
        $request = array($_SERVER["REMOTE_ADDR"],$ville,$idHotel,$debut,$fin,$rooms,$configResaBooking->getLogin(),$configResaBooking->getPassword(),"fr","Magrabein","dt");
        return $client->__soapCall('availabilityhotel', $request);
    }

    public function devis($session,$idHotel,$pension,$chambs,$options)
    {
        $configResaBooking= $this->em->find('BackResaBookingBundle:Configuration',1);
        $client = new \SoapClient($configResaBooking->getWsdl());
        $request = array($configResaBooking->getLogin(),$configResaBooking->getPassword(),$session,$idHotel,$pension,$chambs,$options);
        return $client->__soapCall('devis', $request);
    }

    public function createbooking($session,$travels,$organisateur,$vol,$info_agence,$note_supplementaire,$frais_supplementaire)
    {
        $configResaBooking= $this->em->find('BackResaBookingBundle:Configuration',1);
        $client = new \SoapClient($configResaBooking->getWsdl());
        $request = array($session,$travels,$organisateur,$configResaBooking->getLogin(),$configResaBooking->getPassword(), $vol, $info_agence, $note_supplementaire,$frais_supplementaire);
        return $client->__soapCall('createbooking', $request);
    }

    public function getReservation($reference)
    {
        $configResaBooking= $this->em->find('BackResaBookingBundle:Configuration',1);
        $client = new \SoapClient($configResaBooking->getWsdl());
        $request = array($configResaBooking->getLogin(),$configResaBooking->getPassword(), $reference);
        return $client->__soapCall('getreservation', $request);
    }

    public function findReservation($debut,$fin)
    {
        $configResaBooking= $this->em->find('BackResaBookingBundle:Configuration',1);
        $client = new \SoapClient($configResaBooking->getWsdl());
        $request = array($configResaBooking->getLogin(),$configResaBooking->getPassword(), $debut,$fin);
        return $client->__soapCall('findreservation', $request);
    }

    /***************************************************************************************************************************/

    public function convertRooms($room)
    {
        $tabRoom=explode(',',$room);
        $room= new room();
        for($i=1;$i<=$tabRoom[0];$i++)
            $room->addTraveller(new Traveller('adult'));
        for($i=1;$i<=count($tabRoom)-1;$i++)
            $room->addTraveller(new Traveller('enfant',$tabRoom[$i]));
        return $room;
    }

    public function getRooms($room1,$room2=null,$room3=null,$room4=null,$room5=null)
    {
        $rooms= new rooms();
        $rooms->addRoom($this->convertRooms($room1));
        if(!is_null($room2))
            $rooms->addRoom($this->convertRooms($room2));
        if(!is_null($room3))
            $rooms->addRoom($this->convertRooms($room3));
        if(!is_null($room4))
            $rooms->addRoom($this->convertRooms($room4));
        if(!is_null($room5))
            $rooms->addRoom($this->convertRooms($room5));
        return $rooms;
    }


}
