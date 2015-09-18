<?php
 namespace Back\ResaBookingBundle\Soap;

class liste_suplement_obligatoire
{

    /**
     * @var string $libelle
     */
    protected $libelle = null;

    /**
     * @var string $Type
     */
    protected $Type = null;

    /**
     * @var string $Applique
     */
    protected $Applique = null;

    /**
     * @var string $nombre_nuit
     */
    protected $nombre_nuit = null;

    /**
     * @var string $prix
     */
    protected $prix = null;

    /**
     * @var string $prix_ad
     */
    protected $prix_ad = null;

    /**
     * @var string $prix_ef
     */
    protected $prix_ef = null;

    /**
     * @var string $prix_bb
     */
    protected $prix_bb = null;

    /**
     * @var string $type_room
     */
    protected $type_room = null;


    public function __construct()
    {

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
     * @return liste_suplement_obligatoire
     */
    public function setLibelle($libelle)
    {
      $this->libelle = $libelle;
      return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
      return $this->Type;
    }

    /**
     * @param string $Type
     * @return liste_suplement_obligatoire
     */
    public function setType($Type)
    {
      $this->Type = $Type;
      return $this;
    }

    /**
     * @return string
     */
    public function getApplique()
    {
      return $this->Applique;
    }

    /**
     * @param string $Applique
     * @return liste_suplement_obligatoire
     */
    public function setApplique($Applique)
    {
      $this->Applique = $Applique;
      return $this;
    }

    /**
     * @return string
     */
    public function getNombre_nuit()
    {
      return $this->nombre_nuit;
    }

    /**
     * @param string $nombre_nuit
     * @return liste_suplement_obligatoire
     */
    public function setNombre_nuit($nombre_nuit)
    {
      $this->nombre_nuit = $nombre_nuit;
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
     * @return liste_suplement_obligatoire
     */
    public function setPrix($prix)
    {
      $this->prix = $prix;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrix_ad()
    {
      return $this->prix_ad;
    }

    /**
     * @param string $prix_ad
     * @return liste_suplement_obligatoire
     */
    public function setPrix_ad($prix_ad)
    {
      $this->prix_ad = $prix_ad;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrix_ef()
    {
      return $this->prix_ef;
    }

    /**
     * @param string $prix_ef
     * @return liste_suplement_obligatoire
     */
    public function setPrix_ef($prix_ef)
    {
      $this->prix_ef = $prix_ef;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrix_bb()
    {
      return $this->prix_bb;
    }

    /**
     * @param string $prix_bb
     * @return liste_suplement_obligatoire
     */
    public function setPrix_bb($prix_bb)
    {
      $this->prix_bb = $prix_bb;
      return $this;
    }

    /**
     * @return string
     */
    public function getType_room()
    {
      return $this->type_room;
    }

    /**
     * @param string $type_room
     * @return liste_suplement_obligatoire
     */
    public function setType_room($type_room)
    {
      $this->type_room = $type_room;
      return $this;
    }

}
