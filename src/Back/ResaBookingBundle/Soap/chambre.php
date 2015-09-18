<?php
 namespace Back\ResaBookingBundle\Soap;

class chambre
{

    /**
     * @var string $pension
     */
    protected $pension = null;

    /**
     * @var string $libelle_pension
     */
    protected $libelle_pension = null;

    /**
     * @var string $libelle_pension_en
     */
    protected $libelle_pension_en = null;

    /**
     * @var string $price
     */
    protected $price = null;

    /**
     * @var string $price_ad
     */
    protected $price_ad = null;

    /**
     * @var string $price_ef
     */
    protected $price_ef = null;

    /**
     * @var string $commission
     */
    protected $commission = null;

    /**
     * @var string $price_TB
     */
    protected $price_TB = null;

    /**
     * @var string $price_net
     */
    protected $price_net = null;

    /**
     * @var string $reduction_iphone
     */
    protected $reduction_iphone = null;

    /**
     * @var string $price_sup_obligatire
     */
    protected $price_sup_obligatire = null;

    /**
     * @var ArrayOfliste_suplement_obligatoire $liste_suplement_obligatoire
     */
    protected $liste_suplement_obligatoire = null;

    /**
     * @var ArrayOfchamb $chamb
     */
    protected $chamb = null;


    public function __construct()
    {

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
     * @return chambre
     */
    public function setPension($pension)
    {
      $this->pension = $pension;
      return $this;
    }

    /**
     * @return string
     */
    public function getLibelle_pension()
    {
      return $this->libelle_pension;
    }

    /**
     * @param string $libelle_pension
     * @return chambre
     */
    public function setLibelle_pension($libelle_pension)
    {
      $this->libelle_pension = $libelle_pension;
      return $this;
    }

    /**
     * @return string
     */
    public function getLibelle_pension_en()
    {
      return $this->libelle_pension_en;
    }

    /**
     * @param string $libelle_pension_en
     * @return chambre
     */
    public function setLibelle_pension_en($libelle_pension_en)
    {
      $this->libelle_pension_en = $libelle_pension_en;
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
     * @return chambre
     */
    public function setPrice($price)
    {
      $this->price = $price;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_ad()
    {
      return $this->price_ad;
    }

    /**
     * @param string $price_ad
     * @return chambre
     */
    public function setPrice_ad($price_ad)
    {
      $this->price_ad = $price_ad;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_ef()
    {
      return $this->price_ef;
    }

    /**
     * @param string $price_ef
     * @return chambre
     */
    public function setPrice_ef($price_ef)
    {
      $this->price_ef = $price_ef;
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
     * @return chambre
     */
    public function setCommission($commission)
    {
      $this->commission = $commission;
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
     * @return chambre
     */
    public function setPrice_TB($price_TB)
    {
      $this->price_TB = $price_TB;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_net()
    {
      return $this->price_net;
    }

    /**
     * @param string $price_net
     * @return chambre
     */
    public function setPrice_net($price_net)
    {
      $this->price_net = $price_net;
      return $this;
    }

    /**
     * @return string
     */
    public function getReduction_iphone()
    {
      return $this->reduction_iphone;
    }

    /**
     * @param string $reduction_iphone
     * @return chambre
     */
    public function setReduction_iphone($reduction_iphone)
    {
      $this->reduction_iphone = $reduction_iphone;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrice_sup_obligatire()
    {
      return $this->price_sup_obligatire;
    }

    /**
     * @param string $price_sup_obligatire
     * @return chambre
     */
    public function setPrice_sup_obligatire($price_sup_obligatire)
    {
      $this->price_sup_obligatire = $price_sup_obligatire;
      return $this;
    }

    /**
     * @return ArrayOfliste_suplement_obligatoire
     */
    public function getListe_suplement_obligatoire()
    {
      return $this->liste_suplement_obligatoire;
    }

    /**
     * @param ArrayOfliste_suplement_obligatoire $liste_suplement_obligatoire
     * @return chambre
     */
    public function setListe_suplement_obligatoire($liste_suplement_obligatoire)
    {
      $this->liste_suplement_obligatoire = $liste_suplement_obligatoire;
      return $this;
    }

    /**
     * @return ArrayOfchamb
     */
    public function getChamb()
    {
      return $this->chamb;
    }

    /**
     * @param ArrayOfchamb $chamb
     * @return chambre
     */
    public function setChamb($chamb)
    {
      $this->chamb = $chamb;
      return $this;
    }

}
