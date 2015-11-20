<?php

namespace Back\HotelTunisieBundle\Services;

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

class ReportingSHTService
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

    public function getNameMonth($i)
    {
        switch  ($i)
        {
            case 1: return 'Janvier';
            case 2: return 'Février';
            case 3: return 'Mars';
            case 4: return 'Avril';
            case 5: return 'Mai';
            case 6: return 'Juin';
            case 7: return 'Juillet';
            case 8: return 'Août';
            case 9: return 'Septembre';
            case 10: return 'Octobre';
            case 11: return 'Novembre';
            case 12: return 'Decembre';
        }
    }

    public function getDataParHotel($mois, $annee, $etat, $regions, $hotels, $users,$typeStatistique)
    {
        $hotelsFind=$this->em->getRepository('BackHotelTunisieBundle:Hotel')->getFromString($hotels,$regions);
        $monthFound=($mois=='all')?array(1,2,3,4,5,6,7,8,9,10,11,12):explode(',',$mois);
        $data=array();
        $ligne[]='Par Hôtel ('.$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions, $hotels, $users).')';
        foreach($monthFound as $month)
            $ligne[]=$this->getNameMonth($month)." (".$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $regions, $hotels, $users).")";
        $data[]=$ligne;
        foreach($hotelsFind as $hotel)
        {
            $ligne=array();
            $total=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions, $hotel->getId(), $users);
            if($total!=0 /*|| $hotels='all'*/)
            {
                $ligne[]=$hotel->getLibelle()." (".$total.')';
                foreach($monthFound as $month)
                    $ligne[]=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $regions, $hotel->getId(), $users);
                $data[]=$ligne;
            }
        }
        return $data;
    }

    public function getDataParRegion($mois, $annee, $etat, $regions, $hotels, $users,$typeStatistique)
    {
        $regionsFind=$this->em->getRepository('BackHotelTunisieBundle:Region')->getFromString($regions);
        $monthFound=($mois=='all')?array(1,2,3,4,5,6,7,8,9,10,11,12):explode(',',$mois);
        $data=array();
        $ligne[]='Par Région ('.$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions, $hotels, $users).')';
        foreach($monthFound as $month)
            $ligne[]=$this->getNameMonth($month)." (".$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $regions, $hotels, $users).")";
        $data[]=$ligne;
        foreach($regionsFind as $region)
        {
            $ligne=array();
            $total=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $region->getId(), $hotels, $users);
            if($total!=0 /*|| $regions='all'*/)
            {
                $ligne[]=$region->getLibelle()." (".$total.')';
                foreach($monthFound as $month)
                    $ligne[]=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $region->getId(), $hotels, $users);
                $data[]=$ligne;
            }
        }
        return $data;
    }

    public function getDataParOperateur($mois, $annee, $etat, $regions, $hotels, $users,$typeStatistique)
    {
        $usersFind=$this->em->getRepository('BackUserBundle:User')->getFromString($users);
        $monthFound=($mois=='all')?array(1,2,3,4,5,6,7,8,9,10,11,12):explode(',',$mois);
        $data=array();
        $ligne[]='Par Operateur ('.$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions, $hotels, $users).')';
        foreach($monthFound as $month)
            $ligne[]=$this->getNameMonth($month)." (".$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $regions, $hotels, $users).")";
        $data[]=$ligne;
        foreach($usersFind as $user)
        {
            $ligne=array();
            $total=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions, $hotels, $user->getId());
            if($total!=0)
            {
                $ligne[]=$user->getUsername()." (".$total.')';
                foreach($monthFound as $month)
                    $ligne[]=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $regions, $hotels, $user->getId());
                $data[]=$ligne;
            }
        }
        return $data;
    }

    public function getDataParSource($mois, $annee, $etat, $regions, $hotels, $users,$typeStatistique)
    {
        $sourceFound=array('b','f');
        $monthFound=($mois=='all')?array(1,2,3,4,5,6,7,8,9,10,11,12):explode(',',$mois);
        $data=array();
        $ligne[]='Par Source ('.$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions, $hotels, $users).')';
        foreach($monthFound as $month)
            $ligne[]=$this->getNameMonth($month)." (".$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $regions, $hotels, $users).")";
        $data[]=$ligne;
        foreach($sourceFound as $source)
        {
            $ligne=array();
            $total=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat, $regions, $hotels, $users,$source);
            if($total!=0)
            {
                if($source=='b')
                    $ligne[]='Back Office'." (".$total.')';
                else
                    $ligne[]='Front Office'." (".$total.')';
                foreach($monthFound as $month)
                    $ligne[]=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat, $regions, $hotels, $users,$source);
                $data[]=$ligne;
            }
        }
        return $data;
    }

    public function updateChiffreAffaireHotels($hotels,$regions)
    {
        $reservations=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getFromString($hotels,$regions);
        foreach($reservations as $reservation)
        {
            $reservation->setChiffreAffaire($reservation->getChiffreAffaire());
            $this->em->persist($reservation);
        }
        $this->em->flush();
    }

    public function getDataParArrangement($mois, $annee, $etat,$typeStatistique)
    {
        $arrangements=$this->em->getRepository('BackHotelTunisieBundle:Arrangement')->findAll();
        $monthFound=($mois=='all')?array(1,2,3,4,5,6,7,8,9,10,11,12):explode(',',$mois);
        $data=array();
        $ligne[]='Chambres ('.$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat).')';
        foreach($monthFound as $month)
            $ligne[]=$this->getNameMonth($month)." (".$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat).")";
        $data[]=$ligne;
        foreach($arrangements as $arrangement)
        {
            $ligne=array();
            $total=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat,'all','all','all','all',$arrangement->getId());
            if($total!=0)
            {
                $ligne[]=$arrangement->getLibelle()." (".$total.')';
                foreach($monthFound as $month)
                    $ligne[]=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat,'all','all','all','all',$arrangement->getId());
                $data[]=$ligne;
            }
        }
        return $data;
    }

    public function getDataParChambre($mois, $annee, $etat,$typeStatistique)
    {
        $chambres=$this->em->getRepository('BackHotelTunisieBundle:Chambre')->findAll();
        $monthFound=($mois=='all')?array(1,2,3,4,5,6,7,8,9,10,11,12):explode(',',$mois);
        $data=array();
        $ligne[]='Chambres ('.$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat).')';
        foreach($monthFound as $month)
            $ligne[]=$this->getNameMonth($month)." (".$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat).")";
        $data[]=$ligne;
        foreach($chambres as $chambre)
        {
            $ligne=array();
            $total=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$mois, $annee, $etat,'all','all','all','all','all',$chambre->getId());
            if($total!=0)
            {
                $ligne[]=$chambre->getLibelle()." (".$total.')';
                foreach($monthFound as $month)
                    $ligne[]=$this->em->getRepository('BackHotelTunisieBundle:Reservation')->getNombreReservaion($typeStatistique,$month, $annee, $etat,'all','all','all','all','all',$chambre->getId());
                $data[]=$ligne;
            }
        }
        return $data;
    }

}
