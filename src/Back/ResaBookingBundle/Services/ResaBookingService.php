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

    public function getCode()
    {
//        $client = new \SoapClient('http://www.resabooking.com/auto_hot_xft_test.php?wsdl');
////        $result = $client->call('hello', array('name' => 'Scott'));
//        $request=array(
//            "Ville"=>"hammamet",
//            "login"=>"olevoyage",
//            "pw"=>"olevoyage2015",
//            "Debut"=>"2015-11-10",
//            "Fin"=>"2015-11-12",
//            "Rooms"=>"",
//            "Marche"=>"Magrabein",
//            "Langue"=>"fr",
//            "Monnaie"=>"dt",
//        );
//        $reponse = $client->__soapCall( 'availabilityhotel', $request );
//        dump($reponse);
    }


}
