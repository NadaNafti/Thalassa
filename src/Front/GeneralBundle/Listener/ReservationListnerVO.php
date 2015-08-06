<?php

namespace Front\GeneralBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ReservationListnerVO
{

    public $session;
    public $em;
    public $router;
    public $securityContext;

    public function __construct($container, $session, $em)
    {
        $this->session = $session;
        $this->em = $em;
        $this->router = $container->get('router');
        $this->securityContext = $container->get('security.context');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');
        $request = $event->getRequest();
        if ($route == 'front_voyageorganise_details' )
        {
            $voyage = $this->em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findOneBy(array('slug' => $request->get('slug')));
            if (!$voyage)
                $event->setResponse(new RedirectResponse($this->router->generate('front_voyageorganise_liste')));
        }
//        if ($route == 'front_voyageorganise_reservation')
//        {
//            $periode = $this->em->getRepository('BackVoyageOrganiseBundle:Periode')->find($request->get('periode'));
//            if (!$periode || !$periode->isValide())
//                $event->setResponse(new RedirectResponse($this->router->generate('front_voyageorganise_details', array('slug' => $request->get('slug')))));
//        }
    }

}
