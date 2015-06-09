<?php

namespace Back\HotelTunisieBundle\Controller;

use Back\HotelTunisieBundle\Entity\Saison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;
use Back\HotelTunisieBundle\Form\NewReservationType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Back\UserBundle\Form\ClientType;
use Back\HotelTunisieBundle\Entity\Reservation;
use Back\HotelTunisieBundle\Entity\ReservationPersonne;
use Back\HotelTunisieBundle\Entity\ReservationLigne;
use Back\HotelTunisieBundle\Entity\ReservationJour;
use Back\HotelTunisieBundle\Entity\ReservationChambre;

class ReservationController extends Controller
{

    public function newAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $form=$this->createForm(new NewReservationType());
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $data=$form->getData();
                if($data['dateDebut']->format('Y-m-d') <= date('Y-m-d'))
                    $form->get('dateDebut')->addError(new FormError(" Votre date doit être supérieure à la date ".date('d/m/Y')));
                elseif(is_null($data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))) || !$data['hotels']->getSaisonBase()->isValidSaisonBase())
                    $form->get('hotels')->addError(new FormError(" La saison de base est invalide !!!"));
                elseif($data['hotels']->getSaisonPromotionByDate(date('Y-m-d'))->getMinStay() > $data['nuitees'])
                    $form->get('nuitees')->addError(new FormError(" Nombre de nuitées doit être supérieure ou égale au min stay ".$data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))->getMinStay()));
                else
                {
                    $reservation=array();
                    $reservation['hotel']=$data['hotels']->getId();
                    $reservation['client']=$data['client']->getId();
                    $reservation['dateDebut']=$data['dateDebut']->format('Y-m-d');
                    $reservation['dateFin']=date('Y-m-d', strtotime($reservation['dateDebut'].' + '.($data['nuitees'] - 1).' day'));
                    $reservation['nuitees']=$data['nuitees'];
                    $session->set("reservation", $reservation);
                    return $this->redirect($this->generateUrl("formulaire_reservation"));
                }
            }
        }
        return $this->render('BackHotelTunisieBundle:Reservation:new.html.twig', array(
                    'form'=>$form->createView()
        ));
    }

    public function ajaxVilleAction()
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $id=$request->get("id");
        $response=new JsonResponse();
        if($id != '')
        {
            $ville=$em->getRepository("BackHotelTunisieBundle:Ville")->find($id);
            $hotels=$em->getRepository("BackHotelTunisieBundle:Hotel")->findBy(
                    array( 'ville'=>$ville ), array( 'libelle'=>'asc' )
            );
        }
        else
            $hotels=$em->getRepository("BackHotelTunisieBundle:Hotel")->findAll();
        $tab=array();
        foreach($hotels as $hotel)
            $tab[$hotel->getId()]=$hotel->getLibelle();
        $response->setData($tab);
        return $response;
    }

    public function formulaireAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        if(!$session->has("reservation"))
            return $this->redirect($this->generateUrl("new_reservation"));
        $reservation=$session->get('reservation');
        $hotel=$em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']);
        $client=$em->getRepository("BackUserBundle:Client")->find($reservation['client']);
        $dateDebut=new \DateTime($reservation['dateDebut']);
        $dateFin=new \DateTime($reservation['dateFin']);
        $saison=new Saison();
        $saison=$this->container->get('saisons')->getSaisonByClient($hotel, $client, $reservation['dateDebut']);
        if($request->isMethod("POST"))
        {
            $reservation['saison']=$saison->getId();
            $reservation['chambres']=array();
            $Verif=FALSE;
            foreach($saison->getChambres() as $chambre)
            {
                $tab=array();
                $idch=$chambre->getChambre()->getId();
                if($request->get("chambre_".$idch) > 0)
                {
                    $Verif=TRUE;
                    for($i=1; $i <= $request->get("chambre_".$idch); $i++)
                    {
                        $occupants=$request->get('adulte_'.$idch.'_'.$i);
                        for($j=1; $j <= $request->get('enfant_'.$idch.'_'.$i); $j++)
                            $occupants.=','.$request->get('age_'.$idch.'_'.$i.'_'.$j);
                        $tab['chambre']=$idch;
                        $tab['occupants']=$occupants;
                        $tab['arrangement']=$request->get('arrangement_'.$idch.'_'.$i);
                        $tab['supp']=array();
                        $tab['vue']=array();
                        $tab['reduc']=array();
                        foreach($saison->getAutresSupplements() as $supp)
                        {
                            if($this->container->get('Library')->verifSuppReducDate($supp->getSupp(), $dateDebut, $dateFin) && $supp->getSupp()->getObligatoire() || $request->get('supp_'.$idch.'_'.$i.'_'.$supp->getSupp()->getId()))
                                $tab['supp'][]=$supp->getSupp()->getId();
                        }

                        foreach($saison->getAutresReductions() as $reduc)
                        {
                            if($this->container->get('Library')->verifSuppReducDate($reduc->getReduc(), $dateDebut, $dateFin))
                                $tab['reduc'][]=$reduc->getReduc()->getId();
                        }
                        foreach($saison->getVues() as $vue)
                        {
                            if($request->get('vue_'.$idch.'_'.$i.'_'.$vue->getVue()->getId()))
                                $tab['vue'][]=$vue->getVue()->getId();
                        }
                        $reservation['chambres'][]=$tab;
                    }
                }
            }
            $session->set('reservation', $reservation);
            if($Verif)
                return $this->redirect($this->generateUrl("details_reservation"));
            else
            {
                $session->getFlashBag()->add('info', "Vous devez choisir au moin une chambre");
                return $this->redirect($this->generateUrl("formulaire_reservation"));
            }
        }
