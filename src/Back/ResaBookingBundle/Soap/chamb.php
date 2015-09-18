<?php
 namespace Back\ResaBookingBundle\Soap;

class chamb
{

    /**
     * @var string $code
     */
    protected $code = null;

    /**
     * @var string $libelle_chambre
     */
    protected $libelle_chambre = null;

    /**
     * @var string $libelle_chambre_en
     */
    protected $libelle_chambre_en = null;

    /**
     * @var string $nombre_adult
     */
    protected $nombre_adult = null;

    /**
     * @var string $nombre_enfant
     */
    protected $nombre_enfant = null;

    /**
     * @var string $nombre_bebe
     */
    protected $nombre_bebe = null;

    /**
     * @var ArrayOfpromotion $promotions
     */
    protected $promotions = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getCode()
    {
      return $this->code;
    }

    /**
     * @param string $code
     * @return chamb
     */
    public function setCode($code)
    {
      $this->code = $code;
      return $this;
    }

    /**
     * @return string
     */
    public function getLibelle_chambre()
    {
      return $this->libelle_chambre;
    }

    /**
     * @param string $libelle_chambre
     * @return chamb
     */
    public function setLibelle_chambre($libelle_chambre)
    {
      $this->libelle_chambre = $libelle_chambre;
      return $this;
    }

    /**
     * @return string
     */
    public function getLibelle_chambre_en()
    {
      return $this->libelle_chambre_en;
    }

    /**
     * @param string $libelle_chambre_en
     * @return chamb
     */
    public function setLibelle_chambre_en($libelle_chambre_en)
    {
      $this->libelle_chambre_en = $libelle_chambre_en;
      return $this;
    }

    /**
     * @return string
     */
    public function getNombre_adult()
    {
      return $this->nombre_adult;
    }

    /**
     * @param string $nombre_adult
     * @return chamb
     */
    public function setNombre_adult($nombre_adult)
    {
      $this->nombre_adult = $nombre_adult;
      return $this;
    }

    /**
     * @return string
     */
    public function getNombre_enfant()
    {
      return $this->nombre_enfant;
    }

    /**
     * @param string $nombre_enfant
     * @return chamb
     */
    public function setNombre_enfant($nombre_enfant)
    {
      $this->nombre_enfant = $nombre_enfant;
      return $this;
    }

    /**
     * @return string
     */
    public function getNombre_bebe()
    {
      return $this->nombre_bebe;
    }

    /**
     * @param string $nombre_bebe
     * @return chamb
     */
    public function setNombre_bebe($nombre_bebe)
    {
      $this->nombre_bebe = $nombre_bebe;
      return $this;
    }

    /**
     * @return ArrayOfpromotion
     */
    public function getPromotions()
    {
      return $this->promotions;
    }

    /**
     * @param ArrayOfpromotion $promotions
     * @return chamb
     */
    public function setPromotions($promotions)
    {
      $this->promotions = $promotions;
      return $this;
    }

}
