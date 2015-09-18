<?php
 namespace Back\ResaBookingBundle\Soap;

class option
{

    /**
     * @var string $nom
     */
    protected $nom = null;

    /**
     * @var string $enfant
     */
    protected $enfant = null;

    /**
     * @var string $prix
     */
    protected $prix = null;

    /**
     * @var string $typ
     */
    protected $typ = null;

    /**
     * @var string $type_option
     */
    protected $type_option = null;

    /**
     * @var string $pourcentage
     */
    protected $pourcentage = null;


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
     * @return option
     */
    public function setNom($nom)
    {
      $this->nom = $nom;
      return $this;
    }

    /**
     * @return string
     */
    public function getEnfant()
    {
      return $this->enfant;
    }

    /**
     * @param string $enfant
     * @return option
     */
    public function setEnfant($enfant)
    {
      $this->enfant = $enfant;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrix()
    {
      return $this->prix;
    }

    /**
     * @param string $prix
     * @return option
     */
    public function setPrix($prix)
    {
      $this->prix = $prix;
      return $this;
    }

    /**
     * @return string
     */
    public function getTyp()
    {
      return $this->typ;
    }

    /**
     * @param string $typ
     * @return option
     */
    public function setTyp($typ)
    {
      $this->typ = $typ;
      return $this;
    }

    /**
     * @return string
     */
    public function getType_option()
    {
      return $this->type_option;
    }

    /**
     * @param string $type_option
     * @return option
     */
    public function setType_option($type_option)
    {
      $this->type_option = $type_option;
      return $this;
    }

    /**
     * @return string
     */
    public function getPourcentage()
    {
      return $this->pourcentage;
    }

    /**
     * @param string $pourcentage
     * @return option
     */
    public function setPourcentage($pourcentage)
    {
      $this->pourcentage = $pourcentage;
      return $this;
    }

}
