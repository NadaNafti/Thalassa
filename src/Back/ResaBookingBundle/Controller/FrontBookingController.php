<?php

namespace Back\ResaBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Back\ResaBookingBundle\Soap;
use Back\ResaBookingBundle\Entity\HotelRepository;

class FrontBookingController extends Controller
{
    public function filtreAction()
    {

        $session = $this->getRequest()->getSession();

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];
        $service = $this->container->get('resa_booking');

        $arrayOfTraveller = array();
        $arrayOfroom = array();

        $region = $request->get('region');

        $nuitees = $request->get('nuiteesSearch');

        $date_arrivee = $request->get('dateArriveSearch');

        $date_depart = date('Y-m-d', strtotime($date_arrivee . ' +' . $nuitees . ' days'));

        $chambres = $request->get('chambres');


        for ($i = 1; $i <= $chambres; $i++) {
            $adultes = $request->get('adulte_' . $i . '_');

            if (is_numeric($adultes) && $adultes != 0) {
                for ($j = 1; $j <= $adultes; $j++) {
                    $arrayOfTraveller[] = new Soap\Traveller('adult', null, null);
                }
                //dump($arrayOfTraveller);
            }

            $enfants = $request->get('enfant_' . $i . '_');

            if (is_numeric($enfants) && $enfants != 0) {

                for ($j = 1; $j <= $enfants; $j++) {
                    $age = $request->get('age_' . $i . '__' . $j);
                    $age = is_numeric($age) ? $age : 0;
                    $arrayOfTraveller[] = new Soap\Traveller('enfant', $age, null);
                }
                dump($arrayOfTraveller);
            }

            $room = new Soap\room();
            $room->setTraveller($arrayOfTraveller);
            $arrayOfroom[] = $room;


            $arrayOfTraveller = array();
        }

        $rooms = new Soap\rooms();
        $rooms->setRoom($arrayOfroom);

        $session->set('bookingRooms', $rooms);

        $filter_traveller = array('typ' => 'adult');
        //array('typ' => 'enfant' ,'age' => $age );
        $filter_chambre = array();
        $filter_chambes= array();

        for ($i = 1; $i <= $chambres; $i++) {
            $adultes = $request->get('adulte_' . $i . '_');
            $enfants = $request->get('enfant_' . $i . '_');
            for ($j = 1; $j <= $adultes; $j++) {
                $filter_chambre['adultes'] = $j;
                $filter_chambre['enfant'] = 0 ;
            }
            for ($j = 1; $j <= $enfants; $j++) {
                $age = $request->get('age_' .$i.'_'.$j);
                $age = is_numeric($age) ? $age : 0;
                $filter_chambre['enfant'] = $j;
                $filter_chambre['age'.$j] = $age;
            }
            $filter_chambes[] = $filter_chambre;
            $filter_chambre = array();
        }
        $session->set('filterofrooms',$filter_chambes);



        $response = $service->availabilityhotel(null, $region, null, $date_arrivee, $date_depart, $rooms, $login, $pass, 'fr', 'Magrabein', 'dt', null, null, null);


        $response = (array)$response;
        $hotels = null;
        dump($response['hots']);
        if ($response['hots'] != null) {
            $ids = array();

            foreach ($response['hots'] as $hot) {
                dump($hot);
                $ids[] = $hot->id;
            }

            $hotels = $em->getRepository("BackResaBookingBundle:Hotel")->OleHotels($ids);

        }

