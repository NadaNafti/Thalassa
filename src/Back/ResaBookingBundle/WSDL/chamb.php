<?php
namespace Back\ResaBookingBundle\WSDL;

class chamb
{
    protected $code = null;
    protected $libelle_chambre = null;
    protected $libelle_chambre_en = null;
    protected $nombre_adult = null;
    protected $nombre_enfant = null;
    protected $nombre_bebe = null;
    protected $promotions = null;

    /**
     * chamb constructor.
     * @param null $code
     * @param null $libelle_chambre
     * @param null $libelle_chambre_en
     * @param null $nombre_adult
     * @param null $nombre_enfant
     * @param null $nombre_bebe
     * @param null $promotions
     */
    public function __construct($code = null, $nombre_adult = null, $nombre_enfant = null, $nombre_bebe = null, $libelle_chambre = null, $libelle_chambre_en = null, $promotions = null)
    {
        $this->code = $code;
        $this->libelle_chambre = $libelle_chambre;
        $this->libelle_chambre_en = $libelle_chambre_en;
        $this->nombre_adult = $nombre_adult;
        $this->nombre_enfant = $nombre_enfant;
        $this->nombre_bebe = $nombre_bebe;
        $this->promotions = $promotions;
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
