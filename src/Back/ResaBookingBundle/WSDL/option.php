<?php
namespace Back\ResaBookingBundle\WSDL;

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

    /**
     * option constructor.
     * @param string $nom
     * @param string $enfant
     * @param string $prix
     * @param string $type_option
     * @param string $pourcentage
     * @param string $typ
     */
    public function __construct($nom= null, $enfant= null, $prix= null, $type_option= null, $pourcentage= null, $typ= null)
    {
        $this->nom = $nom;
        $this->enfant = $enfant;
        $this->prix = $prix;
        $this->type_option = $type_option;
        $this->pourcentage = $pourcentage;
        $this->typ = $typ;
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
