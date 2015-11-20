<?php

namespace Back\HotelTunisieBundle\Controller;

use Back\HotelTunisieBundle\Form\ReportingArrangementType;
use Back\HotelTunisieBundle\Form\ReportingNombreReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportingController extends Controller
{
    public function nombreReservationAction()
    {
        $form = $this->createForm(new ReportingNombreReservationType());
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            $data=$form->getData();
            $array=array();
            $array['annee']=$data['annee'];
            $array['etat']=$data['etat'];
            if(count($data['mois'])==0)
                $array['mois']='all';
            else
            {
                $mois=array();
                foreach($data['mois'] as $moi)
                    $mois[]=$moi;
                $array['mois']=implode(',',$mois);
            }
            if(count($data['hotels'])==0)
                $array['hotels']='all';
            else
            {
                $hotels=array();
                foreach($data['hotels'] as $hotel)
                    $hotels[]=$hotel->getId();
                $array['hotels']=implode(',',$hotels);
            }
            if(count($data['regions'])==0)
                $array['regions']='all';
            else
            {
                $regions=array();
                foreach($data['regions'] as $region)
                    $regions[]=$region->getId();
                $array['regions']=implode(',',$regions);
            }
            if(count($data['users'])==0)
                $array['users']='all';
            else
            {
                $users=array();
                foreach($data['users'] as $user)
                    $users[]=$user->getId();
                $array['users']=implode(',',$users);
            }
            return $this->redirect($this->generateUrl('Hotel_Tunisie_Reporting_NombreReservation_stat',$array));
        }
        return $this->render('BackHotelTunisieBundle:Reporting:nombre_reservation_form.html.twig', array(
            'form' => $form->createView(),
            'titre' => "Nombre Réservation"
        ));
    }

    public function nombreReservationRapportAction($mois, $annee, $etat, $regions, $hotels, $users)
    {
        $dataParHotel=$this->get('reportingSHT')->getDataParHotel($mois, $annee, $etat, $regions, $hotels, $users,"nbr_reservation");
        $dataParRegion=$this->get('reportingSHT')->getDataParRegion($mois, $annee, $etat, $regions, $hotels, $users,"nbr_reservation");
        $dataOperateur=$this->get('reportingSHT')->getDataParOperateur($mois, $annee, $etat, $regions, $hotels, $users,"nbr_reservation");
        $dataSource=$this->get('reportingSHT')->getDataParSource($mois, $annee, $etat, $regions, $hotels, $users,"nbr_reservation");
        return $this->render('BackHotelTunisieBundle:Reporting:nombre_reservation_stats.html.twig',array(
            'dataHotel'=>$dataParHotel,
            'dataRegion'=>$dataParRegion,
            'dataOperateur'=>$dataOperateur,
            'dataSource'=>$dataSource,
            'titre' => "Nombre Réservation"
        ));
    }
    
    public function nombreNuiteeAction()
    {
        $form = $this->createForm(new ReportingNombreReservationType());
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            $data=$form->getData();
            $array=array();
            $array['annee']=$data['annee'];
            $array['etat']=$data['etat'];
            if(count($data['mois'])==0)
                $array['mois']='all';
            else
            {
                $mois=array();
                foreach($data['mois'] as $moi)
                    $mois[]=$moi;
                $array['mois']=implode(',',$mois);
            }
            if(count($data['hotels'])==0)
                $array['hotels']='all';
            else
            {
                $hotels=array();
                foreach($data['hotels'] as $hotel)
                    $hotels[]=$hotel->getId();
                $array['hotels']=implode(',',$hotels);
            }
            if(count($data['regions'])==0)
                $array['regions']='all';
            else
            {
                $regions=array();
                foreach($data['regions'] as $region)
                    $regions[]=$region->getId();
                $array['regions']=implode(',',$regions);
            }
            if(count($data['users'])==0)
                $array['users']='all';
            else
            {
                $users=array();
                foreach($data['users'] as $user)
                    $users[]=$user->getId();
                $array['users']=implode(',',$users);
            }
            return $this->redirect($this->generateUrl('Hotel_Tunisie_Reporting_NombreNuitee_stat',$array));
        }
        return $this->render('BackHotelTunisieBundle:Reporting:nombre_reservation_form.html.twig', array(
            'form' => $form->createView(),
            'titre' => "Nombre Nuitées"
        ));
    }
    
    public function nombreNuiteeRapportAction($mois, $annee, $etat, $regions, $hotels, $users)
    {
        $dataParHotel=$this->get('reportingSHT')->getDataParHotel($mois, $annee, $etat, $regions, $hotels, $users,"nombre_nuitee");
        $dataParRegion=$this->get('reportingSHT')->getDataParRegion($mois, $annee, $etat, $regions, $hotels, $users,"nombre_nuitee");
        $dataOperateur=$this->get('reportingSHT')->getDataParOperateur($mois, $annee, $etat, $regions, $hotels, $users,"nombre_nuitee");
        $dataSource=$this->get('reportingSHT')->getDataParSource($mois, $annee, $etat, $regions, $hotels, $users,"nombre_nuitee");
        return $this->render('BackHotelTunisieBundle:Reporting:nombre_reservation_stats.html.twig',array(
            'dataHotel'=>$dataParHotel,
            'dataRegion'=>$dataParRegion,
            'dataOperateur'=>$dataOperateur,
            'dataSource'=>$dataSource,
            'titre' => "Nombre Nuitées"
        ));
    }
    
    public function chiffreAffaireAction()
    {
        $form = $this->createForm(new ReportingNombreReservationType());
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            $data=$form->getData();
            $array=array();
            $array['annee']=$data['annee'];
            $array['etat']=$data['etat'];
            if(count($data['mois'])==0)
                $array['mois']='all';
            else
            {
                $mois=array();
                foreach($data['mois'] as $moi)
                    $mois[]=$moi;
                $array['mois']=implode(',',$mois);
            }
            if(count($data['hotels'])==0)
                $array['hotels']='all';
            else
            {
                $hotels=array();
                foreach($data['hotels'] as $hotel)
                    $hotels[]=$hotel->getId();
                $array['hotels']=implode(',',$hotels);
            }
            if(count($data['regions'])==0)
                $array['regions']='all';
            else
            {
                $regions=array();
                foreach($data['regions'] as $region)
                    $regions[]=$region->getId();
                $array['regions']=implode(',',$regions);
            }
            if(count($data['users'])==0)
                $array['users']='all';
            else
            {
                $users=array();
                foreach($data['users'] as $user)
                    $users[]=$user->getId();
                $array['users']=implode(',',$users);
            }
            return $this->redirect($this->generateUrl('Hotel_Tunisie_Reporting_ChiffreAffaire_stat',$array));
        }
        return $this->render('BackHotelTunisieBundle:Reporting:nombre_reservation_form.html.twig', array(
            'form' => $form->createView(),
            'titre' => "Chiffre Affaire"
        ));
    }
    
    public function chiffreAffaireRapportAction($mois, $annee, $etat, $regions, $hotels, $users)
    {
        $this->get('reportingSHT')->updateChiffreAffaireHotels($hotels,$regions);
        $dataParHotel=$this->get('reportingSHT')->getDataParHotel($mois, $annee, $etat, $regions, $hotels, $users,"chiffre_affaire");
        $dataParRegion=$this->get('reportingSHT')->getDataParRegion($mois, $annee, $etat, $regions, $hotels, $users,"chiffre_affaire");
        $dataOperateur=$this->get('reportingSHT')->getDataParOperateur($mois, $annee, $etat, $regions, $hotels, $users,"chiffre_affaire");
        $dataSource=$this->get('reportingSHT')->getDataParSource($mois, $annee, $etat, $regions, $hotels, $users,"chiffre_affaire");
        return $this->render('BackHotelTunisieBundle:Reporting:nombre_reservation_stats.html.twig',array(
            'dataHotel'=>$dataParHotel,
            'dataRegion'=>$dataParRegion,
            'dataOperateur'=>$dataOperateur,
            'dataSource'=>$dataSource,
            'titre' => "Chiffre Affaire"
        ));
    }

    public function arrangementAction()
    {
        $form = $this->createForm(new ReportingArrangementType());
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            $data=$form->getData();
            $array=array();
            $array['annee']=$data['annee'];
            $array['etat']=$data['etat'];
            if(count($data['mois'])==0)
                $array['mois']='all';
            else
            {
                $mois=array();
                foreach($data['mois'] as $moi)
                    $mois[]=$moi;
                $array['mois']=implode(',',$mois);
            }
            return $this->redirect($this->generateUrl('Hotel_Tunisie_Reporting_arrangement_stat',$array));
        }
        return $this->render('BackHotelTunisieBundle:Reporting:arrangement_form.html.twig', array(
            'form' => $form->createView(),
            'titre' => "Arrangements"
        ));
    }

    public function arrangementRapportAction($mois, $annee, $etat)
    {
        $dataParChambre=$this->get('reportingSHT')->getDataParArrangement($mois, $annee, $etat,'nbr_chambre');
        return $this->render('BackHotelTunisieBundle:Reporting:arrangement_stats.html.twig',array(
            'dataParChambre'=>$dataParChambre,
            'titre' => "Arrangement"
        ));
    }

    public function chambreAction()
    {
        $form = $this->createForm(new ReportingArrangementType());
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            $data=$form->getData();
            $array=array();
            $array['annee']=$data['annee'];
            $array['etat']=$data['etat'];
            if(count($data['mois'])==0)
                $array['mois']='all';
            else
            {
                $mois=array();
                foreach($data['mois'] as $moi)
                    $mois[]=$moi;
                $array['mois']=implode(',',$mois);
            }
            return $this->redirect($this->generateUrl('Hotel_Tunisie_Reporting_chambre_stat',$array));
        }
        return $this->render('BackHotelTunisieBundle:Reporting:arrangement_form.html.twig', array(
            'form' => $form->createView(),
            'titre' => "Chambres"
        ));
    }

    public function chambreRapportAction($mois, $annee, $etat)
    {
        $dataParChambre=$this->get('reportingSHT')->getDataParChambre($mois, $annee, $etat,'nbr_chambre');
        return $this->render('BackHotelTunisieBundle:Reporting:arrangement_stats.html.twig',array(
            'dataParChambre'=>$dataParChambre,
            'titre' => "Chambres"
        ));
    }
}