<?php

 namespace Back\ResaBookingBundle\Soap ;

class Traveller
{

    /**
     * @var string $typ
     */
    protected $typ = null;

    /**
     * @var string $age
     */
    protected $age = null;

    /**
     * @var string $BirthDate
     */
    protected $BirthDate = null;

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var string $FirstName
     */
    protected $FirstName = null;

    /**
     * @var string $LastName
     */
    protected $LastName = null;

    /**
     * @var string $civiliti
     */
    protected $civiliti = null;

    /**
     * @var string $adresse
     */
    protected $adresse = null;

    /**
     * @var string $cp
     */
    protected $cp = null;

    /**
     * @var string $pays
     */
    protected $pays = null;

    /**
     * @var string $ville
     */
    protected $ville = null;

    /**
     * @var string $mail
     */
    protected $mail = null;

    /**
     * @var string $tel
     */
    protected $tel = null;

    /**
     * @param string $typ
     * @param string $age
     * @param string $BirthDate
     */
    public function __construct($typ, $age, $BirthDate)
    {
      $this->typ = $typ;
      $this->age = $age;
      $this->BirthDate = $BirthDate;
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
     * @return Traveller
     */
    public function setTyp($typ)
    {
      $this->typ = $typ;
      return $this;
    }

    /**
     * @return string
     */
    public function getAge()
    {
      return $this->age;
    }

    /**
     * @param string $age
     * @return Traveller
     */
    public function setAge($age)
    {
      $this->age = $age;
      return $this;
    }

    /**
     * @return string
     */
    public function getBirthDate()
    {
      return $this->BirthDate;
    }

    /**
     * @param string $BirthDate
     * @return Traveller
     */
    public function setBirthDate($BirthDate)
    {
      $this->BirthDate = $BirthDate;
      return $this;
    }

    /**
     * @return string
     */
    public function getID()
    {
      return $this->ID;
    }

    /**
     * @param string $ID
     * @return Traveller
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
      return $this->FirstName;
    }

    /**
     * @param string $FirstName
     * @return Traveller
     */
    public function setFirstName($FirstName)
    {
      $this->FirstName = $FirstName;
      return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
      return $this->LastName;
    }

    /**
     * @param string $LastName
     * @return Traveller
     */
    public function setLastName($LastName)
    {
      $this->LastName = $LastName;
      return $this;
    }

    /**
     * @return string
     */
    public function getCiviliti()
    {
      return $this->civiliti;
    }

    /**
     * @param string $civiliti
     * @return Traveller
     */
    public function setCiviliti($civiliti)
    {
      $this->civiliti = $civiliti;
      return $this;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
      return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return Traveller
     */
    public function setAdresse($adresse)
    {
      $this->adresse = $adresse;
      return $this;
    }

    /**
     * @return string
     */
    public function getCp()
    {
      return $this->cp;
    }

    /**
     * @param string $cp
     * @return Traveller
     */
    public function setCp($cp)
    {
      $this->cp = $cp;
      return $this;
    }

    /**
     * @return string
     */
    public function getPays()
    {
      return $this->pays;
    }

    /**
     * @param string $pays
     * @return Traveller
     */
    public function setPays($pays)
    {
      $this->pays = $pays;
      return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
      return $this->ville;
    }

    /**
     * @param string $ville
     * @return Traveller
     */
    public function setVille($ville)
    {
      $this->ville = $ville;
      return $this;
    }

    /**
     * @return string
     */
    public function getMail()
    {
      return $this->mail;
    }

    /**
     * @param string $mail
     * @return Traveller
     */
    public function setMail($mail)
    {
      $this->mail = $mail;
      return $this;
    }

    /**
     * @return string
     */
    public function getTel()
    {
      return $this->tel;
    }

    /**
     * @param string $tel
     * @return Traveller
     */
    public function setTel($tel)
    {
      $this->tel = $tel;
      return $this;
    }

}
