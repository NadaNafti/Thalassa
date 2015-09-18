<?php
 namespace Back\ResaBookingBundle\Soap;

class booking
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $price
     */
    protected $price = null;

    /**
     * @var string $price_TB
     */
    protected $price_TB = null;

    /**
     * @var string $commission
     */
    protected $commission = null;

    /**
     * @var string $price_sej
     */
    protected $price_sej = null;

    /**
     * @var string $price_sej_TB
     */
    protected $price_sej_TB = null;

    /**
     * @var string $price_vm
     */
    protected $price_vm = null;

    /**
     * @var string $price_trsf
     */
    protected $price_trsf = null;

    /**
     * @var string $nbtraveler
     */
    protected $nbtraveler = null;

    /**
     * @var string $nbadult
     */
    protected $nbadult = null;

    /**
     * @var string $nbenfant
     */
    protected $nbenfant = null;

    /**
     * @var string $nbbebe
     */
    protected $nbbebe = null;

    /**
     * @var string $hotel
     */
    protected $hotel = null;

    /**
     * @var string $id_hotel
     */
    protected $id_hotel = null;

    /**
     * @var string $session
     */
    protected $session = null;

    /**
     * @var string $pension
     */
    protected $pension = null;

    /**
     * @var ArrayOfchamb $choix
     */
    protected $choix = null;

    /**
     * @var ArrayOfpolicy $policy
     */
    protected $policy = null;


    public function __construct()
    {

    }

    /**
     * @return reponse
     */
    public function getRep()
    {
      return $this->rep;
    }

    /**
     * @param reponse $rep
     * @return booking
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
      return $this->price;
    }

    /**
     * @param string $price
     * @return booking
     */
    public function setPrice($price)
    {
      $this->price = $price;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_TB()
    {
      return $this->price_TB;
    }

    /**
     * @param string $price_TB
     * @return booking
     */
    public function setPrice_TB($price_TB)
    {
      $this->price_TB = $price_TB;
      return $this;
    }

    /**
     * @return string
     */
    public function getCommission()
    {
      return $this->commission;
    }

    /**
     * @param string $commission
     * @return booking
     */
    public function setCommission($commission)
    {
      $this->commission = $commission;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_sej()
    {
      return $this->price_sej;
    }

    /**
     * @param string $price_sej
     * @return booking
     */
    public function setPrice_sej($price_sej)
    {
      $this->price_sej = $price_sej;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_sej_TB()
    {
      return $this->price_sej_TB;
    }

    /**
     * @param string $price_sej_TB
     * @return booking
     */
    public function setPrice_sej_TB($price_sej_TB)
    {
      $this->price_sej_TB = $price_sej_TB;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_vm()
    {
      return $this->price_vm;
    }

    /**
     * @param string $price_vm
     * @return booking
     */
    public function setPrice_vm($price_vm)
    {
      $this->price_vm = $price_vm;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_trsf()
    {
      return $this->price_trsf;
    }

    /**
     * @param string $price_trsf
     * @return booking
     */
    public function setPrice_trsf($price_trsf)
    {
      $this->price_trsf = $price_trsf;
      return $this;
    }

    /**
     * @return string
     */
    public function getNbtraveler()
    {
      return $this->nbtraveler;
    }

    /**
     * @param string $nbtraveler
     * @return booking
     */
    public function setNbtraveler($nbtraveler)
    {
      $this->nbtraveler = $nbtraveler;
      return $this;
    }

    /**
     * @return string
     */
    public function getNbadult()
    {
      return $this->nbadult;
    }

    /**
     * @param string $nbadult
     * @return booking
     */
    public function setNbadult($nbadult)
    {
      $this->nbadult = $nbadult;
      return $this;
    }

    /**
     * @return string
     */
    public function getNbenfant()
    {
      return $this->nbenfant;
    }

    /**
     * @param string $nbenfant
     * @return booking
     */
    public function setNbenfant($nbenfant)
    {
      $this->nbenfant = $nbenfant;
      return $this;
    }

    /**
     * @return string
     */
    public function getNbbebe()
    {
      return $this->nbbebe;
    }

    /**
     * @param string $nbbebe
     * @return booking
     */
    public function setNbbebe($nbbebe)
    {
      $this->nbbebe = $nbbebe;
      return $this;
    }

    /**
     * @return string
     */
    public function getHotel()
    {
      return $this->hotel;
    }

    /**
     * @param string $hotel
     * @return booking
     */
    public function setHotel($hotel)
    {
      $this->hotel = $hotel;
      return $this;
    }

    /**
     * @return string
     */
    public function getId_hotel()
    {
      return $this->id_hotel;
    }

    /**
     * @param string $id_hotel
     * @return booking
     */
    public function setId_hotel($id_hotel)
    {
      $this->id_hotel = $id_hotel;
      return $this;
    }

    /**
     * @return string
     */
    public function getSession()
    {
      return $this->session;
    }

    /**
     * @param string $session
     * @return booking
     */
    public function setSession($session)
    {
      $this->session = $session;
      return $this;
    }

    /**
     * @return string
     */
    public function getPension()
    {
      return $this->pension;
    }

    /**
     * @param string $pension
     * @return booking
     */
    public function setPension($pension)
    {
      $this->pension = $pension;
      return $this;
    }

    /**
     * @return ArrayOfchamb
     */
    public function getChoix()
    {
      return $this->choix;
    }

    /**
     * @param ArrayOfchamb $choix
     * @return booking
     */
    public function setChoix($choix)
    {
      $this->choix = $choix;
      return $this;
    }

    /**
     * @return ArrayOfpolicy
     */
    public function getPolicy()
    {
      return $this->policy;
    }

    /**
     * @param ArrayOfpolicy $policy
     * @return booking
     */
    public function setPolicy($policy)
    {
      $this->policy = $policy;
      return $this;
    }

}
