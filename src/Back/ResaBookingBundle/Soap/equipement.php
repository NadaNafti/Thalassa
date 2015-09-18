<?php
 namespace Back\ResaBookingBundle\Soap;

class equipement
{

    /**
     * @var string $nom
     */
    protected $nom = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getNom()
    {
      return $this->nom;
    }

    /**
     * @param string $nom
     * @return equipement
     */
    public function setNom($nom)
    {
      $this->nom = $nom;
      return $this;
    }

}
