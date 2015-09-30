<?php
namespace Back\VoyageOrganiseBundle\Services;

use Back\VoyageOrganiseBundle\Entity\Chambre;
use Back\VoyageOrganiseBundle\Entity\Contingent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;

class ChambreService
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

    public function update(Contingent $contingent)
    {
        $nameHotel=$contingent->getHotel()->getLibelle();
        $nbrSingle = count($this->em->getRepository('BackVoyageOrganiseBundle:Chambre')->findBy(array('contingent' => $contingent, 'type' => 1)));
        $nbrDouble = count($this->em->getRepository('BackVoyageOrganiseBundle:Chambre')->findBy(array('contingent' => $contingent, 'type' => 2)));
        $nbrTriple = count($this->em->getRepository('BackVoyageOrganiseBundle:Chambre')->findBy(array('contingent' => $contingent, 'type' => 3)));
        $nbrQuadruple = count($this->em->getRepository('BackVoyageOrganiseBundle:Chambre')->findBy(array('contingent' => $contingent, 'type' => 4)));
        if ($contingent->getChambreSingle() > $nbrSingle) {
            for ($i = 1; $i <= ($contingent->getChambreSingle() - $nbrSingle); $i++) {
                $chambre = new Chambre();
                $this->em->persist($chambre->setContingent($contingent)->setType(1));
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong> Une chambre single a été créér ");
            }
        }
        if ($nbrSingle > $contingent->getChambreSingle()) {
            $i=$nbrSingle - $contingent->getChambreSingle();
            foreach($contingent->getChambres() as $chambre)
            {
                if($chambre->getType()==1 and $i>0)
                {
                    $this->em->remove($chambre);
                    $this->session->getFlashBag()->add('warning',"<strong>$nameHotel: </strong>  Une chambre single a été supprimée ");
                    $i--;
                }
            }
        }

        if ($contingent->getChambreDouble() > $nbrDouble) {
            for ($i = 1; $i <= ($contingent->getChambreDouble() - $nbrDouble); $i++) {
                $chambre = new Chambre();
                $this->em->persist($chambre->setContingent($contingent)->setType(2));
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong>  Une chambre double a été créér ");
            }
        }
        if ($nbrDouble > $contingent->getChambreDouble()) {
            $i=$nbrDouble - $contingent->getChambreDouble();
            foreach($contingent->getChambres() as $chambre)
            {
                if($chambre->getType()==2 and $i>0)
                {
                    $this->em->remove($chambre);
                    $this->session->getFlashBag()->add('warning',"<strong>$nameHotel: </strong>  Une chambre double a été supprimée ");
                    $i--;
                }
            }
        }

        if ($contingent->getChambreTriple() > $nbrTriple) {
            for ($i = 1; $i <= ($contingent->getChambreTriple() - $nbrTriple); $i++) {
                $chambre = new Chambre();
                $this->em->persist($chambre->setContingent($contingent)->setType(3));
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong>  Une chambre triple a été créér ");
            }
        }
        if ($nbrTriple > $contingent->getChambreTriple()) {
            $i=$nbrTriple - $contingent->getChambreTriple();
            foreach($contingent->getChambres() as $chambre)
            {
                if($chambre->getType()==3 and $i>0)
                {
                    $this->em->remove($chambre);
                    $this->session->getFlashBag()->add('warning',"<strong>$nameHotel: </strong>  Une chambre triple a été supprimée ");
                    $i--;
                }
            }
        }

        if ($contingent->getChambreQuadruple() > $nbrQuadruple) {
            for ($i = 1; $i <= ($contingent->getChambreQuadruple() - $nbrQuadruple); $i++) {
                $chambre = new Chambre();
                $this->em->persist($chambre->setContingent($contingent)->setType(4));
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong>  Une chambre quadruple a été créér ");
            }
        }
        if ($nbrQuadruple > $contingent->getChambreQuadruple()) {
            $i=$nbrQuadruple - $contingent->getChambreQuadruple();
            foreach($contingent->getChambres() as $chambre)
            {
                if($chambre->getType()==4 and $i>0)
                {
                    $this->em->remove($chambre);
                    $this->session->getFlashBag()->add('warning',"<strong>$nameHotel: </strong>  Une chambre quadruple a été supprimée ");
                    $i--;
                }
            }
        }

        $this->em->flush();
    }
}
