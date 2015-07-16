<?php

namespace Front\GeneralBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ReservationListner
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
	if ($route == 'front_hoteltunisie_list' || $route == "front_hoteltunisie_details")
	{
	    if (!$this->session->has('nuitees'))
	    {
		$this->session->set('nuitees', 1);
		$this->session->set('dateDebut', Date('Y-m-d', strtotime("+1 days")));
	    }
	    if ($route == "front_hoteltunisie_details")
	    {
		$hotel = $this->em->getRepository('BackHotelTunisieBundle:Hotel')->findOneBy(array('slug' => $request->get('slug')));
		if ($hotel)
		{
		    $saison = $hotel->getSaisonPromotionByDate($this->session->get('dateDebut'));
		    if ($saison->getMinStay() > $this->session->get('nuitees'))
		    {
			$this->session->set('nuitees', $saison->getMinStay());
			$this->session->getFlashBag()->add('Info', " Le min Stay est " . $saison->getMinStay());
		    }
		}
		else
		    $event->setResponse(new RedirectResponse($this->router->generate('front_hoteltunisie_list')));
	    }
	}
    }

}
