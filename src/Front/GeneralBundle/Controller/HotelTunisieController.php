<?php
namespace Front\GeneralBundle\Controller;

use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Entity\Reglement;
use Back\UserBundle\Form\ClientFullType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\UserBundle\Form\ClientType;
use Back\HotelTunisieBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Response;

class HotelTunisieController extends Controller
{
    public function accueilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $sliders = $em->getRepository('FrontConfigBundle:SliderSHT')->findBy(array(), array('ordre' => 'asc'));
        $pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findOneBy(array('code' => 'tn'));
        $villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array('pays' => $pays), array('libelle' => 'asc'));
        $chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
        $categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
        $hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->filtreFrontOfficePlus();
        if($request->isMethod('POST')) {
            $session->set('nuitees', $request->get('nuitees'));
            $session->set('dateDebut', $request->get('dateDebut'));
            return $this->redirect($this->generateUrl('front_hoteltunisie_list', array('ville' => $request->get('ville'), 'categorie' => $request->get('categorie'), 'name' => urlencode($request->get('motcles')),)));
        }
        return $this->render('FrontGeneralBundle:hoteltunisie:accueil.html.twig', array('hotels' => $this->removeInvalideHotel($hotels, FALSE), 'villes' => $villes, 'chaines' => $chaines, 'categories' => $categories, 'sliders' => $sliders,));
    }

    public function filtreAction($page, $min, $max, $categorie, $chaine, $ville, $tag, $promotion, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findOneBy(array('code' => 'tn'));
        $tags = $em->getRepository('BackHotelTunisieBundle:Tag')->findBy(array(), array('libelle' => 'asc'));
        $villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array('pays' => $pays), array('libelle' => 'asc'));
        $chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
        $categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
        if($request->isMethod('POST')) {
            $villeArray = array();
            $tagArray = array();
            $categorieArray = array();
            $chaineArray = array();
            $arrays = array();
            foreach($villes as $v) {
                if($request->get('ville_' . $v->getId())) {
                    $villeArray[] = $v->getId();
                }
            }
            foreach($categories as $cat) {
                if($request->get('categorie_' . $cat->getId())) {
                    $categorieArray[] = $cat->getId();
                }
            }
            foreach($tags as $ta) {
                if($request->get('tag_' . $ta->getId())) {
                    $tagArray[] = $ta->getId();
                }
            }
            foreach($chaines as $ch) {
                if($request->get('chaine_' . $ch->getId())) {
                    $chaineArray[] = $ch->getId();
                }
            }
            if(count($villeArray) == 0) {
                $arrays['ville'] = 'all';
            }
            else {
                $arrays['ville'] = implode(',', $villeArray);
            }
            if(count($categorieArray) == 0) {
                $arrays['categorie'] = 'all';
            }
            else {
                $arrays['categorie'] = implode(',', $categorieArray);
            }
            if(count($tagArray) == 0) {
                $arrays['tag'] = 'all';
            }
            else {
                $arrays['tag'] = implode(',', $tagArray);
            }
            if(count($chaineArray) == 0) {
                $arrays['chaine'] = 'all';
            }
            else {
                $arrays['chaine'] = implode(',', $chaineArray);
            }
            if($request->get('promotionSearch')) {
                $arrays['promotion'] = 'yes';
            }
            else {
                $arrays['promotion'] = 'no';
            }
            $arrays['name'] = urlencode($request->get('motclesSearch'));
            $arrays['min'] = $request->get('minSearch');
            $arrays['max'] = $request->get('maxSearch');
            $session->set('nuitees', $request->get('nuiteesSearch'));
            $session->set('dateDebut', $request->get('dateDebutSearch'));
            return $this->redirect($this->generateUrl('front_hoteltunisie_list', $arrays));
        }
    }

    public function sortAction($page, $min, $max, $categorie, $chaine, $ville, $tag, $promotion, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if($request->isMethod('POST')) {
            $arrays = array();
            $arrays['min'] = $min;
            $arrays['max'] = $max;
            $arrays['ville'] = $ville;
            $arrays['categorie'] = $categorie;
            $arrays['tag'] = $tag;
            $arrays['chaine'] = $chaine;
            $arrays['promotion'] = $promotion;
            $arrays['name'] = $name;
            if($request->get('direction') != '') {
                $arrays['direction'] = $request->get('direction');
                $arrays['sort'] = $request->get('sort');
            }
            return $this->redirect($this->generateUrl('front_hoteltunisie_list', $arrays));
        }
    }

    public function listeAction($page, $min, $max, $categorie, $chaine, $ville, $tag, $promotion, $sort, $direction, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository('BackHotelTunisieBundle:Pays')->findOneBy(array('code' => 'tn'));
        $villes = $em->getRepository('BackHotelTunisieBundle:Ville')->findBy(array('pays' => $pays), array('libelle' => 'asc'));
        $tags = $em->getRepository('BackHotelTunisieBundle:Tag')->findBy(array(), array('libelle' => 'asc'));
        $chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
        $categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
        $hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->filtreFrontOfficePlus($categorie, $chaine, $ville, $tag, $name, $sort, $direction);
        $hotels = $this->removeInvalideHotel($hotels, $min, $max, $promotion);
        $paginator = $this->get('knp_paginator');
        $hotels = $paginator->paginate($hotels, $page, 20);
        return $this->render('FrontGeneralBundle:hoteltunisie/liste:liste.html.twig', array('hotels' => $hotels, 'hotels' => $hotels, 'tags' => $tags, 'villes' => $villes, 'chaines' => $chaines, 'categories' => $categories, 'motcle' => urldecode($name),));
    }

    public function detailsAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $ddd = \DateTime::createFromFormat('Y-m-d', $session->get('dateDebut'));
        $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->findOneBy(array('slug' => $slug));
        $hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->findBy(array('ville' => $hotel->getVille()), array(), 5);
        $hotels = $this->removeInvalideHotel($hotels);
        return $this->render('FrontGeneralBundle:hoteltunisie/details:details.html.twig', array('dateDebut' => $ddd, 'dateFin' => $ddd->modify('+' . $session->get('nuitees') . ' day'), 'hotel' => $hotel, 'hotels' => $hotels,));
    }

    public function removeInvalideHotel($hotels, $min = 0, $max = 1000, $topPromo = 'no')
    {
        $newHotels = array();
        foreach($hotels as $hotel) {
            $saison = $hotel->getSaisonPromotionByDate(date('Y-m-d'));
            if(!is_null($hotel->getSaisonBase()) && $hotel->getSaisonBase()->isValidSaisonBase() && !$hotel->isInStopSales() && $hotel->getEtat() == 1) {
                if($topPromo == 'no' || ($this->get('kernel')->getEnvironment() == 'prod' && $saison->getType() == 2)) {
                    if($saison->getPrixDeBase() <= $max && $saison->getPrixDeBase() >= $min) {
                        $newHotels[] = $hotel;
                    }
                }
            }
        }
        return $newHotels;
    }

    public function editPeriodeAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if($request->isMethod('POST')) {
            if(date('Y-m-d') < $request->get('dateDebut')) {
                $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->findOneBy(array('slug' => $slug));
                $session->set('dateDebut', $request->get('dateDebut'));
                $saison = $hotel->getSaisonPromotionByDate($session->get('dateDebut'));
                if($saison->getMinStay() <= $request->get('nuitees')) {
                    $session->set('nuitees', $request->get('nuitees'));
                    $session->getFlashBag()->add('Succés', " Votre période a été modifié avec succés ");
                }
                else {
                    $session->getFlashBag()->add('Info', " Le min Stay est " . $saison->getMinStay());
                }
            }
            else {
                $session->getFlashBag()->add('Erreur', "La date doit étre supperieur à la date courrante");
            }
        }
        return $this->redirect($this->generateUrl('front_hoteltunisie_details', array('slug' => $slug)));
    }

    public function reservationAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $dateDebut = \DateTime::createFromFormat('Y-m-d', $session->get('dateDebut'));
        $dateFin = $dateDebut->modify('+' . $session->get('nuitees') . ' day');
        $request = $this->getRequest();
        $user = $this->get('security.context')->getToken()->getUser();
        if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient())) {
            $client = $user->getClient();
        }
        else {
            $client = $this->container->get('users')->getPassager();
        }
        $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->findOneBy(array('slug' => $slug));
        $reservation = array();
        $reservation['hotel'] = $hotel->getId();
        $reservation['client'] = $client->getId();
        $reservation['dateDebut'] = $session->get('dateDebut');
        $saison = $this->container->get('saisons')->getSaisonByClient($hotel, $client, $reservation['dateDebut']);
        $reservation['nuitees'] = $session->get('nuitees');
        $reservation['dateFin'] = date('Y-m-d', strtotime($reservation['dateDebut'] . ' + ' . ($reservation['nuitees'] - 1) . ' day'));
        $session->set('reservation', $reservation);
        $saison = $this->container->get('saisons')->getSaisonByClient($hotel, $client, $reservation['dateDebut']);
        $reservation['saison'] = $saison->getId();
        $reservation['chambres'] = array();
        $Verif = FALSE;
        foreach($saison->getChambres() as $chambre) {
            $tab = array();
            $idch = $chambre->getChambre()->getId();
            if($request->get("chambre_" . $idch) > 0) {
                $Verif = TRUE;
                for($i = 1; $i <= $request->get("chambre_" . $idch); $i++) {
                    $occupants = $request->get('adulte_' . $idch . '_' . $i);
                    for($j = 1; $j <= $request->get('enfant_' . $idch . '_' . $i); $j++) $occupants .= ',' . $request->get('age_' . $idch . '_' . $i . '_' . $j);
                    $tab['chambre'] = $idch;
                    $tab['occupants'] = $occupants;
                    $tab['arrangement'] = $request->get('arrangement_' . $idch . '_' . $i);
                    $tab['supp'] = array();
                    $tab['vue'] = array();
                    $tab['reduc'] = array();
                    foreach($saison->getAutresSupplements() as $supp) {
                        if($this->container->get('Library')->verifSuppReducDate($supp->getSupp(), $dateDebut, $dateFin) && $supp->getSupp()->getObligatoire() || $request->get('supp_' . $idch . '_' . $i . '_' . $supp->getSupp()->getId())) {
                            $tab['supp'][] = $supp->getSupp()->getId();
                        }
                    }
                    foreach($saison->getAutresReductions() as $reduc) {
                        if($this->container->get('Library')->verifSuppReducDate($reduc->getReduc(), $dateDebut, $dateFin)) {
                            $tab['reduc'][] = $reduc->getReduc()->getId();
                        }
                    }
                    foreach($saison->getVues() as $vue) {
                        if($request->get('vue_' . $idch . '_' . $i . '_' . $vue->getVue()->getId())) {
                            $tab['vue'][] = $vue->getVue()->getId();
                        }
                    }
                    $reservation['chambres'][] = $tab;
                }
            }
        }
        $session->set('reservation', $reservation);
        if($Verif) {
            return $this->redirect($this->generateUrl("front_hoteltunisie_tarif_dispo", array('slug' => $slug)));
        }
        else {
            $session->getFlashBag()->add('info', "Vous devez choisir au moin une chambre");
            return $this->redirect($this->generateUrl("front_hoteltunisie_details", array('slug' => $slug)));
        }
    }

    public function tarifDispoAction($slug)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $confPaiement = $em->find('BackHotelTunisieBundle:ConfigurationPayement', 1);
        $choices[1] = "Paiement à l'agence";
        if($confPaiement) {
            $choices[2] = 'Paiement Total en ligne';
            if($confPaiement->getAvance() != 0) {
                $choices[3] = 'Paiement avance de ' . $confPaiement->getAvance() . '% en ligne';
            }
        }
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $request->getSession()->set('_security.target_path', $request->getUri());
        $reservation = $session->get('reservation');
        $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']);
        if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient())) {
            $client = $user->getClient();
        }
        else {
            $client = $this->container->get('users')->getPassager();
        }
        $form = $this->createFormBuilder()->add("client", new ClientFullType(), array('data' => $client));
        $ordre = 1;
        $chambres = array();
        foreach($reservation['chambres'] as $value) {
            $adulte = array();
            $enfant = array();
            $tab = explode(',', $value['occupants']);
            for($i = 1; $i <= $tab[0]; $i++) {
                $form->add("chambre" . $ordre . "adulte" . $i, 'text');
                $adulte[] = "chambre" . $ordre . "adulte" . $i;
            }
            for($i = 1; $i <= count($tab) - 1; $i++) {
                $form->add("chambre" . $ordre . "Enfant" . $i, 'text');
                $enfant[] = "chambre" . $ordre . "Enfant" . $i;
            }
            $ordre++;
            $chambres[] = array('chambre' => $value['chambre'], 'adultes' => $adulte, 'enfants' => $enfant);
        }
        foreach($hotel->getOptions() as $option) $form->add('option_' . $option->getId(), 'checkbox', array('label' => $option->getLibelle(), 'required' => FALSE));
        $form->add('observation', 'textarea', array('required' => FALSE));
        $form->add('payment', 'choice', array('choices' => $choices, 'expanded' => true, 'data' => 1));
        $form = $form->getForm();
        $result = $this->container->get('reservation')->reservation($reservation);
        if($request->isMethod('post')) {
            $form->submit($request);
            $data = $form->getData();
            $result = $this->container->get('reservation')->saveReservation($data, $result, 'frontoffice');
            $session->remove('reservation');
            if($data['payment'] != 1) {
                return $this->redirect($this->generateUrl('front_hoteltunisie_paiement', array('reservation' => $result, 'paymentType' => $data['payment'])));
            }
            return $this->redirect($this->generateUrl("front_hoteltunisie_thankyou", array('reservation' => $result,)));
        }
        $reservation = $session->get('reservation');
        return $this->render('FrontGeneralBundle:hoteltunisie/reservation:tarif_dispo.html.twig', array('form' => $form->createView(), 'chambres' => $chambres, 'hotel' => $hotel, 'client' => $client, 'nuitees' => $reservation['nuitees'], 'dateDebut' => new \DateTime($reservation['dateDebut']), 'dateFin' => new \DateTime($reservation['dateFin']), 'resultat' => $result, 'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate'),));
    }


    public function paiementAction(Reservation $reservation, $paymentType)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $confPaiement = $em->find('BackHotelTunisieBundle:ConfigurationPayement', 1);
        {
            if($confPaiement && $confPaiement->getNumeroAffiliation() != 0  && in_array($paymentType, array(2, 3))) {
                $total = $reservation->getTotal();
                if($paymentType == 2)
                    $monant = $total;
                elseif($paymentType == 3 && $confPaiement->getAvance() != 0)
                    $monant = $total * $confPaiement->getAvance() / 100;
                $em->persist($reservation->setTypePayement($paymentType)->setMontantPayementElectronique($monant));
                $em->flush();
                return $this->redirect($confPaiement->getUrl() . $reservation->getId() . '&Montant=' . $monant . '&Devise=TND&sid=' . session_id() . '&affilie=' . $confPaiement->getNumeroAffiliation());
            }
        }
        return $this->redirect($this->generateUrl("front_hoteltunisie_thankyou", array('reservation' => $reservation->getId(),)));
    }

    public function notificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $ref = $request->get('Reference');
        $act = $request->get('Action');
        $par = $request->get('Param');
        $reservation=$em->find('BackHotelTunisieBundle:Reservation',$ref);
        switch($act) {
            case "DETAIL":
                return new Response( "Reference=" . $ref . "&Action=" . $act . "&Reponse=" . $reservation->getMontantPayementElectronique());
            case "ERREUR":
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
            case "ACCORD":
                $piece = new Piece();//Add new piece
                $piece->setClient($reservation->getClient())
                    ->setDateCreation(new \DateTime())
                    ->setDateReglement(new \DateTime())
                    ->setMontantOrigine($reservation->getMontantPayementElectronique())
                    ->setMontant(0)
                    ->setParam($par)
                    ->setModeReglement("PE")
                    ->setRegle(true);
                $em->persist($piece);
                $reglement = new Reglement();//add new reglement
                $reglement->setPiece($piece)
                    ->setMontant($reservation->getMontantPayementElectronique())
                    ->setReservation($reservation)
                    ->setDateCreation(new \DateTime());
                $em->persist($reglement);
                if($reservation->getTypePayement()==2)//validation reservation
                    $reservation->setEtat(2)->setValidated(new \DateTime())->setCode($this->container->get('reservation')->getCode());
                $reservation->addReglement($reglement);
                $em->persist($reservation);
                $em->flush();
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
            case "REFUS":
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
            case "ANNULATION":
                return new Response("Reference=" . $ref . "&Action=" . $act . "&Reponse=OK");
        }
    }

    public function thankyouAction(Reservation $reservation)
    {
        return $this->render('FrontGeneralBundle:hoteltunisie/reservation:thankyou.html.twig', array('reservation' => $reservation));
    }
}