        return $this->redirect($this->generateUrl("resa_booking_hotels"));
        //return $this->render('BackResaBookingBundle:liste:liste.html.twig', array('hotels' => $hotels));

    }


    /*public function indexAction($name)
    {
        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];




        //ini_set('xdebug.var_display_max_depth', -1);
        //ini_set('xdebug.var_display_max_children', -1);
        //ini_set('xdebug.var_display_max_data', -1);

        //var_//dump($rooms);
        //$service = new Soap\ResabookingService();
        $service = $this->container->get('resa_booking');
        $response = $service->availabilityhotel(null,'hammamet',null,'2015-09-14','2015-09-18',$rooms,$login,$pass,'fr','Magrabein','dt',null,null,null);
        // $response = $service->getFunctions();
        //dump($response);

        return $this->render('BackResaBookingBundle:liste:index.html.twig', array('name' => $name));
    }
*/
    public function listeAction()
    {

        $session = $this->getRequest()->getSession();

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $service = $this->container->get('resa_booking');

        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];

        /* $arrayOfTraveller = array();
         for($i=0 ; $i<=$adults ; $i++ ) {
             $arrayOfTraveller[] = new Soap\Traveller('adult',null,null);
         }

         $room = new Soap\room();
         //$room->setTraveller(new Soap\ArrayOfTraveller($arrayOfTraveller));
         $room->setTraveller($arrayOfTraveller);

         $arrayOfroom[] = $room ;

         $rooms = new Soap\rooms();
         //$rooms->setRoom(new Soap\ArrayOfroom($arrayOfroom));
         $rooms->setRoom($arrayOfroom);
         */

        $region = $session->get('bookingRegion');

        $nuitees = $session->get('nuiteesSearch');

        $date_arrivee = $session->get('dateArriveSearch');

        $date_depart = date('Y-m-d', strtotime($date_arrivee . ' +' . $nuitees . ' days'));

        $rooms = $session->get('bookingRooms');

        //dump($date_arrivee);
        //dump($date_depart);
        //dump($rooms);
        $response = $service->availabilityhotel(null, $region, null, $date_arrivee, $date_depart, $rooms, $login, $pass, 'fr', 'Magrabein', 'dt', null, null, null);

        $response = (array)$response;

        $session->set('availibility_response', $response);

        $hotels = null;
        $hots = array();
        if ($response['hots'] != null) {
            $ids = array();
            foreach ($response['hots'] as $hot) {
                $ids[] = $hot->id;
                $hots[] = $hot;
            }

            //$hots = $this->object_to_array($response['hots']);
            //dump($hots);

            $hotels = $em->getRepository("BackResaBookingBundle:Hotel")->ResaHotels($ids);
            //dump($hotels);

        }
        return $this->render('BackResaBookingBundle:liste:liste.html.twig', array('hotels' => $hotels,
        ));
    }


    public function showAvailibilityAction($id, $priceonly = false )
    {

        $session = $this->getRequest()->getSession();

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $service = $this->container->get('resa_booking');

        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];

        $region = $session->get('bookingRegion');

        $nuitees = $session->get('nuiteesSearch');

        $date_arrivee = $session->get('dateArriveSearch');

        $date_depart = date('Y-m-d', strtotime($date_arrivee . ' +' . $nuitees . ' days'));

        $rooms = $session->get('bookingRooms');

        $response = $service->availabilityhotel(null, $region, $id, $date_arrivee, $date_depart, $rooms, $login, $pass, 'fr', 'Magrabein', 'dt', null, null, null);
        $response = $this->object_to_array($response);

        if ($response != null && $response['rep']['statut'] == 'sucess') {
            $prices= array();$arr= array(); $i=0;
            foreach ($response['hots'] as $hot) {
                //dump($hot);
                if ($priceonly) {
                    //dump($hot['chambres']);
                    foreach ($hot['chambres'] as $chambre) {
                        dump($chambre);
                        foreach ($chambre as $chamb) {
                            dump($chamb);
                            foreach ($chamb as $ch) {

                                $prices[] = $ch['price'] ;
                                $arr[] = $ch['libelle_pension'] ;
                                $i++;
                            }
                        }
                    }
                    $index = array_search(min($prices), $prices);
                    dump($prices);
                    return $this->render('BackResaBookingBundle:liste:showPrice.html.twig', ['price' => $prices[$index],'arr' => $arr[$index]]);
                }

                return $this->render('BackResaBookingBundle:liste:showAvailibility.html.twig', ['chambres' => $hot['chambres']]);
            }


        }

        return null;
    }

    public function showPlanAction($id, $priceonly = false )
    {

        $session = $this->getRequest()->getSession();

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $service = $this->container->get('resa_booking');

        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];

        $region = $session->get('bookingRegion');

        $nuitees = $session->get('nuiteesSearch');

        $date_arrivee = $session->get('dateArriveSearch');

        $date_depart = date('Y-m-d', strtotime($date_arrivee . ' +' . $nuitees . ' days'));

        $rooms = $session->get('bookingRooms');

        $response = $service->availabilityhotel(null, $region, $id, $date_arrivee, $date_depart, $rooms, $login, $pass, 'fr', 'Magrabein', 'dt', null, null, null);
        $response = $this->object_to_array($response);

        if ($response != null && $response['rep']['statut'] == 'sucess') {
            $prices= array();$arr= array(); $i=0;
            foreach ($response['hots'] as $hot) {
                //dump($hot);
                if ($priceonly) {
                    //dump($hot['chambres']);
                    foreach ($hot['chambres'] as $chambre) {
                        dump($chambre);
                        foreach ($chambre as $chamb) {
                            dump($chamb);
                            foreach ($chamb as $ch) {

                                $prices[] = $ch['price'] ;
                                $arr[] = $ch['libelle_pension'] ;
                                $i++;
                            }
                        }
                    }
                    $index = array_search(min($prices), $prices);
                    dump($prices);
                    return $this->render('BackResaBookingBundle:liste:showPrice.html.twig', ['price' => $prices[$index],'arr' => $arr[$index]]);
                }

                return $this->render('BackResaBookingBundle:liste:showPlan.html.twig', ['chambres' => $hot['chambres']]);
            }


        }

        return null;
    }

    public function detailsAction($slug)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $service = $this->container->get('resa_booking');

        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];

        $nuitees = $session->get('nuiteesSearch');
        $date_arrivee = $session->get('dateArriveSearch');
        $date_depart = date('Y-m-d', strtotime($date_arrivee . ' +' . $nuitees . ' days'));
        $availibility = $this->object_to_array($session->get('availibility_response'));
        $api_session = $availibility['session'];


        //$hotels[0]->getChambres()[0]->getChambre()[0]->getPension();






        $hots = $availibility['hots'];

        $hot = $this->filter_hotel($hots, $id_hotel);

        $chambr = $hot['chambres'];


        $response = array();

        foreach ($chambr as $chambre) {
            foreach ($chambre as $ch) {

                foreach ($ch as $c) {

                    $chamb = $c['chamb'];

                    $chambs = new Soap\chambs();
                    $chambs->setChs($chamb);

                    $pension = $c['pension'];
                    $options = new Soap\options();
                    $response = $service->devis($login, $pass, $api_session, $id_hotel, $pension, $chambs, $options);
                }
            }
        }


        $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->findOneBy(array('slug' => $slug));
        $hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->findBy(array('ville' => $hotel->getVille()), array(), 5);
        $hotels = $this->removeInvalideHotel($hotels);
        $id_hotel = $em->getRepository('BackResaBookingBundle:Hotel')->findOneBy(array('hotel' => $hotel->getId()));
        $id_hotel = $id_hotel->getIdResa();

        /*$detail_hotel_api = $service->detailhotel($login, $pass, null, $id_hotel, 'fr');*/

        if ($request->isMethod("POST")) {

            $params = $request->request->all();
            dump($params);

            $arrayOfTraveller = array();
            $arrayOfroom = array();

            $region = $request->get('region');

            $nuitees = $request->get('nuiteesSearch');

            $date_arrivee = $request->get('dateArriveSearch');

            $date_depart = date('Y-m-d', strtotime($date_arrivee . ' +' . $nuitees . ' days'));

            $chambres = $request->get('chambres');


            for ($i = 1; $i <= $chambres; $i++) {
                $adultes = $request->get('adulte_' . $i . '_');

                if (is_numeric($adultes) && $adultes != 0) {
                    for ($j = 1; $j <= $adultes; $j++) {
                        $arrayOfTraveller[] = new Soap\Traveller('adult', null, null);
                    }
                    //dump($arrayOfTraveller);
                }

                $enfants = $request->get('enfant_' . $i . '_');

                if (is_numeric($enfants) && $enfants != 0) {

                    for ($j = 1; $j <= $enfants; $j++) {
                        $age = $request->get('age_' . $i . '__' . $j);
                        $age = is_numeric($age) ? $age : 0;
                        $arrayOfTraveller[] = new Soap\Traveller('enfant', $age, null);
                    }
                    dump($arrayOfTraveller);
                }

                $room = new Soap\room();
                $room->setTraveller($arrayOfTraveller);
                $arrayOfroom[] = $room;


                $arrayOfTraveller = array();
            }

            $rooms = new Soap\rooms();
            $rooms->setRoom($arrayOfroom);

            $session->set('bookingRooms', $rooms);

            $filter_traveller = array('typ' => 'adult');
            //array('typ' => 'enfant' ,'age' => $age );
            $filter_chambre = array();
            $filter_chambes= array();

            for ($i = 1; $i <= $chambres; $i++) {
                $adultes = $request->get('adulte_' . $i . '_');
                $enfants = $request->get('enfant_' . $i . '_');
                for ($j = 1; $j <= $adultes; $j++) {
                    $filter_chambre['adultes'] = $j;
                    $filter_chambre['enfant'] = 0 ;
                }
                for ($j = 1; $j <= $enfants; $j++) {
                    $age = $request->get('age_' .$i.'_'.$j);
                    $age = is_numeric($age) ? $age : 0;
                    $filter_chambre['enfant'] = $j;
                    $filter_chambre['age'.$j] = $age;
                }
                $filter_chambes[] = $filter_chambre;
                $filter_chambre = array();
            }
            $session->set('filterofrooms',$filter_chambes);

            return $this->redirect($this->generateUrl("list_hotels"));
        }



        return $this->render('BackResaBookingBundle:details:details.html.twig', array(
            'hotel' => $hotel,
            'hotels' => $hotels,
            'chambres' => $chambr,
            'IdResa' => $id_hotel,
        ));
    }

    public function updateRoomsAction(){
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $params = $request->request->all();

        if ($request->isMethod("POST")) {
            $form->bind($request);
            if ($form->isValid()) {
                $hotel = $form->getData();
                $em->persist($hotel->setEtat(1));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre hôtel a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("list_hotels"));
            }
        }
        dump($params);


    }

    public function removeInvalideHotel($hotels, $min = 0, $max = 1000, $topPromo = 'no')
    {
        $newHotels = array();
        foreach ($hotels as $hotel) {
            $saison = $hotel->getSaisonPromotionByDate(date('Y-m-d'));
            if (!is_null($hotel->getSaisonBase()) && $hotel->getSaisonBase()->isValidSaisonBase() && !$hotel->isInStopSales() && $hotel->getEtat() == 1) {
                if ($topPromo == 'no' || ($this->get('kernel')->getEnvironment() == 'prod' && $saison->getType() == 2)) {
                    if ($saison->getPrixDeBase() <= $max && $saison->getPrixDeBase() >= $min)
                        $newHotels[] = $hotel;
                }
            }
        }
        return $newHotels;
    }


    private function filter_hotel($hots, $id_hotel)
    {

        foreach ($hots as $hot) {
            if ($hot['id'] != $id_hotel) {
                continue;
            }
            return $hot;
        }
        return null;
    }

    private function object_to_array($obj)
    {
        if (is_object($obj)) $obj = (array)$obj;
        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = $this->object_to_array($val);
            }
        } else $new = $obj;
        return $new;
    }


}



