<?php

namespace Back\HotelTunisieBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ReservationBackListnerSHT
{

    public $session;
    public $em;
    public $router;
    public $securityContext;
    public $container;

    public function __construct($container, $session, $em)
    {
        $this->session = $session;
        $this->em = $em;
        $this->router = $container->get('router');
        $this->container=$container;
        $this->securityContext = $container->get('security.context');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');
        $request = $event->getRequest();
        if($route == 'consulter_reservation' || $route =='valider_reservation') {
            $reservation = $this->em->find('BackHotelTunisieBundle:Reservation',$request->get('id'));
            foreach($reservation->getChambres()->first()->getJours() as $jour) {
                $saison=$jour->getSaisonContingent();
                $date=$jour->getJour()->format('Y-m-d');
                if(!is_null($saison))
                {
                    if(!$this->container->get('saisons')->hasChambreContingent($saison, $date, count($reservation->getChambres())))
                    {
                        if($route =='valider_reservation')
                        {
                            $this->session->getFlashBag()->add('danger',"Vous devez régler le contingent de cette réservation avant de valider la réservation");
                            return $event->setResponse(new RedirectResponse($this->router->generate('consulter_reservation',array('id'=>$reservation->getId()))));
                        }
                        $query = $this->em->getRepository('BackHotelTunisieBundle:ReservationChambre')->getCountChambreContingent($saison, $date);
                        $chDispo=$saison->getNombreContingentDispo($date)-$query;
                        $mnq=count($reservation->getChambres())-$chDispo;
                        $this->session->getFlashBag()->add('info',$jour->getJour()->format('d/m/Y')." : Manque ".$mnq." chambre(s) contingent pour valider la réservation <a target='blank' href='".$this->router->generate('saison_contingent',array('id'=>$saison->getId()))."' >".$saison->getLibelle()."</a>");
                    }
                }
            }
        }
    }

}