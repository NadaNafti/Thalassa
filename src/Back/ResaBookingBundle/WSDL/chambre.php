<?php
namespace Back\ResaBookingBundle\WSDL;

class chambre
{

    protected $pension = null;
    protected $libelle_pension = null;
    protected $libelle_pension_en = null;
    protected $price = null;
    protected $price_ad = null;
    protected $price_ef = null;
    protected $commission = null;
    protected $price_TB = null;
    protected $price_net = null;
    protected $reduction_iphone = null;
    protected $price_sup_obligatire = null;
    protected $liste_suplement_obligatoire = null;
    protected $chamb = null;

    /**
     * chambre constructor.
     * @param null $pension
     * @param null $libelle_pension
     * @param null $libelle_pension_en
     * @param null $price
     * @param null $price_ad
     * @param null $price_ef
     * @param null $commission
     * @param null $price_TB
     * @param null $price_net
     * @param null $reduction_iphone
     * @param null $price_sup_obligatire
     * @param null $liste_suplement_obligatoire
     * @param null $chamb
     */
    public function __construct($pension= null, $libelle_pension= null, $libelle_pension_en= null, $price= null, $price_ad= null, $price_ef= null, $commission= null, $price_TB= null, $price_net= null, $reduction_iphone= null, $price_sup_obligatire= null, $liste_suplement_obligatoire= null, $chamb= null)
    {
        $this->pension = $pension;
        $this->libelle_pension = $libelle_pension;
        $this->libelle_pension_en = $libelle_pension_en;
        $this->price = $price;
        $this->price_ad = $price_ad;
        $this->price_ef = $price_ef;
        $this->commission = $commission;
        $this->price_TB = $price_TB;
        $this->price_net = $price_net;
        $this->reduction_iphone = $reduction_iphone;
        $this->price_sup_obligatire = $price_sup_obligatire;
        $this->liste_suplement_obligatoire = $liste_suplement_obligatoire;
        $this->chamb = $chamb;
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
