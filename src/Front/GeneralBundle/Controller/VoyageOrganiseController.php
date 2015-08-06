<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\UserBundle\Form\ClientType;
use Back\VoyageOrganiseBundle\Form\ReservationType;
use Back\VoyageOrganiseBundle\Entity\Reservation;
use Back\VoyageOrganiseBundle\Entity\Periode;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    public function reservationAction($slug, Periode $periode)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $voyage = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $slug));
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
            $client = $user->getClient();
        else
            $client = $this->container->get('users')->getPassager();
        $form = $this->createFormBuilder()
                ->add("client", new ClientType(), array('data' => $client))
                ->add("pack", 'entity', array(
            'class' => 'BackVoyageOrganiseBundle:Pack',
            'query_builder' => function(EntityRepository $er) use ($periode)
            {
                return $er->createQueryBuilder('p')
                        ->where('p.periode = :id')
                        ->setParameter('id', $periode->getId())
                        ->orderBy('p.id', 'desc');
                ;
            },
            'required' => true,
            'empty_value' => 'Liste des packs disponlible',
            'empty_data' => null
        ));
        $form = $form->getForm();
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $data = $form->getData();
                $reservationVO['voyage'] = $periode->getVoyage()->getId();
                $reservationVO['periode'] = $periode->getId();
                $reservationVO['client'] = $data['client']->getId();
                $reservationVO['coordonnes'] = array($data['client']->getNomPrenom(), $data['client']->getTel1(), $data['client']->getTel2(), $data['client']->getAdresse());
                $reservationVO['pack'] = $data['pack']->getId();
                $session->set('reservationVO', $reservationVO);
                return $this->redirect($this->generateUrl('front_voyageorganise_occupationchambre', array('slug' => $slug)));
            }
        }
        return $this->render('FrontGeneralBundle:voyageorganise:reservation.html.twig', array(
                    'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate'),
                    'form' => $form->createView(),
                    'periode' => $periode,
        ));
    }

    public function occChambreAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $reservationVO=$session->get('reservationVO');
        $periode=$em->getRepository('BackVoyageOrganiseBundle:Periode')->find($reservationVO['periode']);
        $pack=$em->getRepository('BackVoyageOrganiseBundle:Pack')->find($reservationVO['pack']);
        $form = $this->createFormBuilder();
        $form = $form->getForm();
        return $this->render('FrontGeneralBundle:voyageorganise:occChambre.html.twig', array(
                    'form' => $form->createView(),
                    'periode' => $periode,
                    'pack'=>$pack
        ));
    }

}
