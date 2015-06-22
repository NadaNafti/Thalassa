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
use Back\HotelTunisieBundle\Entity\ReservationRepository;

class ReservationController extends Controller
{

    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $form = $this->createForm(new NewReservationType());
        if ($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if ($form->isValid())
            {
                $data = $form->getData();
                if ($data['dateDebut']->format('Y-m-d') <= date('Y-m-d'))
                    $form->get('dateDebut')->addError(new FormError(" Votre date doit être supérieure à la date " . date('d/m/Y')));
                elseif (is_null($data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))) || !$data['hotels']->getSaisonBase()->isValidSaisonBase())
                    $form->get('hotels')->addError(new FormError(" La saison de base est invalide !!!"));
                elseif ($data['hotels']->getSaisonPromotionByDate(date('Y-m-d'))->getMinStay() > $data['nuitees'])
                    $form->get('nuitees')->addError(new FormError(" Nombre de nuitées doit être supérieure ou égale au min stay " . $data['hotels']->getSaisonPromotionByDate(date('d/m/Y'))->getMinStay()));
                else
                {
                    $reservation = array();
                    $reservation['hotel'] = $data['hotels']->getId();
                    $reservation['client'] = $data['client']->getId();
                    $reservation['dateDebut'] = $data['dateDebut']->format('Y-m-d');
                    $reservation['dateFin'] = date('Y-m-d', strtotime($reservation['dateDebut'] . ' + ' . ($data['nuitees'] - 1) . ' day'));
                    $reservation['nuitees'] = $data['nuitees'];
                    $session->set("reservation", $reservation);
                    return $this->redirect($this->generateUrl("formulaire_reservation"));
                }
            }
        }
        return $this->render('BackHotelTunisieBundle:Reservation:new.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function ajaxVilleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $id = $request->get("id");
        $response = new JsonResponse();
        if ($id != '')
        {
            $ville = $em->getRepository("BackHotelTunisieBundle:Ville")->find($id);
            $hotels = $em->getRepository("BackHotelTunisieBundle:Hotel")->findBy(
                    array('ville' => $ville), array('libelle' => 'asc')
            );
        }
        else
            $hotels = $em->getRepository("BackHotelTunisieBundle:Hotel")->findAll();
        $tab = array();
        foreach ($hotels as $hotel)
            $tab[$hotel->getId()] = $hotel->getLibelle();
        $response->setData($tab);
        return $response;
    }

    public function formulaireAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (!$session->has("reservation"))
            return $this->redirect($this->generateUrl("new_reservation"));
        $reservation = $session->get('reservation');
        $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']);
        $client = $em->getRepository("BackUserBundle:Client")->find($reservation['client']);
        $dateDebut = new \DateTime($reservation['dateDebut']);
        $dateFin = new \DateTime($reservation['dateFin']);
        $saison = new Saison();
        $saison = $this->container->get('saisons')->getSaisonByClient($hotel, $client, $reservation['dateDebut']);
        if ($request->isMethod("POST"))
        {
            $reservation['saison'] = $saison->getId();
            $reservation['chambres'] = array();
            $Verif = FALSE;
            foreach ($saison->getChambres() as $chambre)
            {
                $tab = array();
                $idch = $chambre->getChambre()->getId();
                if ($request->get("chambre_" . $idch) > 0)
                {
                    $Verif = TRUE;
                    for ($i = 1; $i <= $request->get("chambre_" . $idch); $i++)
                    {
                        $occupants = $request->get('adulte_' . $idch . '_' . $i);
                        for ($j = 1; $j <= $request->get('enfant_' . $idch . '_' . $i); $j++)
                            $occupants.=',' . $request->get('age_' . $idch . '_' . $i . '_' . $j);
                        $tab['chambre'] = $idch;
                        $tab['occupants'] = $occupants;
                        $tab['arrangement'] = $request->get('arrangement_' . $idch . '_' . $i);
                        $tab['supp'] = array();
                        $tab['vue'] = array();
                        $tab['reduc'] = array();
                        foreach ($saison->getAutresSupplements() as $supp)
                        {
                            if ($this->container->get('Library')->verifSuppReducDate($supp->getSupp(), $dateDebut, $dateFin) && $supp->getSupp()->getObligatoire() || $request->get('supp_' . $idch . '_' . $i . '_' . $supp->getSupp()->getId()))
                                $tab['supp'][] = $supp->getSupp()->getId();
                        }

                        foreach ($saison->getAutresReductions() as $reduc)
                        {
                            if ($this->container->get('Library')->verifSuppReducDate($reduc->getReduc(), $dateDebut, $dateFin))
                                $tab['reduc'][] = $reduc->getReduc()->getId();
                        }
                        foreach ($saison->getVues() as $vue)
                        {
                            if ($request->get('vue_' . $idch . '_' . $i . '_' . $vue->getVue()->getId()))
                                $tab['vue'][] = $vue->getVue()->getId();
                        }
                        $reservation['chambres'][] = $tab;
                    }
                }
            }
            $session->set('reservation', $reservation);
            if ($Verif)
                return $this->redirect($this->generateUrl("details_reservation"));
            else
            {
                $session->getFlashBag()->add('info', "Vous devez choisir au moin une chambre");
                return $this->redirect($this->generateUrl("formulaire_reservation"));
            }
        }
        $calendrier = $this->container->get('reservation')->getCalendrier($reservation);
        return $this->render('BackHotelTunisieBundle:Reservation:formulaire.html.twig', array(
                    'calendrier' => $calendrier,
                    'hotel' => $hotel,
                    'nuitees' => $reservation['nuitees'],
                    'dateDebut' => $dateDebut,
                    'dateFin' => $dateFin,
                    'client' => $client,
                    'saison' => $saison
        ));
    }

    public function saisonAjaxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $saison = $em->getRepository("BackHotelTunisieBundle:Saison")->find($this->getRequest()->get('id'));
        $hotel = $saison->getHotel();
        return $this->render('BackHotelTunisieBundle:Reservation:ajaxSaison.html.twig', array(
                    'saison' => $saison,
                    'hotel' => $hotel
        ));
    }

    public function detailsAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (!$session->has("reservation"))
            return $this->redirect($this->generateUrl("new_reservation"));
        $reservation = $session->get('reservation');
        $hotel = $em->getRepository('BackHotelTunisieBundle:Hotel')->find($reservation['hotel']);
        $client = $em->getRepository("BackUserBundle:Client")->find($reservation['client']);
        $form = $this->createFormBuilder()
                ->add("client", new ClientType(), array('data' => $client));
        $ordre = 1;
        $chambres = array();
        foreach ($reservation['chambres'] as $value)
        {
            $adulte = array();
            $enfant = array();
            $tab = explode(',', $value['occupants']);
            for ($i = 1; $i <= $tab[0]; $i++)
            {
                $form->add("chambre" . $ordre . "adulte" . $i, 'text');
                $adulte[] = "chambre" . $ordre . "adulte" . $i;
            }
            for ($i = 1; $i <= count($tab) - 1; $i++)
            {
                $form->add("chambre" . $ordre . "Enfant" . $i, 'text');
                $enfant[] = "chambre" . $ordre . "Enfant" . $i;
            }
            $ordre++;
            $chambres[] = array('chambre' => $value['chambre'], 'adultes' => $adulte, 'enfants' => $enfant);
        }
        foreach ($hotel->getOptions() as $option)
            $form->add('option_' . $option->getId(), 'checkbox', array('label' => $option->getLibelle(), 'required' => false));
        $form = $form->getForm();
        $result = $this->container->get('reservation')->reservation($reservation);
        if ($request->isMethod('post'))
        {
            $form->submit($request);
            $data = $form->getData();
            $result = $this->container->get('reservation')->saveReservation($data, $result, 'backoffice');
            $session->remove('reservation');
            $session->getFlashBag()->add('success', " Votre Réservation a été enregistré avec succées ");
            return $this->redirect($this->generateUrl("liste_reservations"));
        }
        $reservation = $session->get('reservation');
        return $this->render('BackHotelTunisieBundle:Reservation:details.html.twig', array(
                    'form' => $form->createView(),
                    'chambres' => $chambres,
                    'hotel' => $hotel,
                    'client' => $client,
                    'nuitees' => $reservation['nuitees'],
                    'dateDebut' => new \DateTime($reservation['dateDebut']),
                    'dateFin' => new \DateTime($reservation['dateFin']),
                    'resultat' => $result,
        ));
    }

    public function listeAction($page,$etat, $amicale,$sort,$direction)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $amicales = $em->getRepository('BackAdministrationBundle:Amicale')->findBy(array(), array('libelle' => 'asc'));
        $query = $em->getRepository('BackHotelTunisieBundle:Reservation')->filtreBackOffice($etat, $amicale,$sort,$direction);
        $paginator = $this->get('knp_paginator');
        $reservations = $paginator->paginate($query, $request->query->get('page', 1), 20);
        return $this->render('BackHotelTunisieBundle:Reservation:liste.html.twig', array(
                    'reservations' => $reservations,
                    'amicales' => $amicales,
        ));
    }

    public function filtreAction()
    {
        $request = $this->getRequest();
        return $this->redirect($this->generateUrl('liste_reservations', array(
                            'etat' => $request->get('etat'),
                            'amicale' => $request->get('amicale'),
        )));
    }

    public function prisEnChargeAction(Reservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        $em->flush();
        $session->getFlashBag()->add('success', "Vous avez pris en charge cette réservation avec succées ");
        return $this->redirect($this->generateUrl("liste_reservations"));
    }

    public function consulterAction(Reservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        return $this->render('BackHotelTunisieBundle:Reservation:consultation.html.twig', array(
                    'reservation' => $reservation,
        ));
    }

    public function voucherAction(Reservation $reservation)
    {
        if ($reservation->getEtat() != 2)
            return $this->redirect($this->generateUrl("liste_reservations"));
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        return $this->render('BackHotelTunisieBundle:Reservation:voucher.html.twig', array(
                    'reservation' => $reservation,
                    'agence' => $em->getRepository('BackAdministrationBundle:Agence')->find(1)
        ));
    }

    public function voucherPrixAction(Reservation $reservation)
    {
        if ($reservation->getEtat() != 2)
            return $this->redirect($this->generateUrl("liste_reservations"));
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($reservation->setResponsable($user));
        return $this->render('BackHotelTunisieBundle:Reservation:voucher_prix.html.twig', array(
                    'reservation' => $reservation,
                    'agence' => $em->getRepository('BackAdministrationBundle:Agence')->find(1)
        ));
    }

    public function deleteAction(Reservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId())
        {
            $em->remove($reservation);
            $em->flush();
            $session->getFlashBag()->add('success', "Réservation a été supprimée avec succées ");
        }
        return $this->redirect($this->generateUrl("liste_reservations"));
    }

    public function annulerAction(Reservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId())
        {
            $em->persist($reservation->setEtat(9)->setCommentaire($request->get('commentaire')));
            $em->flush();
            $session->getFlashBag()->add('success', "Réservation a été annullée avec succées ");
        }
        return $this->redirect($this->generateUrl("consulter_reservation", array('id' => $reservation->getId())));
    }

    public function validerAction(Reservation $reservation)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        if ($user->getId() == $reservation->getResponsable()->getId()  && $reservation->getEtat()==1)
        {
            if (!is_null($reservation->getClient()->getAmicale()))
            {
                if ($reservation->getClient()->getAmicale()->getMontant() + $reservation->getTotal() > $reservation->getClient()->getAmicale()->getPlafond())
                {
                    $session->getFlashBag()->add('warning', "Impossible de valider la réservation pour l'amicale " . $reservation->getClient()->getAmicale()->getLibelle() . "  Plafond insuffisant.   <br>Palfond : " . $reservation->getClient()->getAmicale()->getPlafond() . " DT et le  montant courrant est :" . $reservation->getClient()->getAmicale()->getMontant() . " DT");
                    return $this->redirect($this->generateUrl("consulter_reservation", array('id' => $reservation->getId())));
                }
                $em->persist($reservation->getClient()->getAmicale()->setMontant($reservation->getClient()->getAmicale()->getMontant() + $reservation->getTotal()));
            }
            $em->persist($reservation->setEtat(2)->setCommentaire($request->get('commentaire'))->setValidated(new \DateTime())->setCode($this->container->get('reservation')->getCode()));
            $em->flush();
            $session->getFlashBag()->add('success', "Réservation a été validée avec succées ");
        }
        return $this->redirect($this->generateUrl("consulter_reservation", array('id' => $reservation->getId())));
    }

}
