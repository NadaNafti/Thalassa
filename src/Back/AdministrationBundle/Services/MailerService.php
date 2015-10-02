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
        if (!is_null($reservation->getHotel()->getEmail())) {
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
            $message->setBody($this->templating->render('BackAdministrationBundle:mails:email.html.twig', array(
                'reservation' => $reservation,
            )));
            return $this->mailer->send($message);
        }
        return false;
    }

}
