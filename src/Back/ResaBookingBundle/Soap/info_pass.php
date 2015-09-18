<?php
 namespace Back\ResaBookingBundle\Soap;

class info_pass
{

    /**
     * @var string $civilite
     */
    protected $civilite = null;

    /**
     * @var string $nom
     */
    protected $nom = null;

    /**
     * @var string $prenom
     */
    protected $prenom = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getCivilite()
    {
      return $this->civilite;
    }

    /**
     * @param string $civilite
     * @return info_pass
     */
    public function setCivilite($civilite)
    {
      $this->civilite = $civilite;
      return $this;
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
     * @return info_pass
     */
    public function setNom($nom)
    {
      $this->nom = $nom;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
      return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return info_pass
     */
    public function setPrenom($prenom)
    {
      $this->prenom = $prenom;
      return $this;
    }

}
