<?php
namespace Back\HotelTunisieBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class NamesExtension extends \Twig_Extension
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            'getNameChambre'     => new \Twig_Function_Method($this, 'getNameChambre'),
            'getNameArrangement' => new \Twig_Function_Method($this, 'getNameArrangement'),
            'getCodeArrangement' => new \Twig_Function_Method($this, 'getCodeArrangement'),
            'getNameVue'         => new \Twig_Function_Method($this, 'getNameVue'),
            'getNameSupp'        => new \Twig_Function_Method($this, 'getNameSupp'),
            'getNameOption'      => new \Twig_Function_Method($this, 'getNameOption'),
            'NumVoucher'         => new \Twig_Function_Method($this, 'NumVoucher'),
            'getTexteVoucher'    => new \Twig_Function_Method($this, 'getTexteVoucher'),
            'isGoogleMaps'       => new \Twig_Function_Method($this, 'isGoogleMaps'),
            'getCodeCouleur'     => new \Twig_Function_Method($this, 'getCodeCouleur'),
            'getNameEtat'        => new \Twig_Function_Method($this, 'getNameEtat'),
            'getNameRegion'      => new \Twig_Function_Method($this, 'getNameRegion'),
            'getNameUser'        => new \Twig_Function_Method($this, 'getNameUser'),
            'getNamehotel'        => new \Twig_Function_Method($this, 'getNamehotel'),
        );
    }

    public function isGoogleMaps()
    {
        $ConfigVoucher = $this->em->getRepository("BackHotelTunisieBundle:ConfigurationVoucher")->find(1);
        if ($ConfigVoucher)
            return $ConfigVoucher->getGmaps();
        else
            return NULL;
    }

    public function getCodeCouleur()
    {
        $ConfigVoucher = $this->em->getRepository("BackHotelTunisieBundle:ConfigurationVoucher")->find(1);
        if ($ConfigVoucher)
            return $ConfigVoucher->getCodeCouleur();
        else
            return NULL;
    }

    public function getTexteVoucher()
    {
        $ConfigVoucher = $this->em->getRepository("BackHotelTunisieBundle:ConfigurationVoucher")->find(1);
        if ($ConfigVoucher)
            return $ConfigVoucher->getTexteVoucher();
        else
            return NULL;
    }

    public function NumVoucher($id)
    {
        $reservation = $this->em->getRepository("BackHotelTunisieBundle:Reservation")->find($id);
        $ConfigVoucher = $this->em->getRepository("BackHotelTunisieBundle:ConfigurationVoucher")->find(1);
        if ($reservation && !is_null($reservation->getCode())) {
            if ($ConfigVoucher) {
                if ($ConfigVoucher->getTypeNumerotation() == 1)
                    return $reservation->getValidated()->format('Y') . sprintf("%'.06d\n", $reservation->getCode());
                if ($ConfigVoucher->getTypeNumerotation() == 2)
                    return $reservation->getCode() . $reservation->getValidated()->format('/m/Y');
            } else
                return $reservation->getCode();
        } else
            return 'Pas de Numéro';
    }

    public function getNamehotel($id)
    {
        $hotel = $this->em->getRepository("BackHotelTunisieBundle:Hotel")->find($id);
        return $hotel->getLibelle();
    }

    public function getNameChambre($id)
    {
        $chambre = $this->em->getRepository("BackHotelTunisieBundle:Chambre")->find($id);
        return $chambre->getLibelle();
    }

    public function getNameRegion($id)
    {
        $region = $this->em->getRepository("BackHotelTunisieBundle:Region")->find($id);
        return $region->getLibelle();
    }

    public function getNameUser($id)
    {
        $user = $this->em->getRepository("BackUserBundle:User")->find($id);
        return $user->getUsername();
    }

    public function getNameArrangement($id)
    {
        $arrangement = $this->em->getRepository("BackHotelTunisieBundle:Arrangement")->find($id);
        return $arrangement->getLibelle();
    }

    public function getCodeArrangement($id)
    {
        $arrangement = $this->em->getRepository("BackHotelTunisieBundle:Arrangement")->find($id);
        return $arrangement->getCode();
    }

    public function getNameVue($id)
    {
        $arrangement = $this->em->getRepository("BackHotelTunisieBundle:Vue")->find($id);
        return $arrangement->getLibelle();
    }

    public function getNameSupp($id)
    {
        $arrangement = $this->em->getRepository("BackHotelTunisieBundle:Supplement")->find($id);
        return $arrangement->getLibelle();
    }

    public function getNameEtat($id)
    {
        switch ($id) {
            case "1":
                return 'Enregistrée';
            case "2":
                return 'Validée';
            case "9":
                return 'Annulée';
        }
    }

    public function getNameOption($id)
    {
        $option = $this->em->getRepository("BackHotelTunisieBundle:Optionn")->find($id);
        return $option->getLibelle();
    }

    public function getName()
    {
        return 'NamesExtension';
    }
}
