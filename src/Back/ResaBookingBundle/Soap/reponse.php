<?php
 namespace Back\ResaBookingBundle\Soap;

class reponse
{

    /**
     * @var string $statut
     */
    protected $statut = null;

    /**
     * @var string $code
     */
    protected $code = null;

    /**
     * @var string $detail_erreur
     */
    protected $detail_erreur = null;

    /**
     * @var string $detail_erreur_en
     */
    protected $detail_erreur_en = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getStatut()
    {
      return $this->statut;
    }

    /**
     * @param string $statut
     * @return reponse
     */
    public function setStatut($statut)
    {
      $this->statut = $statut;
      return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
      return $this->code;
    }

    /**
     * @param string $code
     * @return reponse
     */
    public function setCode($code)
    {
      $this->code = $code;
      return $this;
    }

    /**
     * @return string
     */
    public function getDetail_erreur()
    {
      return $this->detail_erreur;
    }

    /**
     * @param string $detail_erreur
     * @return reponse
     */
    public function setDetail_erreur($detail_erreur)
    {
      $this->detail_erreur = $detail_erreur;
      return $this;
    }

    /**
     * @return string
     */
    public function getDetail_erreur_en()
    {
      return $this->detail_erreur_en;
    }

    /**
     * @param string $detail_erreur_en
     * @return reponse
     */
    public function setDetail_erreur_en($detail_erreur_en)
    {
      $this->detail_erreur_en = $detail_erreur_en;
      return $this;
    }

}
