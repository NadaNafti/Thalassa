<?php

namespace Back\ResaBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Back\ResaBookingBundle\Soap ;
use Back\ResaBookingBundle\Entity\Hotel;
use Back\ResaBookingBundle\Form\HotelType;


class BookingController extends Controller
{

    public function listeAction($page, $region,$categorie, $etat, $libelle, $sort, $direction)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $hotels = $em->getRepository("BackResaBookingBundle:Hotel")->findAll();
        //$hotels = $em->getRepository("BackResaBookingBundle:Hotel")->filtreBackOffice($region,$categorie, $etat, $libelle, $sort, $direction);
        //$region = $em->getRepository('BackHotelTunisieBundle:ville')->findBy(array(), array('libelle' => 'asc'));

        //$categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
        $paginator = $this->get('knp_paginator');
        $hotels = $paginator->paginate($hotels, $page, 20);
        return $this->render('BackResaBookingBundle:Back:liste.html.twig', array(
            'hotels' => $hotels,
            //'region' => $region,
            //'categories' => $categories,
        ));
    }



    public function generateAction() {
        $session = $this->getRequest()->getSession();
       try
       {
            $url = "http://www.resabooking.com/prod_magrebein_olevoyages_dt.xml";
            $xml = simplexml_load_file($url,"SimpleXMLELement",LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            $hotels = array();
            $coup = 0 ;
            foreach ($array['produit'] as $k => $produit) {

                $hotels[] = array(
                    'id_hotel' => $produit['id_hotel'],
                    'libelle_hotel' => $produit['libelle_hotel'],
                    'region' => $produit['region'],
                    'categorie' => $produit['categrie'],

                    'adresse'   => $produit['adresse'] ,
                    'responsable_reservation'   => $produit['responsable_reservation'],
                    'email'   => $produit['email'] ,
                    'tel'   => $produit['tel'],
                    'fax'   => $produit['fax'],
                    'latitude'  => $produit['latitude'] ,
                    'longitude'  => $produit['longitude'] ,
                    'responsable_commercial'  => $produit['responsable_commercial'],
                    'email_commercial'  => $produit['email_commercial'],
                    'responsable_financier'  => $produit['responsable_financier'],
                    'email_financier'  => $produit['email_financier'],

                );
            }
            if( count($hotels)  > 0 ) {
                $em = $this->getDoctrine()->getManager();

                foreach($hotels as $key => $hot ) {
                    $hotel = new Hotel();

                    $exist = $em->getRepository("BackResaBookingBundle:Hotel")->findBy(array('idResa' => $hot['id_hotel'] ));
                    if(count($exist) > 0 ) {
                        continue ;
                    }


                    $Adresse = is_array($hot['adresse']) ? 'Non disponible' : $hot['adresse'] ;
                    $Tel = is_array($hot['tel']) ? 'Non disponible' :$hot['tel'] ;
                    $Fax = is_array($hot['fax']) ? 'Non disponible' :$hot['fax'] ;
                    $Latitude = is_array($hot['latitude']) ? 'Non disponible' : $hot['latitude'];
                    $Longitude = is_array($hot['longitude']) ? 'Non disponible' : $hot['longitude'] ;
                    $Email = is_array($hot['email']) ? 'Non disponible' : $hot['email'] ;
                    $ResponsableReservation = is_array($hot['responsable_reservation']) ? 'Non disponible' : $hot['responsable_reservation'] ;
                    $ResponsableCommercial = is_array($hot['responsable_commercial']) ? 'Non disponible' : $hot['responsable_commercial'] ;
                    $EmailCommercial = is_array($hot['email_commercial']) ? 'Non disponible' :  $hot['email_commercial'];
                    $ResponsableFinancier = is_array($hot['responsable_financier']) ? 'Non disponible' : $hot['responsable_financier'] ;
                    $EmailFinancier = is_array($hot['email_financier']) ? 'Non disponible' : $hot['email_financier'] ;


                    $info = '<ul>';
                    $info.=    '<li><b>Adresse : </b>'.$Adresse.'</li>';
                    $info.=    '<li><b>Tel : </b>'.$Tel.'</li>';
                    $info.=    '<li><b>Fax : </b>'.$Fax.'</li>';
                    $info.=    '<li><b>Latitude : </b>'.$Latitude.'</li>';
                    $info.=    '<li><b>Longitude : </b>'.$Longitude.'</li>';
                    $info.=    '<li><b>Email : </b>'.$Email.'</li>';
                    $info.=    '<li><b>Responsable Reservation : </b>'.$ResponsableReservation.'</li>';
                    $info.=    '<li><b>Responsable Commercial : </b>'.$ResponsableCommercial.'</li>';
                    $info.=    '<li><b>Email Commercial : </b>'.$EmailCommercial.'</li>';
                    $info.=    '<li><b>Responsable Financier : </b>'.$ResponsableFinancier.'</li>';
                    $info.=    '<li><b>Email Financier : </b>'.$EmailFinancier.'</li>';
                    $info.= '</ul>';

                    $hotel->setIdResa($hot['id_hotel'])
                        ->setLibelleResa($hot['libelle_hotel'])
                        ->setRegion($hot['region'])
                        ->setCategorie($hot['categorie'])
                        ->setInfo($info);

                    $em->persist($hotel);
                    $coup++ ;
                }
                $em->flush();
            }
            if($coup > 0)
            {
                $session->getFlashBag()->add('success', $coup.'Hôtels mis à jour.');
            }
            if($coup == 0 )
            {
                $session->getFlashBag()->add('info', 'Aucune modification.');
            }
            return $this->redirect($this->generateUrl('liste_hotels'));
        }
       catch (\Exception $e)
       {
            $session->getFlashBag()->add('danger', 'Erreur. '.$e->getMessage());
            return $this->redirect($this->generateUrl('liste_hotels'));
        }


    }



    public function editAction(Hotel $hotel) {
        $session = $this->getRequest()->getSession();
        try
        {
            $em = $this->getDoctrine()->getManager();
            $request = $this->getRequest();
            $session = $request->getSession();
            if (!$hotel)
                throw $this->createNotFoundException('L\' hôtel n\'existe pas');
            $form = $this->createForm(new HotelType(), $hotel);
           // $form->remove('categorie');
            if ($request->isMethod("POST"))
            {
                $form->bind($request);
                if ($form->isValid())
                {
                    $hotel = $form->getData();
                    $em->persist($hotel);
                    $em->flush();
                    $session->getFlashBag()->add('success', "Rattachement des identifiants effectués avec success");
                    return $this->redirect($this->generateUrl("modif_resa_hotel", array('id' => $hotel->getId())));
                }
            }
            return $this->render('BackResaBookingBundle:Back:edit.html.twig', array(
                'form' => $form->createView(),
                'hotel' => $hotel
            ));
        }
        catch (\Exception $e)
        {
            $session->getFlashBag()->add('danger', 'Erreur. '.$e->getMessage());
            return $this->redirect($this->generateUrl('liste_hotels'));
        }
    }

}



