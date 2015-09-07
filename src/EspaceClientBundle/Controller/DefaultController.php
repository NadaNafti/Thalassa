<?php
    namespace EspaceClientBundle\Controller;

    use Back\HotelTunisieBundle\Entity\Reservation;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class DefaultController extends Controller
    {
        public function indexAction()
        {
            $user = $this->container->get('security.context')->getToken()->getUser();
            if(is_null($user->getClient()))
            {
                $this->getRequest()->getSession()->getFlashBag()->add('info',"Vous devez avoir un compte client pour acceder au espace client ");
                return $this->redirect($this->generateUrl('tableaubord'));
            }
            return $this->render('EspaceClientBundle::dashboard.html.twig');
        }

        public function hotelTunisieAction($page)
        {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $paginator = $this->get('knp_paginator');
            $reservations = $paginator->paginate($user->getClient()->getReservationsSHT(),$page,10);
            return $this->render('EspaceClientBundle::hotel_tunisie.html.twig',array('reservations' => $reservations));
        }

        public function hotelTunisieDetailsAction(Reservation $reservation)
        {
            return $this->render('EspaceClientBundle::hotel_tunisie_details.html.twig',array('reservation' => $reservation));
        }

        public function voyagesAction($page)
        {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $paginator = $this->get('knp_paginator');
            $reservations = $paginator->paginate($user->getClient()->getReservationsVO(),$page,10);
            return $this->render('EspaceClientBundle::voyages_organisees.html.twig',array('reservations' => $reservations));
        }

        public function programmesAction($page)
        {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $paginator = $this->get('knp_paginator');
            $reservations = $paginator->paginate($user->getClient()->getReservationsPR(),$page,10);
            return $this->render('EspaceClientBundle::programmes.html.twig',array('reservations' => $reservations));
        }
    }
