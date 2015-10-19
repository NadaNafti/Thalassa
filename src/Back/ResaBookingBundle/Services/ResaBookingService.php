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
        $request = array($_SERVER["REMOTE_ADDR"],
            $ville,
            $idHotel,
            $debut,
            $fin,
            $rooms,
            $configResaBooking->getLogin(),
            $configResaBooking->getPassword(),
            "fr",
            "Magrabein",
            "dt"
        );
        return $client->__soapCall('availabilityhotel', $request);
    }


}
