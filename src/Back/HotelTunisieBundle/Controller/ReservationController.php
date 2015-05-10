<?php

namespace Back\HotelTunisieBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Session\Session ;
use Doctrine\ORM\EntityRepository ;
use Back\HotelTunisieBundle\Form\NewReservationType ;
use Symfony\Component\Form\FormError ;

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
                elseif(is_null($data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))) || !$data['hotels']->getSaisonBase()->isValidSaisonBase())
                    $form->get('hotels')->addError(new FormError(" La saison de base est invalide !!!")) ;
                elseif($data['hotels']->getSaisonPromotionByDate(date('Y-m-d'))->getMinStay()>$data['nuitees'])
                    $form->get('nuitees')->addError(new FormError(" Nombre de nuitées doit être supérieure au min stay ".$data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))->getMinStay())) ;
            }
        }
        return $this->render('BackHotelTunisieBundle:Reservation:new.html.twig' , array (
                    'form' => $form->createView()
                )) ;
    }

}
