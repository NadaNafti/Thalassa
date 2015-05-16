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
                    $reservation['dateFin'] = date('Y-m-d' , strtotime($reservation['dateDebut'] . ' + ' . ($data['nuitees'] - 1) . ' day')) ;
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
        $client = $em->getRepository("BackUserBundle:Client")->find($reservation['client']) ;
        $dates = $this->container->get('library')->getDatesBetween($reservation['dateDebut'] , $reservation['dateFin']) ;
        $calendrier = $this->container->get('reservation')->getCalendrier($reservation,$hotel,$client) ;
        return $this->render('BackHotelTunisieBundle:Reservation:formulaire.html.twig' , array (
                    'calendrier' => $calendrier ,
                    'hotel' => $hotel ,
                    'nuitees' => $reservation['nuitees'] ,
                    'dateDebut' => new \DateTime($reservation['dateDebut']) ,
                    'dateFin' => new \DateTime($reservation['dateFin']) ,
                    'client' => $client ,
                    'saison' => $hotel->getSaisonPromotionByDate($reservation['dateDebut']) ,
                )) ;
    }

    public function saisonAjaxAction()
    {
        $em = $this->getDoctrine()->getManager() ;
        $saison = $em->getRepository("BackHotelTunisieBundle:Saison")->find($this->getRequest()->get('id')) ;
        if (is_null($saison->getType()))
            $hotel = $saison->getHotelBase() ;
        else
            $hotel = $saison->getHotel() ;
        return $this->render('BackHotelTunisieBundle:Reservation:ajaxSaison.html.twig' , array (
                    'saison' => $saison ,
                    'hotel' => $hotel
                )) ;
    }

}
