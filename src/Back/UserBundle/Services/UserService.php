<?php

namespace Back\UserBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\UserBundle\Entity\Client;

class UserService
{

    protected $em;
    protected $session;
    protected $container;
    protected $mailer;
    protected $templating;

    public function __construct(EntityManager $em, Session $session, Container $container, \Swift_Mailer $mailer, $templating)
    {
	$this->em = $em;
	$this->session = $session;
	$this->container = $container;
	$this->mailer = $mailer;
	$this->templating = $templating;
    }

    public function getPassager()
    {
	$passager = $this->em->getRepository('BackUserBundle:Client')->findOneBy(array('passager' => TRUE));
	if (!$passager)
	{
	    $passager = new Client();
	    $passager->setPassager(TRUE)
		    ->setNomPrenom('Passager')
		    ->setTel1('No Tel')
		    ->setAdresse('No Address');
	    $this->em->persist($passager);
	    $this->em->flush();
	}
	return $passager->setNomPrenom(NULL)->setTel1(NULL)->setAdresse(NULL);
    }

    public function refreshPassager()
    {
	$passager = $this->em->getRepository('BackUserBundle:Client')->findOneBy(array('passager' => TRUE));
	if ($passager)
	{
	    $passager->setPassager(TRUE)
		    ->setNomPrenom('Passager')
		    ->setTel1('No Tel')
		    ->setAdresse('No Address');
	    $this->em->persist($passager);
	    $this->em->flush();
	}
    }

}
