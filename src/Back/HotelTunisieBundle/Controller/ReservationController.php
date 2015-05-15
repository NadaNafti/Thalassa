<?php

namespace Back\HotelTunisieBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Session\Session ;
use Doctrine\ORM\EntityRepository ;
use Back\HotelTunisieBundle\Form\NewReservationType ;
use Symfony\Component\Form\FormError ;
use Symfony\Component\HttpFoundation\JsonResponse ;

class ReservationController extends Controller
{

    public function newAction()
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        $form = $this->createForm(new NewReservationType()) ;
        if ($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest()) ;
            if ($form->isValid())
            {
                $data = $form->getData() ;
                if ($data['dateDebut']->format('Y-m-d') <= date('Y-m-d'))
                    $form->get('dateDebut')->addError(new FormError(" Votre date doit être supérieure à la date " . date('d/m/Y'))) ;
                elseif (is_null($data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))) || !$data['hotels']->getSaisonBase()->isValidSaisonBase())
                    $form->get('hotels')->addError(new FormError(" La saison de base est invalide !!!")) ;
                elseif ($data['hotels']->getSaisonPromotionByDate(date('Y-m-d'))->getMinStay() > $data['nuitees'])
                    $form->get('nuitees')->addError(new FormError(" Nombre de nuitées doit être supérieure ou égale au min stay " . $data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))->getMinStay())) ;
                else
                {
                    $reservation = array () ;
                    $reservation['hotel'] = $data['hotels']->getId() ;
                    $reservation['client'] = $data['client']->getId() ;
                    $reservation['dateDebut'] = $data['dateDebut']->format('Y-m-d') ;
                    $reservation['dateFin'] = date('Y-m-d' , strtotime($reservation['dateDebut'] . ' + ' . ($data['nuitees']-1) . ' day')) ;
                    $reservation['nuitees'] = $data['nuitees'] ;
                    $session->set("reservation" , $reservation) ;
                    return $this->redirect($this->generateUrl("formulaire_reservation")) ;
                }
            }
        }
        return $this->render('BackHotelTunisieBundle:Reservation:new.html.twig' , array (
                    'form' => $form->createView()
                )) ;
    }

    public function ajaxVilleAction()
    {
        $em = $this->getDoctrine()->getManager() ;
        $request = $this->getRequest() ;
        $id = $request->get("id") ;
        $response = new JsonResponse() ;
        if ($id != '')
        {
            $ville = $em->getRepository("BackHotelTunisieBundle:Ville")->find($id) ;
            $hotels = $em->getRepository("BackHotelTunisieBundle:Hotel")->findBy(
                    array ('ville' => $ville) , array ('libelle' => 'asc')
                    ) ;
        }
        else
            $hotels = $em->getRepository("BackHotelTunisieBundle:Hotel")->findAll() ;
        $tab = array () ;
        foreach ($hotels as $hotel)
            $tab[$hotel->getId()] = $hotel->getLibelle() ;
        $response->setData($tab) ;
        return $response ;
    }

    public function formulaireAction()
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        if (!$session->has("reservation"))
            return $this->redirect($this->generateUrl("new_reservation")) ;
        $reservation = $session->get('reservation') ;
        $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']) ;
        $client=$em->getRepository("BackUserBundle:Client")->find($reservation['client']) ;
        $dates = $this->getDatesBetween($reservation['dateDebut'] , $reservation['dateFin']) ;
        $lastSaison = $hotel->getSaisonPromotionByDate($reservation['dateDebut']) ;
        $dateDebut = $reservation['dateDebut'] ;
        $dateFin = '' ;
        $calendrier = array () ;
        foreach ($dates as $date)
        {
            $saison = $this->container->get("saisons")->getSaisonByClient($hotel ,$client , $date);
//            $saison = $hotel->getSaisonPromotionByDate($date) ;
            if ($saison->getId() != $lastSaison->getId() || $date == $reservation['dateFin'])
            {
                if($date == $reservation['dateFin'])
                    $dateFin = $date ;
                $calendrier[] = array ('dateDebut' => $dateDebut , 'dateFin' => $dateFin , 'saison' => $lastSaison) ;
                $lastSaison = $saison ;
                $dateDebut = $date ;
            }
            $dateFin = $date ;
        }
        return $this->render('BackHotelTunisieBundle:Reservation:formulaire.html.twig' , array (
                    'calendrier' => $calendrier ,
                    'hotel' => $hotel ,
                    'nuitees' => $reservation['nuitees'] ,
                    'dateDebut' => new \DateTime($reservation['dateDebut']) ,
                    'dateFin' => new \DateTime($reservation['dateFin']) ,
                    'client'=>$client,
                    'saison'=>$hotel->getSaisonPromotionByDate($reservation['dateDebut']),
                )) ;
    }

    public function getDatesBetween($dStart , $dEnd)
    {
        $iStart = strtotime($dStart) ;
        $iEnd = strtotime($dEnd) ;
        if (false === $iStart || false === $iEnd)
        {
            return false ;
        }
        $aStart = explode('-' , $dStart) ;
        $aEnd = explode('-' , $dEnd) ;
        if (count($aStart) !== 3 || count($aEnd) !== 3)
        {
            return false ;
        }
        if (false === checkdate($aStart[1] , $aStart[2] , $aStart[0]) || false === checkdate($aEnd[1] , $aEnd[2] , $aEnd[0]) || $iEnd <= $iStart)
        {
            return false ;
        }
        for ($i = $iStart ; $i < $iEnd + 86400 ; $i = strtotime('+1 day' , $i))
        {
            $sDateToArr = strftime('%Y-%m-%d' , $i) ;
            $sYear = substr($sDateToArr , 0 , 4) ;
            $sMonth = substr($sDateToArr , 5 , 2) ;
            //$aDates[$sYear][$sMonth][]=$sDateToArr;
            $aDates[] = $sDateToArr ;
        }
        if (isset($aDates) && !empty($aDates))
        {
            return $aDates ;
        }
        else
        {
            return false ;
        }
    }

    public function saisonAjaxAction()
    {
        $em = $this->getDoctrine()->getManager() ;
        $saison = $em->getRepository("BackHotelTunisieBundle:Saison")->find($this->getRequest()->get('id')) ;
        if(is_null($saison->getType()))
            $hotel=$saison->getHotelBase();
        else
            $hotel=$saison->getHotel();
        return $this->render('BackHotelTunisieBundle:Reservation:ajaxSaison.html.twig' , array (
                    'saison' => $saison,
                    'hotel' => $hotel
                )) ;
    }

}
