<?php
namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function accueilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sliders = $em->getRepository('FrontConfigBundle:Slider')->findBy(array(), array('ordre' => 'asc'));
        $tun = $em->getRepository('BackHotelTunisieBundle:Pays')->findOneBy(array('code' => 'tn'));
        $pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findBy(array(), array('libelle' => 'asc'));
        $villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array('pays' => $tun), array('libelle' => 'asc'));
        $chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
        $categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
        $destinations = $em->getRepository('BackVoyageOrganiseBundle:Destination')->findBy(array(), array('libelle' => 'asc'));
        $themes = $em->getRepository('BackVoyageOrganiseBundle:Theme')->findBy(array(), array('libelle' => 'asc'));
        $themesP = $em->getRepository('BackProgrammeBundle:Theme')->findBy(array(), array('libelle' => 'asc'));
        return $this->render('FrontGeneralBundle::accueil.html.twig', array(
            'sliders'      => $sliders,
            'villes'       => $villes,
            'chaines'      => $chaines,
            'categories'   => $categories,
            'destinations' => $destinations,
            'themes'       => $themes,
            'themesP'      => $themesP,
            'pays'         => $pays,
        ));
    }

    public function oleBookingAction()
    {
        return $this->render('FrontGeneralBundle::ole_booking.html.twig');
    }

    public function oleLocationAction()
    {
        return $this->render('FrontGeneralBundle::ole_location.html.twig');
    }

    public function underConstructionAction()
    {
        return $this->render('FrontGeneralBundle::under_construction.html.twig');
    }
}
