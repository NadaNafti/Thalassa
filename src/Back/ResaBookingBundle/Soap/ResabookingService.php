<?php



namespace Back\ResaBookingBundle\Soap;


class ResabookingService extends \SoapClient
{


    protected $wsdl ;
    protected $options ;

    /*/**
     * @var array $classmap The defined classes
     */

    /*private static $classmap = array(

    );*/

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl)
    {

        /*foreach (self::$classmap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = $value;
            }
        }*/
        $this->wsdl = $wsdl ;
        $this->options = array_merge(array(
            'ArrayOfroom' => __NAMESPACE__.'\\ArrayOfroom',
            'ArrayOfTraveller' => __NAMESPACE__.'\\ArrayOfTraveller',
            'Traveller' => __NAMESPACE__.'\\Traveller',
            'room' => __NAMESPACE__.'\\Soap\\room',
            'rooms' => __NAMESPACE__.'\\rooms',
            'reponse' => __NAMESPACE__.'\\reponse',
            'ArrayOfhot' => __NAMESPACE__.'\\ArrayOfhot',
            'ArrayOfchambres' => __NAMESPACE__.'\\ArrayOfchambres',
            'ArrayOfchambre' => __NAMESPACE__.'\\ArrayOfchambre',
            'ArrayOfliste_suplement_obligatoire' => __NAMESPACE__.'\\ArrayOfliste_suplement_obligatoire',
            'liste_suplement_obligatoire' => __NAMESPACE__.'\\liste_suplement_obligatoire',
            'ArrayOfchamb' => __NAMESPACE__.'\\ArrayOfchamb',
            'ArrayOfpromotion' => __NAMESPACE__.'\\ArrayOfpromotion',
            'promotion' => __NAMESPACE__.'\\promotion',
            'chamb' => __NAMESPACE__.'\\chamb',
            'chambre' => __NAMESPACE__.'\\chambre',
            'chambres' => __NAMESPACE__.'\\chambres',
            'ArrayOfpolicy' => __NAMESPACE__.'\\ArrayOfpolicy',
            'ArrayOftype_arrangement' => __NAMESPACE__.'\\ArrayOftype_arrangement',
            'type_arrangement' => __NAMESPACE__.'\\type_arrangement',
            'policy' => __NAMESPACE__.'\\policy',
            'hot' => __NAMESPACE__.'\\hot',
            'hotelliste' => __NAMESPACE__.'\\hotelliste' ,
            'ArrayOfequipement' => __NAMESPACE__.'\\ArrayOfequipement',
            'equipement' => __NAMESPACE__.'\\equipement',
            'ficheproduit' => __NAMESPACE__.'\\ficheproduit',
            'chambs' => __NAMESPACE__.'\\chambs',
            'ArrayOfoption' => __NAMESPACE__.'\\ArrayOfoption',
            'option' => __NAMESPACE__.'\\option',
            'options' => __NAMESPACE__.'\\options',
            'booking' => __NAMESPACE__.'\\booking',
            'Travellers' => __NAMESPACE__.'\\Travellers',
            'vol' => __NAMESPACE__.'\\vol',
            'info_agence' => __NAMESPACE__.'\\info_agence',
            'book' => __NAMESPACE__.'\\book',
            'destock' => __NAMESPACE__.'\\destock',
            'bookingcancel' => __NAMESPACE__.'\\bookingcancel',
            'comfirmbookingcancel' => __NAMESPACE__.'\\comfirmbookingcancel',
            'ArrayOfdetail_chambres' => __NAMESPACE__.'\\ArrayOfdetail_chambres',
            'ArrayOfenfant_age' => __NAMESPACE__.'\\ArrayOfenfant_age',
            'enfant_age' => __NAMESPACE__.'\\enfant_age',
            'detail_chambres' => __NAMESPACE__.'\\detail_chambres',
            'ArrayOfinfo_pass' => __NAMESPACE__.'\\ArrayOfinfo_pass',
            'info_pass' => __NAMESPACE__.'\\info_pass',
            'detailreservation' => __NAMESPACE__.'\\detailreservation',
            'ArrayOfdetailresa' => __NAMESPACE__.'\\ArrayOfdetailresa',
            'detailresa' => __NAMESPACE__.'\\detailresa',
            'resbooking' => __NAMESPACE__.'\\resbooking',
            'reglement_commande' => __NAMESPACE__.'\\reglement_commande',
        ), $options);

        parent::__construct($this->wsdl, $this->options);
    }

    /**
     * Return availabilityhotel hotelshotel
     *
     * @param string $ipfrom
     * @param string $ville
     * @param string $idhotel
     * @param string $debut
     * @param string $fin
     * @param rooms $rooms
     * @param string $login
     * @param string $pw
     * @param string $langue
     * @param string $marche
     * @param string $monnaie
     * @param string $redagence
     * @param string $resafrom
     * @param string $iduser
     * @return hotelliste
     */
    public function availabilityhotel($ipfrom, $ville, $idhotel, $debut, $fin, rooms $rooms, $login, $pw, $langue, $marche, $monnaie, $redagence, $resafrom, $iduser)
    {
        return $this->__soapCall('availabilityhotel', array($ipfrom, $ville, $idhotel, $debut, $fin, $rooms, $login, $pw, $langue, $marche, $monnaie, $redagence, $resafrom, $iduser));
    }

    /**
     * Return detailhotel detailhotel
     *
     * @param string $login
     * @param string $pw
     * @param string $session
     * @param string $id_hotel
     * @param string $langue
     * @return ficheproduit
     */
    public function detailhotel($login, $pw, $session, $id_hotel, $langue)
    {
        return $this->__soapCall('detailhotel', array($login, $pw, $session, $id_hotel, $langue));
    }

    /**
     * Return devis devishotel
     *
     * @param string $login
     * @param string $pw
     * @param string $session
     * @param string $id_hotel
     * @param string $pension
     * @param chambs $chambs
     * @param options $options
     * @return booking
     */
    public function devis($login, $pw, $session, $id_hotel, $pension, chambs $chambs, options $options)
    {
        return $this->__soapCall('devis', array($login, $pw, $session, $id_hotel, $pension, $chambs, $options));
    }

    /**
     * Return createbooking booking
     *
     * @param string $session
     * @param Travellers $travels
     * @param Traveller $organisateur
     * @param string $login
     * @param string $pw
     * @param vol $vol
     * @param info_agence $info_agence
     * @param string $note_supplementaire
     * @param string $frais_supplementaire
     * @return book
     */
    public function createbooking($session, Travellers $travels, Traveller $organisateur, $login, $pw, vol $vol, info_agence $info_agence, $note_supplementaire, $frais_supplementaire)
    {
        return $this->__soapCall('createbooking', array($session, $travels, $organisateur, $login, $pw, $vol, $info_agence, $note_supplementaire, $frais_supplementaire));
    }

    /**
     * Return destockage destockagehotel
     *
     * @param string $reference
     * @param string $etat_paiement
     * @param string $type_reglement
     * @param string $login
     * @param string $pw
     * @return destock
     */
    public function destockage($reference, $etat_paiement, $type_reglement, $login, $pw)
    {
        return $this->__soapCall('destockage', array($reference, $etat_paiement, $type_reglement, $login, $pw));
    }

    /**
     * @param string $login
     * @param string $pw
     * @param anyType $reference
     * @param anyType $type_penalite
     * @return bookingcancel
     */
    public function demandeannulation($login, $pw, $reference, $type_penalite)
    {
        return $this->__soapCall('demandeannulation', array($login, $pw, $reference, $type_penalite));
    }

    /**
     * @param string $login
     * @param anyType $pw
     * @param anyType $session
     * @return comfirmbookingcancel
     */
    public function confirmannulation($login, $pw, $session)
    {
        return $this->__soapCall('confirmannulation', array($login, $pw, $session));
    }

    /**
     * @param string $login
     * @param string $pw
     * @param string $reference
     * @return detailreservation
     */
    public function getreservation($login, $pw, $reference)
    {
        return $this->__soapCall('getreservation', array($login, $pw, $reference));
    }

    /**
     * @param string $login
     * @param string $pw
     * @param string $debut
     * @param string $fin
     * @return resbooking
     */
    public function findreservation($login, $pw, $debut, $fin)
    {
        return $this->__soapCall('findreservation', array($login, $pw, $debut, $fin));
    }

    /**
     * Return reglement_commande
     *
     * @param string $reference
     * @param string $etat_paiement
     * @param string $type_reglement
     * @param string $choix_paiement
     * @param string $montant_reglement
     * @param string $agent
     * @param string $devise
     * @param string $reference_paiement
     * @param string $banque
     * @param string $prorietaire
     * @param string $date_vers
     * @param string $libelle_agence
     * @param string $login
     * @param string $pw
     * @return reglement_commande
     */
    public function reglement_commande($reference, $etat_paiement, $type_reglement, $choix_paiement, $montant_reglement, $agent, $devise, $reference_paiement, $banque, $prorietaire, $date_vers, $libelle_agence, $login, $pw)
    {
        return $this->__soapCall('reglement_commande', array($reference, $etat_paiement, $type_reglement, $choix_paiement, $montant_reglement, $agent, $devise, $reference_paiement, $banque, $prorietaire, $date_vers, $libelle_agence, $login, $pw));
    }

    public function getFunctions(){
        return $this->__getFunctions();
    }

}
