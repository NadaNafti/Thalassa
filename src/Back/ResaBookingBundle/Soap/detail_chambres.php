<?php
 namespace Back\ResaBookingBundle\Soap;

class detail_chambres
{

    /**
     * @var string $libelle_chambre
     */
    protected $libelle_chambre = null;

    /**
     * @var string $nombre_adult
     */
    protected $nombre_adult = null;

    /**
     * @var string $nombre_enfant
     */
    protected $nombre_enfant = null;

    /**
     * @var ArrayOfenfant_age $age_enfant
     */
    protected $age_enfant = null;

    /**
     * @var string $nombre_bebe
     */
    protected $nombre_bebe = null;

    /**
     * @var string $age_bebe
     */
    protected $age_bebe = null;


    public function __construct()
    {

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
     * @return detail_chambres
     */
    public function setLibelle_chambre($libelle_chambre)
    {
      $this->libelle_chambre = $libelle_chambre;
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
     * @return detail_chambres
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
     * @return detail_chambres
     */
    public function setNombre_enfant($nombre_enfant)
    {
      $this->nombre_enfant = $nombre_enfant;
      return $this;
    }

    /**
     * @return ArrayOfenfant_age
     */
    public function getAge_enfant()
    {
      return $this->age_enfant;
    }

    /**
     * @param ArrayOfenfant_age $age_enfant
     * @return detail_chambres
     */
    public function setAge_enfant($age_enfant)
    {
      $this->age_enfant = $age_enfant;
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
     * @return detail_chambres
     */
    public function setNombre_bebe($nombre_bebe)
    {
      $this->nombre_bebe = $nombre_bebe;
      return $this;
    }

    /**
     * @return string
     */
    public function getAge_bebe()
    {
      return $this->age_bebe;
    }

    /**
     * @param string $age_bebe
     * @return detail_chambres
     */
    public function setAge_bebe($age_bebe)
    {
      $this->age_bebe = $age_bebe;
      return $this;
    }

}
