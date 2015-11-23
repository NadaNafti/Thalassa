<?php
namespace Back\GeneralBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class InterfacesExtension extends \Twig_Extension
{
    protected $em;

    protected $container;

    public function __construct(EntityManager $em, Container $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'getProduitByCode'       => new \Twig_Function_Method($this, 'getProduitByCode'),
            'getRootByCode'          => new \Twig_Function_Method($this, 'getRootByCode'),
            'getRang'                => new \Twig_Function_Method($this, 'getRang'),
            'getStars'               => new \Twig_Function_Method($this, 'getStars'),
            'differenceBetweenDates' => new \Twig_Function_Method($this, 'differenceBetweenDates'),
            'functionTeste2'         => new \Twig_Function_Method($this, 'getTeste2'),
            'getAgence'              => new \Twig_Function_Method($this, 'getAgence'),
            'testeZero'              => new \Twig_Function_Method($this, 'testeZero'),
            'isZero'                 => new \Twig_Function_Method($this, 'isZero'),
            'bestChambre'            => new \Twig_Function_Method($this, 'bestChambre'),
            'getHotelResaBooking'    => new \Twig_Function_Method($this, 'getHotelResaBooking'),
            'margeResaBooking'       => new \Twig_Function_Method($this, 'margeResaBooking'),
        );
    }

    public function margeResaBooking($prix)
    {
        $config = $this->em->find('BackResaBookingBundle:Configuration', 1);
        if (!$config || is_null($config->getMarge()) || $config->getMarge() == 0)
            return $prix;
        return $prix + ($prix * $config->getMarge() / 100);
    }

    public function getHotelResaBooking($id)
    {
        return $this->em->find('BackResaBookingBundle:Hotel', $id);
    }

    public function bestChambre($chambres)
    {
        $ch = null;
        foreach ($chambres as $chambre) {
            if ($ch == null || $chambre->chambre[0]->price < $ch->price)
                $ch = $chambre->chambre[0];
        }
        return $ch;
    }

    public function getProduitByCode($code)
    {
        $produit = $this->em->getRepository('BackAdministrationBundle:Produit')->findOneBy(array('code' => $code));
        if ($produit)
            return $produit->getLibelle();
        return null;
    }

    public function getRootByCode($code)
    {
        switch ($code) {
            case 'SHT' :
                return 'consulter_reservation';
            case 'VO' :
                return 'back_voyages_organises_reservation_consulter';
            case 'PR' :
                return 'back_programmes_reservation_consulter';
            case 'BE' :
                return 'back_bienetre_reservation_consultation';
            case 'B' :
                return 'back_billetterie_reservation_consultation';
            case 'M' :
                return 'back_maritime_reservation_consultation';
        }
    }

    public function getAgence()
    {
        return $this->em->find('BackAdministrationBundle:Agence', 1);
    }

    public function getRang($r)
    {
        if ($r == 1)
            return $r . "<sup>er</sup>";
        else
            return $r . "<sup>eme</sup>";
    }


    public function isZero($r)
    {
        if ($r != 0 && !is_null($r))
            return false;
        return true;
    }


    public function testeZero($r)
    {
        if ($r != 0 && !is_null($r))
            return $r;
        return '';
    }

    public function getStars($num)
    {
        if (is_numeric($num)) {
            $stars = "";
            for ($i = 1; $i <= $num; $i++)
                $stars .= '<i class="fa fa-star fa fa-white"></i>';
            return $stars;
        } else
            return $num;
    }

    public function differenceBetweenDates($date)
    {
        $start_date = $date;
        $since_start = $start_date->diff(new \DateTime());
        if ($since_start->y == 1)
            return $since_start->y . ' Année';
        if ($since_start->y != 0)
            return $since_start->y . ' Années';
        if ($since_start->m == 1)
            return $since_start->m . ' Mois';
        if ($since_start->m != 0)
            return $since_start->m . ' Mois';
        if ($since_start->d == 1)
            return $since_start->d . ' Jour';
        if ($since_start->d != 0)
            return $since_start->d . ' Jours';
        if ($since_start->h == 1)
            return $since_start->h . ' Heure';
        if ($since_start->h != 0)
            return $since_start->h . ' Heures';
        if ($since_start->i == 1)
            return $since_start->i . ' Minute';
        if ($since_start->i != 0)
            return $since_start->i . ' Minutes';
        return $since_start->s . ' Secondes';
    }

    public function getName()
    {
        return 'SdzAntispam';
    }
    // …
}
