<?php
 namespace Back\ResaBookingBundle\Soap;

class info_agence
{

    /**
     * @var string $type_reglement
     */
    protected $type_reglement = null;

    /**
     * @var string $payer_par
     */
    protected $payer_par = null;

    /**
     * @var string $marge
     */
    protected $marge = null;

    /**
     * @var string $etat_paiement
     */
    protected $etat_paiement = null;

    /**
     * @var string $email_client
     */
    protected $email_client = null;

    /**
     * @var string $tel_client
     */
    protected $tel_client = null;

    /**
     * @var string $agence
     */
    protected $agence = null;

    /**
     * @var string $adresse_livraison
     */
    protected $adresse_livraison = null;

    /**
     * @var string $modalite_payment
     */
    protected $modalite_payment = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getType_reglement()
    {
      return $this->type_reglement;
    }

    /**
     * @param string $type_reglement
     * @return info_agence
     */
    public function setType_reglement($type_reglement)
    {
      $this->type_reglement = $type_reglement;
      return $this;
    }

    /**
     * @return string
     */
    public function getPayer_par()
    {
      return $this->payer_par;
    }

    /**
     * @param string $payer_par
     * @return info_agence
     */
    public function setPayer_par($payer_par)
    {
      $this->payer_par = $payer_par;
      return $this;
    }

    /**
     * @return string
     */
    public function getMarge()
    {
      return $this->marge;
    }

    /**
     * @param string $marge
     * @return info_agence
     */
    public function setMarge($marge)
    {
      $this->marge = $marge;
      return $this;
    }

    /**
     * @return string
     */
    public function getEtat_paiement()
    {
      return $this->etat_paiement;
    }

    /**
     * @param string $etat_paiement
     * @return info_agence
     */
    public function setEtat_paiement($etat_paiement)
    {
      $this->etat_paiement = $etat_paiement;
      return $this;
    }

    /**
     * @return string
     */
    public function getEmail_client()
    {
      return $this->email_client;
    }

    /**
     * @param string $email_client
     * @return info_agence
     */
    public function setEmail_client($email_client)
    {
      $this->email_client = $email_client;
      return $this;
    }

    /**
     * @return string
     */
    public function getTel_client()
    {
      return $this->tel_client;
    }

    /**
     * @param string $tel_client
     * @return info_agence
     */
    public function setTel_client($tel_client)
    {
      $this->tel_client = $tel_client;
      return $this;
    }

    /**
     * @return string
     */
    public function getAgence()
    {
      return $this->agence;
    }

    /**
     * @param string $agence
     * @return info_agence
     */
    public function setAgence($agence)
    {
      $this->agence = $agence;
      return $this;
    }

    /**
     * @return string
     */
    public function getAdresse_livraison()
    {
      return $this->adresse_livraison;
    }

    /**
     * @param string $adresse_livraison
     * @return info_agence
     */
    public function setAdresse_livraison($adresse_livraison)
    {
      $this->adresse_livraison = $adresse_livraison;
      return $this;
    }

    /**
     * @return string
     */
    public function getModalite_payment()
    {
      return $this->modalite_payment;
    }

    /**
     * @param string $modalite_payment
     * @return info_agence
     */
    public function setModalite_payment($modalite_payment)
    {
      $this->modalite_payment = $modalite_payment;
      return $this;
    }

}
