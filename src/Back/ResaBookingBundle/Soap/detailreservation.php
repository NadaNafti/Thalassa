<?php
 namespace Back\ResaBookingBundle\Soap;

class detailreservation
{

    /**
     * @var reponse $rep
     */
    protected $rep = null;

    /**
     * @var string $session
     */
    protected $session = null;

    /**
     * @var string $reference
     */
    protected $reference = null;

    /**
     * @var string $id_hotel
     */
    protected $id_hotel = null;

    /**
     * @var string $libelle_hotel
     */
    protected $libelle_hotel = null;

    /**
     * @var string $star
     */
    protected $star = null;

    /**
     * @var string $ville
     */
    protected $ville = null;

    /**
     * @var string $date_arrive
     */
    protected $date_arrive = null;

    /**
     * @var string $date_retour
     */
    protected $date_retour = null;

    /**
     * @var string $prices
     */
    protected $prices = null;

    /**
     * @var string $monnaie
     */
    protected $monnaie = null;

    /**
     * @var string $arrangement
     */
    protected $arrangement = null;

    /**
     * @var string $info_supplementaire
     */
    protected $info_supplementaire = null;

    /**
     * @var string $etat_commande
     */
    protected $etat_commande = null;

    /**
     * @var ArrayOfdetail_chambres $liste_chambre
     */
    protected $liste_chambre = null;

    /**
     * @var ArrayOfinfo_pass $liste_passager
     */
    protected $liste_passager = null;


    public function __construct()
    {

    }

    /**
     * @return reponse
     */
    public function getRep()
    {
      return $this->rep;
    }

    /**
     * @param reponse $rep
     * @return detailreservation
     */
    public function setRep($rep)
    {
      $this->rep = $rep;
      return $this;
    }

    /**
     * @return string
     */
    public function getSession()
    {
      return $this->session;
    }

    /**
     * @param string $session
     * @return detailreservation
     */
    public function setSession($session)
    {
      $this->session = $session;
      return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
      return $this->reference;
    }

    /**
     * @param string $reference
     * @return detailreservation
     */
    public function setReference($reference)
    {
      $this->reference = $reference;
      return $this;
    }

    /**
     * @return string
     */
    public function getId_hotel()
    {
      return $this->id_hotel;
    }

    /**
     * @param string $id_hotel
     * @return detailreservation
     */
    public function setId_hotel($id_hotel)
    {
      $this->id_hotel = $id_hotel;
      return $this;
    }

    /**
     * @return string
     */
    public function getLibelle_hotel()
    {
      return $this->libelle_hotel;
    }

    /**
     * @param string $libelle_hotel
     * @return detailreservation
     */
    public function setLibelle_hotel($libelle_hotel)
    {
      $this->libelle_hotel = $libelle_hotel;
      return $this;
    }

    /**
     * @return string
     */
    public function getStar()
    {
      return $this->star;
    }

    /**
     * @param string $star
     * @return detailreservation
     */
    public function setStar($star)
    {
      $this->star = $star;
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
     * @return detailreservation
     */
    public function setVille($ville)
    {
      $this->ville = $ville;
      return $this;
    }

    /**
     * @return string
     */
    public function getDate_arrive()
    {
      return $this->date_arrive;
    }

    /**
     * @param string $date_arrive
     * @return detailreservation
     */
    public function setDate_arrive($date_arrive)
    {
      $this->date_arrive = $date_arrive;
      return $this;
    }

    /**
     * @return string
     */
    public function getDate_retour()
    {
      return $this->date_retour;
    }

    /**
     * @param string $date_retour
     * @return detailreservation
     */
    public function setDate_retour($date_retour)
    {
      $this->date_retour = $date_retour;
      return $this;
    }

    /**
     * @return string
     */
    public function getPrices()
    {
      return $this->prices;
    }

    /**
     * @param string $prices
     * @return detailreservation
     */
    public function setPrices($prices)
    {
      $this->prices = $prices;
      return $this;
    }

    /**
     * @return string
     */
    public function getMonnaie()
    {
      return $this->monnaie;
    }

    /**
     * @param string $monnaie
     * @return detailreservation
     */
    public function setMonnaie($monnaie)
    {
      $this->monnaie = $monnaie;
      return $this;
    }

    /**
     * @return string
     */
    public function getArrangement()
    {
      return $this->arrangement;
    }

    /**
     * @param string $arrangement
     * @return detailreservation
     */
    public function setArrangement($arrangement)
    {
      $this->arrangement = $arrangement;
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
     * @return detailreservation
     */
    public function setInfo_supplementaire($info_supplementaire)
    {
      $this->info_supplementaire = $info_supplementaire;
      return $this;
    }

    /**
     * @return string
     */
    public function getEtat_commande()
    {
      return $this->etat_commande;
    }

    /**
     * @param string $etat_commande
     * @return detailreservation
     */
    public function setEtat_commande($etat_commande)
    {
      $this->etat_commande = $etat_commande;
      return $this;
    }

    /**
     * @return ArrayOfdetail_chambres
     */
    public function getListe_chambre()
    {
      return $this->liste_chambre;
    }

    /**
     * @param ArrayOfdetail_chambres $liste_chambre
     * @return detailreservation
     */
    public function setListe_chambre($liste_chambre)
    {
      $this->liste_chambre = $liste_chambre;
      return $this;
    }

    /**
     * @return ArrayOfinfo_pass
     */
    public function getListe_passager()
    {
      return $this->liste_passager;
    }

    /**
     * @param ArrayOfinfo_pass $liste_passager
     * @return detailreservation
     */
    public function setListe_passager($liste_passager)
    {
      $this->liste_passager = $liste_passager;
      return $this;
    }

}
