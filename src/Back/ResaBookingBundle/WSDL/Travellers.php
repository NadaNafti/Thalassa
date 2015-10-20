<?php
namespace Back\ResaBookingBundle\WSDL;

class Travellers
{

    /**
     * @var ArrayOfTraveller $Traveller
     */
    protected $Traveller = null;

    /**
     * @var Traveller $organisateur
     */
    protected $organisateur = null;

    
    public function __construct()
    {
        $this->Traveller=array();
    }

    public function addTraveller(Traveller $traveller)
    {
        $this->Traveller[]=$traveller;
    }

    /**
     * @return ArrayOfTraveller
     */
    public function getTraveller()
    {
      return $this->Traveller;
    }

    /**
     * @param ArrayOfTraveller $Traveller
     * @return Travellers
     */
    public function setTraveller($Traveller)
    {
      $this->Traveller = $Traveller;
      return $this;
    }

    /**
     * @return Traveller
     */
    public function getOrganisateur()
    {
      return $this->organisateur;
    }

    /**
     * @param Traveller $organisateur
     * @return Travellers
     */
    public function setOrganisateur($organisateur)
    {
      $this->organisateur = $organisateur;
      return $this;
    }

}
