<?php

namespace Back\HotelTunisieBundle\Controller;

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
            'form' => $form->createView()
        ));
    }

    public function nombreReservationRapportAction($mois, $annee, $etat, $regions, $hotels, $users)
    {
        $dataParHotel=$this->get('reportingSHT')->getDataNombreReservationParHotel($mois, $annee, $etat, $regions, $hotels, $users);
        $dataParRegion=$this->get('reportingSHT')->getDataNombreReservationParRegion($mois, $annee, $etat, $regions, $hotels, $users);
        $dataOperateur=$this->get('reportingSHT')->getDataNombreReservationParOperateur($mois, $annee, $etat, $regions, $hotels, $users);
        $dataSource=$this->get('reportingSHT')->getDataNombreReservationParSource($mois, $annee, $etat, $regions, $hotels, $users);
        return $this->render('BackHotelTunisieBundle:Reporting:nombre_reservation_stats.html.twig',array(
            'dataHotel'=>$dataParHotel,
            'dataRegion'=>$dataParRegion,
            'dataOperateur'=>$dataOperateur,
            'dataSource'=>$dataSource,
        ));
    }
}
