<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\UserBundle\Form\ClientType;
use Back\VoyageOrganiseBundle\Form\ReservationType;
use Back\VoyageOrganiseBundle\Entity\Periode;
use Back\VoyageOrganiseBundle\Entity\Pack;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Back\VoyageOrganiseBundle\Entity\Reservation;
use Back\VoyageOrganiseBundle\Entity\ReservationChambre;
use Back\VoyageOrganiseBundle\Entity\ReservationLigne;
use Back\VoyageOrganiseBundle\Entity\ReservationPersonne;

class VoyageOrganiseController extends Controller
{

    public function accueilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $sliders = $em->getRepository('FrontConfigBundle:SliderVO')->findBy(array(), array('ordre' => 'asc'));
        $pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findBy(array(), array('libelle' => 'asc'));
        $destinations = $em->getRepository('BackVoyageOrganiseBundle:Destination')->findBy(array(), array('libelle' => 'asc'));
        $themes = $em->getRepository('BackVoyageOrganiseBundle:Theme')->findBy(array(), array('libelle' => 'asc'));
        if ($request->isMethod('POST'))
        {
            return $this->redirect($this->generateUrl('front_voyageorganise_liste', array(
                                'destinations' => $request->get('destinations'),
                                'pays' => $request->get('pays'),
                                'themes' => $request->get('themes'),
                                'name' => urlencode($request->get('motcles')),
            )));
        }
        return $this->render('FrontGeneralBundle:voyageorganise:accueil.html.twig', array(
                    'destinations' => $destinations,
                    'themes' => $themes,
                    'pays' => $pays,
                    'sliders' => $sliders
        ));
    }

    public function listeAction($page, $themes, $destinations, $pays, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $listePays = $em->getRepository('BackHotelTunisieBundle:Pays')->findBy(array(), array('libelle' => 'asc'));
        $listeDestinations = $em->getRepository('BackVoyageOrganiseBundle:Destination')->findBy(array(), array('libelle' => 'asc'));
        $listeThemes = $em->getRepository('BackVoyageOrganiseBundle:Theme')->findBy(array(), array('libelle' => 'asc'));
        if ($request->isMethod('POST'))
        {
            $destinationArray = array();
            $paysArray = array();
            $themesArray = array();
            $arrays = array();
            foreach ($listeDestinations as $dest)
            {
                if ($request->get('destinations_' . $dest->getId()))
                    $destinationArray[] = $dest->getId();
            }
            foreach ($listeThemes as $th)
            {
                if ($request->get('themes_' . $th->getId()))
                    $themesArray[] = $th->getId();
            }
            foreach ($listePays as $pay)
            {
                if ($request->get('pays_' . $pay->getId()))
                    $paysArray[] = $pay->getId();
            }
            if (count($themesArray) == 0)
                $arrays['themes'] = 'all';
            else
                $arrays['themes'] = implode(',', $themesArray);
            if (count($destinationArray) == 0)
                $arrays['destinations'] = 'all';
            else
                $arrays['destinations'] = implode(',', $destinationArray);
            if (count($paysArray) == 0)
                $arrays['pays'] = 'all';
            else
                $arrays['pays'] = implode(',', $paysArray);
            $arrays['name'] = urlencode($request->get('motclesSearch'));
            return $this->redirect($this->generateUrl('front_voyageorganise_liste', $arrays));
        }
        $voyages = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->filtre($themes, $destinations, $pays, $name);
        $paginator = $this->get('knp_paginator');
        $voyages = $paginator->paginate($voyages, $page, 20);
        return $this->render('FrontGeneralBundle:voyageorganise/liste:liste.html.twig', array(
                    'voyages' => $voyages,
                    'destinations' => $listeDestinations,
                    'themes' => $listeThemes,
                    'pays' => $listePays,
                    'motcle' => urldecode($name)
        ));
    }

    public function detailsAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $voyage = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $slug));
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
            $client = $user->getClient();
        else
            $client = $this->container->get('users')->getPassager();
        $request = $this->getRequest();

        return $this->render('FrontGeneralBundle:voyageorganise/details:details.html.twig', array(
                    'voyage' => $voyage,
                    'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
        ));
    }

    public function successAction($slug, Reservation $reservation)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $voyage = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $slug));
        return $this->render('FrontGeneralBundle:voyageorganise:success.html.twig', array(
                    'reservation' => $reservation,
        ));
    }

    public function packToHotelsAjaxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pack = $em->getRepository('BackVoyageOrganiseBundle:Pack')->find($this->getRequest()->get('pack'));
        $array = array();
        $tab = array();
        $response = new JsonResponse();
        if ($pack)
        {
            foreach ($pack->getHotels() as $hotel)
            {
                $tab['libelle'] = $hotel->getLibelle();
                $tab['categorie'] = $hotel->getCategorie()->getLibelle();
                $array[] = $tab;
            }
        }
        $response->setData($array);
        return $response;
    }

    public function reservationAction($slug, Pack $pack)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
            $client = $user->getClient();
        else
            $client = $this->container->get('users')->getPassager();
        $form = $this->createFormBuilder()
                ->add("client", new ClientType(), array('data' => $client));
        $form = $form->getForm();
        if ($request->isMethod('POST'))
        {
            $periode = $pack->getPeriode();
            $supplements = array();
            $circuits = array();
            $frais = array();
            $chambres = array(
                array('single', 1, $pack->getSingleAchat(), $pack->getSingleVente()),
                array('double', 2, $pack->getDoubleAchat(), $pack->getDoubleVente()),
                array('triple', 3, $pack->getTripleAchat(), $pack->getTripleVente()),
                array('quadruple', 4, $pack->getQuadrupleAchat(), $pack->getQuadrupleVente())
            );
            $form->submit($request);
            $data = $form->getData();
            $coordoonnes = array($client->getNomPrenom(), $client->getTel1(), $client->getTel2(), $client->getAdresse());
            $nbrPassagers = $request->get('chambresingle') + $request->get('chambredouble') * 2 + $request->get('chambretriple') * 3 + $request->get('chambrequadruple') * 4;
            if ($nbrPassagers == 0)
            {
                $session->getFlashBag()->add('Erreur', "Vous devrez choisir au moin une chambre.");
                return $this->redirect($this->generateUrl('front_voyageorganise_reservation', array('slug' => $slug, 'pack' => $pack->getId())));
            }
            elseif ($periode->getDepartGarantie() && $nbrPassagers < $periode->getMin())
            {
                $session->getFlashBag()->add('Erreur', "Vous devrez choisir au moin " . $periode->getMin() . " personnes.");
                return $this->redirect($this->generateUrl('front_voyageorganise_reservation', array('slug' => $slug, 'pack' => $pack->getId())));
            }
            $reservation = new Reservation();
            $reservation->setClient($client)
                    ->setCoordonnees($coordoonnes)
                    ->setEtat(1)
                    ->setFrontOffice(true)
                    ->setVoyage($periode->getVoyage());
            $em->persist($reservation);
            $x = 0;
            foreach ($chambres as $ch)
            {
                for ($i = 1; $i <= $request->get('chambre' . $ch[0]); $i++)
                {
                    $reservationChambre = new ReservationChambre();
                    $reservationChambre->setReservation($reservation)
                            ->setType($ch[1]);
                    $em->persist($reservationChambre);
                    for ($p = 1; $p <= $ch[1]; $p++)
                    {
                        $x++;
                        $reservationPersonne = new ReservationPersonne();
                        $reservationPersonne->setChambre($reservationChambre)
                                ->setNomPrenom($request->get($ch[0] . '_nom_' . $i . '_' . $p))
                                ->setPassport($request->get($ch[0] . '_passport_' . $i . '_' . $p));
                        if ($request->get($ch[0] . '_age_' . $i . '_' . $p) != 'adulte')
                            $reservationPersonne->setAge($request->get($ch[0] . '_age_' . $i . '_' . $p))->setEnfant(true);
                        else
                            $reservationPersonne->setAge(null)->setEnfant(false);
                        $em->persist($reservationPersonne);
                        $reservationLigne = new ReservationLigne();
                        $reservationLigne->setPersonne($reservationPersonne)
                                ->setLibelle('Logement chambre ' . $ch[0])
                                ->setCode('chambre_' . $ch[0])
                                ->setAchat($ch[2])
                                ->setVente($ch[3]);
                        $em->persist($reservationLigne);
                        foreach ($pack->getSupplements() as $supp)
                        {
                            if ($supp->getObligatoire() || $request->get('supplement' . $supp->getId()))
                            {
                                if ($x == 1)
                                    $supplements[] = $supp->getId();
                                $reservationLigne = new ReservationLigne();
                                $reservationLigne->setPersonne($reservationPersonne)
                                        ->setLibelle($supp->getLibelle())
                                        ->setCode('Supplement')
                                        ->setAchat($supp->getAdulteAchat())
                                        ->setVente($supp->getAdulteVente());
                                $em->persist($reservationLigne);
                            }
                        }
                        foreach ($periode->getCircuits() as $supp)
                        {
                            if ($supp->getObligatoire() || $request->get('circuit' . $supp->getId()))
                            {
                                if ($x == 1)
                                    $circuits[] = $supp->getId();
                                $reservationLigne = new ReservationLigne();
                                $reservationLigne->setPersonne($reservationPersonne);
                                if (!$reservationPersonne->getEnfant())
                                    $reservationLigne->setAchat($supp->getAdulteAchat())->setVente($supp->getAdulteVente())->setCode('CircuitAdl')->setLibelle($supp->getLibelle() . ' adulte');
                                else
                                    $reservationLigne->setAchat($supp->getEnfantAchat())->setVente($supp->getEnfantVente())->setCode('CircuitEnf')->setLibelle($supp->getLibelle() . ' enfant');
                                $em->persist($reservationLigne);
                            }
                        }
                        foreach ($periode->getFrais() as $supp)
                        {
                            if ($supp->getObligatoire() || $request->get('frai' . $supp->getId()))
                            {
                                if ($x == 1)
                                    $frais[] = $supp->getId();
                                $reservationLigne = new ReservationLigne();
                                $reservationLigne->setPersonne($reservationPersonne);
                                if (!$reservationPersonne->getEnfant())
                                    $reservationLigne->setAchat($supp->getAdulteAchat())->setVente($supp->getAdulteVente())->setCode('FraisDiversAdl')->setLibelle($supp->getLibelle() . ' adulte');
                                else
                                    $reservationLigne->setAchat($supp->getEnfantAchat())->setVente($supp->getEnfantVente())->setCode('FraisDiversEnf')->setLibelle($supp->getLibelle() . ' enfant');
                                $em->persist($reservationLigne);
                            }
                        }
                    }
                }
            }
            $em->flush();
            $em->persist($reservation->setSupplements($supplements)->setCircuits($circuits)->setFrais($frais));
            return $this->redirect($this->generateUrl('front_voyageorganise_thankyou', array(
                                'slug' => $slug,
                                'reservation' => $reservation->getId()
            )));
        }
        return $this->render('FrontGeneralBundle:voyageorganise:reservation.html.twig', array(
                    'form' => $form->createView(),
                    'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate'),
                    'periode' => $pack->getPeriode(),
                    'pack' => $pack
        ));
    }

}
