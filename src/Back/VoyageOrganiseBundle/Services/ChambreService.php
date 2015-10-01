<?php
namespace Back\VoyageOrganiseBundle\Services;

use Back\VoyageOrganiseBundle\Entity\Chambre;
use Back\VoyageOrganiseBundle\Entity\Contingent;
use Back\VoyageOrganiseBundle\Entity\ReservationPersonne;
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
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong> Une chambre single a été crée ");
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
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong>  Une chambre double a été crée ");
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
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong>  Une chambre triple a été crée ");
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
                $this->session->getFlashBag()->add('info',"<strong>$nameHotel: </strong>  Une chambre quadruple a été crée ");
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
    }

    public function updatePersonne(ReservationPersonne $personne,$i)
    {
        $pack=$personne->getChambre()->getReservation()->getPack();
        $array=array('chambre_single','chambre_double','chambre_triple','chambre_quadruple');
        $chambres = array(
            array('single',1,$pack->getSingleAchat(),$pack->getSingleVente()),
            array('double',2,$pack->getDoubleAchat(),$pack->getDoubleVente()),
            array('triple',3,$pack->getTripleAchat(),$pack->getTripleVente()),
            array('quadruple',4,$pack->getQuadrupleAchat(),$pack->getQuadrupleVente()),
        );
        switch($i)
        {
            case  1 : $ch="chambre_single";
            case  2 : $ch="chambre_double";
            case  3 : $ch="chambre_triple";
            case  4 : $ch="chambre_quadruple";
        }
        foreach($personne->getLignes() as $ligne)
        {
            if (in_array($ligne->getCode(), $array))
            {
                if($ch!=$ligne->getCode())
                {
                    $ligne
                        ->setLibelle('Logement chambre ' . $chambres[$i-1][0])
                        ->setCode($ch)
                        ->setAchat($chambres[$i-1][2])
                        ->setVente($chambres[$i-1][3]);
                    $this->em->persist($ligne);
                }
                return true;
            }
        }
    }
}
