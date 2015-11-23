<?php

namespace Front\GeneralBundle\Controller;

use Back\ResaBookingBundle\Entity\Hotel;
use Back\ResaBookingBundle\Entity\Reservation;
use Back\ResaBookingBundle\WSDL\infoagence;
use Back\ResaBookingBundle\WSDL\chambs;
use Back\ResaBookingBundle\WSDL\Traveller;
use Back\ResaBookingBundle\WSDL\Travellers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ResaBookingController extends Controller
{
    public function initialiseAction()
    {
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            return $this->redirect($this->generateUrl('front_resabooking_liste',array(
                'region'=>urlencode($request->get('region')),
                'debut'=>$request->get('debut'),
                'fin'=>$request->get('fin'),
            )));
        }
        return $this->redirect($this->generateUrl('front_resabooking_liste',array(
            'debut'=>date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days')),
            'fin'=>date('Y-m-d', strtotime(date('Y-m-d'). ' + 2 days')),
        )));
    }

    public function listeAction($page,$region,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        $rooms= $this->container->get('resabookingservice')->getRooms($room1,$room2,$room3,$room4,$room5);
        $reponse=$this->container->get('resabookingservice')->availabilityHotel($region,$debut,$fin, $rooms);
        if($reponse->rep->statut=='failure')
            $this->getRequest()->getSession()->getFlashBag()->add('warning', $reponse->rep->detail_erreur);
        return $this->render('FrontGeneralBundle:resabooking/liste:liste.html.twig',array('reponse'=>$reponse));
    }

    public function detailsUpdateRoomsAction($hotel)
    {
        $room1=null;
        $room2=null;
        $room3=null;
        $room4=null;
        $room5=null;
        $request=$this->getRequest();
        for($i=1;$i<=$request->get('nombreChambre');$i++)
        {
            $var='room'.$i;
            $$var=$request->get('adulte'.$i);
            for($j=1;$j<=$request->get('enfant'.$i);$j++)
                $$var.=','.$request->get("age_".$i."_".$j);
        }

        return $this->redirect($this->generateUrl('front_resabooking_details',array(
            'hotel'=>$hotel,
            'debut'=>$request->get('debut'),
            'fin'=>$request->get('fin'),
            'room1'=>$room1,
            'room2'=>$room2,
            'room3'=>$room3,
            'room4'=>$room4,
            'room5'=>$room5
        )));
    }

    public function detailsAction(Hotel $hotel,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        $reponse=$this->container->get('resabookingservice')->availabilityHotel($hotel->getProduit()['region'],$debut,$fin, $this->container->get('resabookingservice')->getRooms($room1,$room2,$room3,$room4,$room5),$hotel->getId());
        if($reponse->rep->statut=='failure')
            $this->getRequest()->getSession()->getFlashBag()->add('warning', $reponse->rep->detail_erreur);
        return $this->render('FrontGeneralBundle:resabooking/details:details.html.twig',array(
            'hotel'     =>$hotel,
            'reponse'   =>$reponse
        ));
    }

    public function devisAction($pension, Hotel $hotel,$debut,$fin,$room1,$room2,$room3,$room4,$room5)
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
            $client = $user->getClient();
        else
            $client = $this->container->get('users')->getPassager();
        $confPaiement = $em->find('BackHotelTunisieBundle:ConfigurationPayement', 1);
        if($confPaiement) {
            $choices[2] = 'Paiement Total en ligne';
            if($confPaiement->getAvance() != 0) {
                $choices[3] = 'Paiement avance de ' . $confPaiement->getAvance() . '% en ligne';
            }
        }
        $reponse=$this->container->get('resabookingservice')->availabilityHotel($hotel->getProduit()['region'],$debut,$fin, $this->container->get('resabookingservice')->getRooms($room1,$room2,$room3,$room4,$room5),$hotel->getId());
        if($reponse->rep->statut=='failure')
        {
            $this->getRequest()->getSession()->getFlashBag()->add('warning', $reponse->rep->detail_erreur);
            return $this->redirect($this->generateUrl('front_resabooking_initialise_date'));
        }
        $chambs=new chambs();
        foreach($reponse->hots[0]->chambres[0]->chambre[0]->chamb as  $chamb)
            $chambs->addChamb($chamb);
        $reponseDevis=$this->container->get('resabookingservice')->devis($reponse->session,$hotel->getId(),$pension,$chambs,null);
        if($reponseDevis->rep->statut=='failure')
        {
            $this->getRequest()->getSession()->getFlashBag()->add('warning', $reponseDevis->rep->detail_erreur);
            return $this->redirect($this->generateUrl('front_resabooking_initialise_date'));
        }
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $travellerPrincipale=new Traveller ('adult', null, null,null, $request->get("FirstName"),$request->get("LastName"), $request->get('civiliti'), $request->get('adresse'),$request->get('pays'), $request->get('ville'), $request->get('mail'),$request->get('tel'), $request->get('cp'));
            $travellers =new Travellers();
            $index=1;
            foreach($chambs->getChs() as $chamb)
            {
                for($i=1;$i<=$chamb->nombre_adult;$i++)
                {
                    $traveller= new Traveller('adult');
                    if($i==1 && $index==1)
                        $traveller=$travellerPrincipale;
                    else
                    {
                        $traveller->setFirstName($request->get($index."_AdulteFirstName_".$i));
                        $traveller->setLastName($request->get($index."_AdulteLastName_".$i));
                    }
                    $travellers->addTraveller($traveller);
                }
                for($i=1;$i<=$chamb->nombre_enfant;$i++)
                {
                    $traveller= new Traveller('enfant');
                    $traveller->setFirstName($request->get($index."_EnfantFirstName_".$i));
                    $traveller->setLastName($request->get($index."_EnfantLastName_".$i));
                    $travellers->addTraveller($traveller);
                }
                for($i=1;$i<=$chamb->nombre_bebe;$i++)
                {
                    $traveller= new Traveller('bebe');
                    $traveller->setFirstName($request->get($index."_BeBeFirstName_".$i));
                    $traveller->setLastName($request->get($index."_BeBeLastName_".$i));
                    $travellers->addTraveller($traveller);
                }
                $index++;
            }
            $reservation = new Reservation();
            $reservation->setClient($client)
                ->setChambs($chambs)
                ->setTraveller($travellerPrincipale)
                ->setTravellers($travellers)
                ->setHotel($hotel)
                ->setPension($pension)
                ->setReponseDevis($reponseDevis)
                ->setTotalAchat($reponseDevis->price)
                ->setTotal($this->get('resabookingservice')->margeResaBooking($reponseDevis->price))
                ->setDateDebut(\DateTime::createFromFormat('Y-m-d', $debut))
                ->setDateFin(\DateTime::createFromFormat('Y-m-d', $fin));
            if($request->get('paiement') == 3 && $confPaiement->getAvance()!=0)
                $montan = round($reservation->getTotal() * $confPaiement->getAvance() / 100);
            else
                $montan = $reservation->getTotal();
            $em->persist($reservation->setTypePayement($request->get('paiement'))->setMontantPayementElectronique($montan));
            $em->flush();
            return $this->redirect($confPaiement->getUrl() . 'RB-'.$reservation->getId() . '&Montant=' . $montan . '&Devise=TND&sid=' . session_id() . '&affilie=' . $confPaiement->getNumeroAffiliation());
        }
        return $this->render('FrontGeneralBundle:resabooking:devis.html.twig',array(
            'choinces'=>$choices,
            'hotel'=>$hotel,
            'chambs'=>$chambs->getChs(),
            'reponseDevis'=>$reponseDevis,
            'dateDebut'=> \DateTime::createFromFormat('Y-m-d', $debut),
            'dateFin'=> \DateTime::createFromFormat('Y-m-d', $fin),
        ));
    }
}
