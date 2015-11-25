<?php

namespace Back\AdministrationBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\AdministrationBundle\Entity\EmailRepository;
use Back\HotelTunisieBundle\Entity\Reservation;

class RolesService
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getRoles()
    {
        $array = array(
            "ROLE_SUPER_ADMIN"             => "Super Admin",
            "ROLE_FRONT_CONFIG"            => "Configuration Front Office",
            "ROLE_CAISSE_SESSION"          => "Caisse Session",
            "ROLE_CAISSE_MOUVEMENT"        => "Caisse Mouvement",
            "ROLE_CAISSE_REF"              => "Caisse Réferentiel",
            "ROLE_SHT_CONFIG"              => "Hôtel en tunisie Configiuration",
            "ROLE_SHT_RESERVATION"         => "Hôtel en tunisie Réservation",
            "ROLE_SHT_REF"                 => "Hôtel en tunisie Réferentiel",
            "ROLE_SHT_HOTEL"               => "Hôtel en tunisie Gestion des hôtels",
            "ROLE_VO_RESERVATION"          => "Voyage Organisé Réservation",
            "ROLE_VO_VOYAGE"               => "Voyage Organisé Gestion desvoyages",
            "ROLE_VO_REF"                  => "Voyage Organisé Réferentiel",
            "ROLE_RESABOOKING_RESERVATION" => "ResaBooking Réservation",
            "ROLE_RESABOOKING_HOTEL"       => "ResaBooking Gestion des hôtels",
            "ROLE_RESABOOKING_CONFIG"      => "ResaBooking Configiuration",
            "ROLE_PR_RESERVATION"          => "Programme Réservation",
            "ROLE_PR_PROGRAMME"            => "Programme Gestion des programmes",
            "ROLE_PR_REF"                  => "Programme Réferentiel",
            "ROLE_BE_RESERVATION"          => "Bien-être Réservation",
            "ROLE_BE_REF"                  => "Bien-être Réferentiel",
            "ROLE_MARITIME"                => "Maritime",
            "ROLE_BIETTERIE"               => "Billetterie",
            "ROLE_TRANSFERT"               => "Transfert",
            "ROLE_DIVERS"                  => "Réservation Divers",
            "ROLE_REPORTING"               => "Reporting",
            "ROLE_B2C"                     => "B2C",
            "ROLE_CRM"                     => "CRM",
            "ROLE_ADMINISTRATION"          => "Administration",
            "ROLE_COMMERCIAL"              => "Commercial",
        );
        return $array;
    }

}