//        $dates = $this->container->get('library')->getDatesBetween($reservation['dateDebut'] , $reservation['dateFin']) ;
        $calendrier=$this->container->get('reservation')->getCalendrier($reservation);
        return $this->render('BackHotelTunisieBundle:Reservation:formulaire.html.twig', array(
                    'calendrier'=>$calendrier,
                    'hotel'     =>$hotel,
                    'nuitees'   =>$reservation['nuitees'],
                    'dateDebut' =>$dateDebut,
                    'dateFin'   =>$dateFin,
                    'client'    =>$client,
                    'saison'    =>$saison
        ));
    }

    public function saisonAjaxAction()
    {
        $em=$this->getDoctrine()->getManager();
        $saison=$em->getRepository("BackHotelTunisieBundle:Saison")->find($this->getRequest()->get('id'));
        $hotel=$saison->getHotel();
        return $this->render('BackHotelTunisieBundle:Reservation:ajaxSaison.html.twig', array(
                    'saison'=>$saison,
                    'hotel' =>$hotel
        ));
    }

    public function detailsAction()
    {
        $user=$this->get('security.context')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        if(!$session->has("reservation"))
            return $this->redirect($this->generateUrl("new_reservation"));
        $reservation=$session->get('reservation');
        $hotel=$em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']);
        $client=$em->getRepository("BackUserBundle:Client")->find($reservation['client']);
        $form=$this->createFormBuilder()
                ->add("client", new ClientType(), array( 'data'=>$client ));
        $ordre=1;
        $chambres=array();
        foreach($reservation['chambres'] as $value)
        {
            $adulte=array();
            $enfant=array();
            $tab=explode(',', $value['occupants']);
            for($i=1; $i <= $tab[0]; $i++)
            {
                $form->add("chambre".$ordre."adulte".$i, 'text');
                $adulte[]="chambre".$ordre."adulte".$i;
            }
            for($i=1; $i <= count($tab) - 1; $i++)
            {
                $form->add("chambre".$ordre."Enfant".$i, 'text');
                $enfant[]="chambre".$ordre."Enfant".$i;
            }
            $ordre++;
            $chambres[]=array( 'chambre'=>$value['chambre'], 'adultes'=>$adulte, 'enfants'=>$enfant );
        }
        $form=$form->getForm();
        $result=$this->container->get('reservation')->reservation($reservation);
        if($request->isMethod('post'))
        {
            $form->submit($request);
            $data=$form->getData();
            $client=$data['client'];
            $em->persist($client);
            $reservation=new Reservation();
            $reservation->setClient($client)
                    ->setHotel($hotel)
                    ->setDateDebut(\DateTime::createFromFormat('Y-m-d', $result['dateDebut']))
                    ->setDateFin(\DateTime::createFromFormat('Y-m-d', $result['dateFin']))
                    ->setNuitees($result['nuitees'])
                    ->setSurDemande($result['surDemande'])
                    ->setResponsable($user)
                    ->setFrontOffice(0)
                    ->setEtat(1);
            $em->persist($reservation);
            $chambreOrdre=0;
            foreach($result['chambres'] as $chambre)
            {
                $noms=array();
                $chambreOrdre++;
                $reservationChambre=new ReservationChambre();
                $reservationChambre->setReservation($reservation)
                        ->setChambre($em->getRepository('BackHotelTunisieBundle:Chambre')->find($chambre['details']['chambre']))
                        ->setArrangements($em->getRepository('BackHotelTunisieBundle:Arrangement')->find($chambre['details']['arrangement']))
                        ->setOccupants(explode(',', $chambre['details']['occupants']))
                        ->setReductions($chambre['details']['reduc'])
                        ->setSupplements($chambre['details']['supp'])
                        ->setVues($chambre['details']['vue'])
                        ->setNoms(array());
                $em->persist($reservationChambre);
                foreach($chambre['adultes'] as $adulte)
                {
                    $ReservationPersonne=new ReservationPersonne();
                    $ReservationPersonne->setReservationChambreAdulte($reservationChambre)
                            ->setOrdre($adulte['ordre'])
                            ->setNom($data['chambre'.$chambreOrdre.'adulte'.$adulte['ordre']]);
                    $em->persist($ReservationPersonne);
                    $noms[]=$data['chambre'.$chambreOrdre.'adulte'.$adulte['ordre']];
                    foreach($adulte['jours'] as $jour)
                    {
                        $reservationJour=new ReservationJour();
                        $reservationJour->setPersonne($ReservationPersonne)
                                ->setJour(\DateTime::createFromFormat('Y-m-d', $jour['jour']))
                                ->setSaison($em->getRepository('BackHotelTunisieBundle:Saison')->find($jour['saison']['id']));
                        $em->persist($reservationJour);
                        foreach($jour['lignes'] as $ligne)
                        {
                            if(!is_null($ligne))
                            {
                                $reservationLigne=new ReservationLigne();
                                $reservationLigne->setJour($reservationJour)
                                        ->setCode($ligne['code'])
                                        ->setLibelle($ligne['name'])
                                        ->setAchat($ligne['achat'])
                                        ->setVente($ligne['vente']);
                                $em->persist($reservationLigne);
                            }
                        }
                    }
                }
                foreach($chambre['enfants'] as $enfant)
                {
                    $ReservationPersonne=new ReservationPersonne();
                    $ReservationPersonne->setReservationChambreEnfant($reservationChambre)
                            ->setOrdre($enfant['ordre'])
                            ->setNom($data['chambre'.$chambreOrdre.'Enfant'.$enfant['ordre']])
                            ->setAge($enfant['age']);
                    $em->persist($ReservationPersonne);
                    $noms[]=$data['chambre'.$chambreOrdre.'Enfant'.$enfant['ordre']];
                    foreach($enfant['jours'] as $jour)
                    {
                        $reservationJour=new ReservationJour();
                        $reservationJour->setPersonne($ReservationPersonne)
                                ->setJour(\DateTime::createFromFormat('Y-m-d', $jour['jour']))
                                ->setSaison($em->getRepository('BackHotelTunisieBundle:Saison')->find($jour['saison']['id']));
                        $em->persist($reservationJour);
                        foreach($jour['lignes'] as $ligne)
                        {
                            if(!is_null($ligne))
                            {
                                $reservationLigne=new ReservationLigne();
                                $reservationLigne->setJour($reservationJour)
                                        ->setCode($ligne['code'])
                                        ->setLibelle($ligne['name'])
                                        ->setAchat($ligne['achat'])
                                        ->setVente($ligne['vente']);
                                $em->persist($reservationLigne);
                            }
                        }
                    }
                }
                $em->persist($reservationChambre->setNoms($noms));
                foreach($chambre['supplements'] as $suppLigne)
                {
                    $reservationLigne=new ReservationLigne();
                    if(!is_null($suppLigne))
                    {
                        $reservationLigne=new ReservationLigne();
                        $reservationLigne->setSupplement($reservationChambre)
                                ->setCode($suppLigne['code'])
                                ->setLibelle($suppLigne['name'])
                                ->setAchat($suppLigne['achat'])
                                ->setVente($suppLigne['vente']);
                        $em->persist($reservationLigne);
                    }
                }
                foreach($chambre['reductions'] as $reducLigne)
                {
                    $reservationLigne=new ReservationLigne();
                    if(!is_null($reducLigne))
                    {
                        $reservationLigne=new ReservationLigne();
                        $reservationLigne->setReduction($reservationChambre)
                                ->setCode($reducLigne['code'])
                                ->setLibelle($reducLigne['name'])
                                ->setAchat($reducLigne['achat'])
                                ->setVente($reducLigne['vente']);
                        $em->persist($reservationLigne);
                    }
                }
            }
            $em->flush();
            $session->remove('reservation');
            $session->getFlashBag()->add('success', " Votre Réservation a été enregistré avec succées ");
            return $this->redirect($this->generateUrl("new_reservation"));
        }
        $reservation=$session->get('reservation');
        return $this->render('BackHotelTunisieBundle:Reservation:details.html.twig', array(
                    'form'     =>$form->createView(),
                    'chambres' =>$chambres,
                    'hotel'    =>$hotel,
                    'client'   =>$client,
                    'nuitees'  =>$reservation['nuitees'],
                    'dateDebut'=>new \DateTime($reservation['dateDebut']),
                    'dateFin'  =>new \DateTime($reservation['dateFin']),
                    'resultat' =>$result,
        ));
    }

}
