<?php

namespace Front\GeneralBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ReservationListnerPR
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
        if ($route == 'front_programme_details' )
        {
            $programme = $this->em->getRepository('BackProgrammeBundle:Programme')->findOneBy(array('slug' => $request->get('slug')));
            if (!$programme)
                $event->setResponse(new RedirectResponse($this->router->generate('front_programme_liste')));
        }
    }

}
