<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResaBookingController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $sliders = $em->getRepository('FrontConfigBundle:SliderSHT')->findBy(array(), array('ordre' => 'asc'));
        $pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findOneBy(array('code' => 'tn'));
        $villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array('pays' => $pays), array('libelle' => 'asc'));
//        if($request->isMethod('POST')) {
//            $session->set('nuitees', $request->get('nuitees'));
//            $session->set('dateDebut', $request->get('dateDebut'));
//            return $this->redirect($this->generateUrl('front_hoteltunisie_list', array('ville' => $request->get('ville'), 'categorie' => $request->get('categorie'), 'name' => urlencode($request->get('motcles')),)));
//        }
        return $this->render('FrontGeneralBundle:resabooking:accueil.html.twig', array('villes' => $villes, 'sliders' => $sliders));
    }
}
