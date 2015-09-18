<?php
 namespace Back\ResaBookingBundle\Soap;

class hot
{

    /**
     * @var string $etoile
     */
    protected $etoile = null;

    /**
     * @var string $accroche
     */
    protected $accroche = null;

    /**
     * @var string $info_supplementaire
     */
    protected $info_supplementaire = null;

    /**
     * @var string $min_age_bebe
     */
    protected $min_age_bebe = null;

    /**
     * @var string $max_age_bebe
     */
    protected $max_age_bebe = null;

    /**
     * @var string $min_age_enfant
     */
    protected $min_age_enfant = null;

    /**
     * @var string $max_age_enfant
     */
    protected $max_age_enfant = null;

    /**
     * @var string $id
     */
    protected $id = null;

    /**
     * @var string $libelle
     */
    protected $libelle = null;

    /**
     * @var string $image
     */
    protected $image = null;

    /**
     * @var ArrayOfchambres $chambres
     */
    protected $chambres = null;

    /**
     * @var ArrayOfpolicy $policy
     */
    protected $policy = null;


    public function __construct()
    {

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
     * @return hot
     */
    public function setEtoile($etoile)
    {
      $this->etoile = $etoile;
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
     * @return hot
     */
    public function setAccroche($accroche)
    {
      $this->accroche = $accroche;
      return $this;
    }

    /**
     * @return string
     */
    public function getInfo_supplementaire()
    {
      return $this->info_supplementaire;
    }

    /**
     * @param string $info_supplementaire
     * @return hot
     */
    public function setInfo_supplementaire($info_supplementaire)
    {
      $this->info_supplementaire = $info_supplementaire;
      return $this;
    }

    /**
     * @return string
     */
    public function getMin_age_bebe()
    {
      return $this->min_age_bebe;
    }

    /**
     * @param string $min_age_bebe
     * @return hot
     */
    public function setMin_age_bebe($min_age_bebe)
    {
      $this->min_age_bebe = $min_age_bebe;
      return $this;
    }

    /**
     * @return string
     */
    public function getMax_age_bebe()
    {
      return $this->max_age_bebe;
    }

    /**
     * @param string $max_age_bebe
     * @return hot
     */
    public function setMax_age_bebe($max_age_bebe)
    {
      $this->max_age_bebe = $max_age_bebe;
      return $this;
    }

    /**
     * @return string
     */
    public function getMin_age_enfant()
    {
      return $this->min_age_enfant;
    }

    /**
     * @param string $min_age_enfant
     * @return hot
     */
    public function setMin_age_enfant($min_age_enfant)
    {
      $this->min_age_enfant = $min_age_enfant;
      return $this;
    }

    /**
     * @return string
     */
    public function getMax_age_enfant()
    {
      return $this->max_age_enfant;
    }

    /**
     * @param string $max_age_enfant
     * @return hot
     */
    public function setMax_age_enfant($max_age_enfant)
    {
      $this->max_age_enfant = $max_age_enfant;
      return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
      return $this->id;
    }

    /**
     * @param string $id
     * @return hot
     */
    public function setId($id)
    {
      $this->id = $id;
      return $this;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
      return $this->libelle;
    }

    /**
     * @param string $libelle
     * @return hot
     */
    public function setLibelle($libelle)
    {
      $this->libelle = $libelle;
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
     * @return hot
     */
    public function setImage($image)
    {
      $this->image = $image;
      return $this;
    }

    /**
     * @return ArrayOfchambres
     */
    public function getChambres()
    {
      return $this->chambres;
    }

    /**
     * @param ArrayOfchambres $chambres
     * @return hot
     */
    public function setChambres($chambres)
    {
      $this->chambres = $chambres;
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
     * @return hot
     */
    public function setPolicy($policy)
    {
      $this->policy = $policy;
      return $this;
    }

}
