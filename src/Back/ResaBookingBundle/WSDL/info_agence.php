<?php
namespace Back\ResaBookingBundle\WSDL;

class info_agence
{

    protected $type_reglement = null;
    protected $payer_par = null;
    protected $marge = null;
    protected $etat_paiement = null;
    protected $email_client = null;
    protected $tel_client = null;
    protected $agence = null;
    protected $adresse_livraison = null;
    protected $modalite_payment = null;

    /**
     * info_agence constructor.
     * @param null $type_reglement
     * @param null $payer_par
     * @param null $marge
     * @param null $etat_paiement
     * @param null $email_client
     * @param null $tel_client
     * @param null $agence
     * @param null $adresse_livraison
     * @param null $modalite_payment
     */
    public function __construct($type_reglement = null, $payer_par = null, $marge = null, $etat_paiement = null, $email_client = null, $tel_client = null, $agence = null, $adresse_livraison = null, $modalite_payment = null)
    {
        $this->type_reglement = $type_reglement;
        $this->payer_par = $payer_par;
        $this->marge = $marge;
        $this->etat_paiement = $etat_paiement;
        $this->email_client = $email_client;
        $this->tel_client = $tel_client;
        $this->agence = $agence;
        $this->adresse_livraison = $adresse_livraison;
        $this->modalite_payment = $modalite_payment;
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
