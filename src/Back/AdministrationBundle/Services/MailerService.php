<?php

namespace Back\AdministrationBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Back\AdministrationBundle\Entity\EmailRepository;
use Back\HotelTunisieBundle\Entity\Reservation;

class MailerService
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

    public function sendMailHotel(Reservation $reservation)
    {
        $agence = $this->em->getRepository('BackAdministrationBundle:Agence')->find(1);
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_null($reservation->getHotel()->getEmail()) && false) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Nouvelle Réservation de la par ' . $agence->getNom())
                ->setFrom($user->getEmail())
                ->setTo($reservation->getHotel()->getEmail())
                ->setCc($user->getEmail());
            $emails = $this->em->getRepository('BackAdministrationBundle:Email')->findByProduit('SHT');
            foreach ($emails as $email)
                $message->addCc($email->getEmail());
            $message->setContentType("text/html");
            $message->setCharset("utf-8");
            $message->setBody($this->templating->render('BackAdministrationBundle:mails:notifierHotel.html.twig', array(
                'reservation' => $reservation,
            )));
            return $this->mailer->send($message);
        }
        return false;
    }

    public function annulation($reservation,$code)
    {
        $agence = $this->em->getRepository('BackAdministrationBundle:Agence')->find(1);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject($agence->getNom()." : Annulation d'une réservation  ".$code )
            ->setFrom($user->getEmail())
            ->setTo($user->getEmail());
        $emails = $this->em->getRepository('BackAdministrationBundle:Email')->findByProduit($code,'annulation');
        foreach ($emails as $email)
            $message->addCc($email->getEmail());
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:annulation.html.twig', array(
            'reservation' => $reservation,
            'code'=>$code
        )));
        return $this->mailer->send($message);
        return false;
    }

    public function validation($reservation,$code)
    {
        $agence = $this->em->getRepository('BackAdministrationBundle:Agence')->find(1);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject($agence->getNom()." : Validation d'une réservation  ".$code )
            ->setFrom($user->getEmail())
            ->setTo($user->getEmail());
        $emails = $this->em->getRepository('BackAdministrationBundle:Email')->findByProduit($code,'validation');
        foreach ($emails as $email)
            $message->addCc($email->getEmail());
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:validation.html.twig', array(
            'reservation' => $reservation,
            'code'=>$code
        )));
        return $this->mailer->send($message);
        return false;
    }

    public function creationBack($reservation,$code)
    {
        $agence = $this->em->getRepository('BackAdministrationBundle:Agence')->find(1);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject($agence->getNom()." : Nouvelle réservation BackOffice  ".$code )
            ->setFrom($user->getEmail())
            ->setTo($user->getEmail());
        $emails = $this->em->getRepository('BackAdministrationBundle:Email')->findByProduit($code,'creationBack');
        foreach ($emails as $email)
            $message->addCc($email->getEmail());
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:creationBack.html.twig', array(
            'reservation' => $reservation,
            'code'=>$code
        )));
        return $this->mailer->send($message);
        return false;
    }

    public function creationFront($reservation,$code)
    {
        $agence = $this->em->getRepository('BackAdministrationBundle:Agence')->find(1);
        $message = \Swift_Message::newInstance()
            ->setSubject($agence->getNom()." : Nouvelle réservation FrontOffice  ".$code )
            ->setFrom($agence->getContactEmail())
            ->setTo($agence->getContactEmail());
        $emails = $this->em->getRepository('BackAdministrationBundle:Email')->findByProduit($code,'creationFront');
        foreach ($emails as $email)
            $message->addCc($email->getEmail());
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:creationFront.html.twig', array(
            'reservation' => $reservation,
            'code'=>$code
        )));
        return $this->mailer->send($message);
        return false;
    }

}
