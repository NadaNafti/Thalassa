<?php
 namespace Back\ResaBookingBundle\Soap;

class ficheproduit
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $session
     */
    protected $session = null;

    /**
     * @var string $hotel
     */
    protected $hotel = null;

    /**
     * @var string $id_hotel
     */
    protected $id_hotel = null;

    /**
     * @var string $etoile
     */
    protected $etoile = null;

    /**
     * @var string $image
     */
    protected $image = null;

    /**
     * @var string $image1
     */
    protected $image1 = null;

    /**
     * @var string $image2
     */
    protected $image2 = null;

    /**
     * @var string $image3
     */
    protected $image3 = null;

    /**
     * @var string $image4
     */
    protected $image4 = null;

    /**
     * @var string $image5
     */
    protected $image5 = null;

    /**
     * @var string $image6
     */
    protected $image6 = null;

    /**
     * @var string $accroche
     */
    protected $accroche = null;

    /**
     * @var string $descriptif
     */
    protected $descriptif = null;

    /**
     * @var string $adresse
     */
    protected $adresse = null;

    /**
     * @var string $checkin
     */
    protected $checkin = null;

    /**
     * @var string $checkout
     */
    protected $checkout = null;

    /**
     * @var ArrayOfequipement $equipement
     */
    protected $equipement = null;


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
     * @return ficheproduit
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
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
     * @return ficheproduit
     */
    public function setSession($session)
    {
      $this->session = $session;
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
     * @return ficheproduit
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
     * @return ficheproduit
     */
    public function setId_hotel($id_hotel)
    {
      $this->id_hotel = $id_hotel;
      return $this;
    }

    /**
     * @return string
     */
    public function getEtoile()
    {
      return $this->etoile;
    }

    /**
     * @param string $etoile
     * @return ficheproduit
     */
    public function setEtoile($etoile)
    {
      $this->etoile = $etoile;
      return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
      return $this->image;
    }

    /**
     * @param string $image
     * @return ficheproduit
     */
    public function setImage($image)
    {
      $this->image = $image;
      return $this;
    }

    /**
     * @return string
     */
    public function getImage1()
    {
      return $this->image1;
    }

    /**
     * @param string $image1
     * @return ficheproduit
     */
    public function setImage1($image1)
    {
      $this->image1 = $image1;
      return $this;
    }

    /**
     * @return string
     */
    public function getImage2()
    {
      return $this->image2;
    }

    /**
     * @param string $image2
     * @return ficheproduit
     */
    public function setImage2($image2)
    {
      $this->image2 = $image2;
      return $this;
    }

    /**
     * @return string
     */
    public function getImage3()
    {
      return $this->image3;
    }

    /**
     * @param string $image3
     * @return ficheproduit
     */
    public function setImage3($image3)
    {
      $this->image3 = $image3;
      return $this;
    }

    /**
     * @return string
     */
    public function getImage4()
    {
      return $this->image4;
    }

    /**
     * @param string $image4
     * @return ficheproduit
     */
    public function setImage4($image4)
    {
      $this->image4 = $image4;
      return $this;
    }

    /**
     * @return string
     */
    public function getImage5()
    {
      return $this->image5;
    }

    /**
     * @param string $image5
     * @return ficheproduit
     */
    public function setImage5($image5)
    {
      $this->image5 = $image5;
      return $this;
    }

    /**
     * @return string
     */
    public function getImage6()
    {
      return $this->image6;
    }

    /**
     * @param string $image6
     * @return ficheproduit
     */
    public function setImage6($image6)
    {
      $this->image6 = $image6;
      return $this;
    }

    /**
     * @return string
     */
    public function getAccroche()
    {
      return $this->accroche;
    }

    /**
     * @param string $accroche
     * @return ficheproduit
     */
    public function setAccroche($accroche)
    {
      $this->accroche = $accroche;
      return $this;
    }

    /**
     * @return string
     */
    public function getDescriptif()
    {
      return $this->descriptif;
    }

    /**
     * @param string $descriptif
     * @return ficheproduit
     */
    public function setDescriptif($descriptif)
    {
      $this->descriptif = $descriptif;
      return $this;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
      return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return ficheproduit
     */
    public function setAdresse($adresse)
    {
      $this->adresse = $adresse;
      return $this;
    }

    /**
     * @return string
     */
    public function getCheckin()
    {
      return $this->checkin;
    }

    /**
     * @param string $checkin
     * @return ficheproduit
     */
    public function setCheckin($checkin)
    {
      $this->checkin = $checkin;
      return $this;
    }

    /**
     * @return string
     */
    public function getCheckout()
    {
      return $this->checkout;
    }

    /**
     * @param string $checkout
     * @return ficheproduit
     */
    public function setCheckout($checkout)
    {
      $this->checkout = $checkout;
      return $this;
    }

    /**
     * @return ArrayOfequipement
     */
    public function getEquipement()
    {
      return $this->equipement;
    }

    /**
     * @param ArrayOfequipement $equipement
     * @return ficheproduit
     */
    public function setEquipement($equipement)
    {
      $this->equipement = $equipement;
      return $this;
    }

}
