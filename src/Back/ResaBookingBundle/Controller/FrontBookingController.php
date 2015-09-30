<?php

namespace Back\ResaBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Back\ResaBookingBundle\Soap ;
use Back\ResaBookingBundle\Entity\HotelRepository;

class FrontBookingController extends Controller
{
    public function filtreAction()
    {
        $request = $this->getRequest();
        $arrayOfTraveller = array(); $arrayOfroom = array();

        $region = $request->get('region');

        $nuitees = $request->get('nuiteesSearch');

        $date_arrivee = $request->get('dateArriveSearch');

        $date_depart = date('Y-m-d', strtotime($date_arrivee.' +' . $nuitees . ' days'));

        $chambres = $request->get('chambres');

        for($i = 1 ;$i<= $chambres ; $i++) {
            $adultes = $request->get('adulte_'.$i.'_') ;
            if(is_numeric($adultes) && $adultes != 0){
                for($j= 1 ; $j<= $adultes ; $j++ ){
                    $arrayOfTraveller[] = new Soap\Traveller('adult',null,null);
                }
            }

            $enfants = $request->get('enfant_'.$i.'_') ;
            if(is_numeric($enfants) && $enfants != 0) {
                for ($j = 1; $j <= $enfants; $j++) {
                    $age = $request->get('age_'.$i.'__'.$j);
                    $age = is_numeric($age) ? $age : 0 ;
                    $arrayOfTraveller[] = new Soap\Traveller('enfant', $age, null);
                }
            }

            $room = new Soap\room();
            $room->setTraveller($arrayOfTraveller);
            $arrayOfroom[] = $room ;
        }

        $rooms = new Soap\rooms();
        $rooms->setRoom($arrayOfroom);




        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];
        $service = $this->container->get('resa_booking');


        $response = $service->availabilityhotel(null,$region,null,$date_arrivee,$date_depart,$rooms,$login,$pass,'fr','Magrabein','dt',null,null,null);


        $response = (array) $response ;


        /*if ($request->get('libelle') != '')
            $libelle = urlencode($request->get('libelle'));
        else
            $libelle = "all";
        return $this->redirect($this->generateUrl('list_hotels', array(
            'ville' => $request->get('ville'),
            'etat' => $request->get('etat'),
            'chaine' => $request->get('chaine'),
            'categorie' => $request->get('categorie'),
            'libelle' => $libelle,
        )));*/

        return $this->render('BackResaBookingBundle:liste:liste.html.twig', array( 'hotels' => $response['hots'],
                //'villes' => $villes,
                //    'chaines' => $chaines,
                //    'categories' => $categories,
            )
        );

    }




    public function indexAction($name)
    {
        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];




        //ini_set('xdebug.var_display_max_depth', -1);
        //ini_set('xdebug.var_display_max_children', -1);
        //ini_set('xdebug.var_display_max_data', -1);

        //var_dump($rooms);
        //$service = new Soap\ResabookingService();
        $service = $this->container->get('resa_booking');
        $response = $service->availabilityhotel(null,'hammamet',null,'2015-09-14','2015-09-18',$rooms,$login,$pass,'fr','Magrabein','dt',null,null,null);
        // $response = $service->getFunctions();
        dump($response);

        return $this->render('BackResaBookingBundle:liste:index.html.twig', array('name' => $name));
    }

    public function listeAction ($chambres = 1 , $adults= 2 ,$enfants= 0 ) {

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $service = $this->container->get('resa_booking');

        $config = $this->container->getParameter('resa_booking');
        $login = $config['login'];
        $pass = $config['password'];

        $arrayOfTraveller = array();
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

        $response = $service->availabilityhotel(null,'hammamet',null,date("Y-m-d"),'2015-10-03',$rooms,$login,$pass,'fr','Magrabein','dt',null,null,null);
        $response = (array) $response ;

        $hotel_ref = null ;
        if($response['hots'] != null ) {
            $ids = array();
            foreach($response['hots'] as $hot ) {
                $ids[]= $hot->id;
            }

            $hotel_ref = $em->getRepository("BackResaBookingBundle:Hotel")->linkHotels($ids);

        }
        return $this->render('BackResaBookingBundle:liste:index.html.twig', array('test' => $hotel_ref));
    }
}



