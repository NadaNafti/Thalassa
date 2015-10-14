<?php

namespace Back\ResaBookingBundle\Controller;

use Back\ResaBookingBundle\Entity\Hotel;
use Back\ResaBookingBundle\Form\HotelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class HotelsController extends Controller
{
    public function listeAction($page)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        $hotels=$em->getRepository('BackResaBookingBundle:Hotel')->findAll();
        $hotels = $this->get('knp_paginator')->paginate($hotels, $page, 20);
        $form=$this->createForm(new HotelType());
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $data=$form->getData();
                $hotel=$em->find('BackResaBookingBundle:Hotel',$data['id']);
                $em->persist($hotel->setHotel($data['hotel']));
                $em->flush();
                $session->getFlashBag()->add('success',"Hôtels rapprocher avec succées");
                return $this->redirect($this->generateUrl('back_resabooking_hotels_liste'));
            }
        }
        return $this->render('BackResaBookingBundle:hotels:liste.html.twig',array(
            'hotels'=>$hotels,
            'form'=>$form->createView()
        ));
    }

    public function refreshAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $config=$em->find('BackResaBookingBundle:Configuration',1);
        if(!$config)
        {
            $session->getFlashBag()->add('success'," Vos paramétres de configuration sont vides ");
            return $this->redirect($this->generateUrl('back_resabooking_hotels_liste'));
        }
        $xmlProducts = simplexml_load_file($config->getLienProduit(),"SimpleXMLELement",LIBXML_NOCDATA);
        $json = json_encode($xmlProducts);
        $produits = json_decode($json,TRUE);

        $xmlPrix = simplexml_load_file($config->getLienPrix(),"SimpleXMLELement",LIBXML_NOCDATA);
        $json = json_encode($xmlPrix);
        $prix = json_decode($json,TRUE);

        foreach($produits['produit'] as $produit)
        {
            $hotel=$em->find('BackResaBookingBundle:Hotel',$produit['id_hotel']);
            if(!$hotel)
            {
                $hotel = new Hotel();
                $hotel->setId($produit['id_hotel']);
            }
            $hotel->setLibelle($produit['libelle_hotel']);
            $hotel->setProduit($produit);
            $arrayPrix=array();
            foreach($prix['produit'] as $p)
            {
                if($p['id_hotel'] == $produit['id_hotel'])
                    $arrayPrix[]=$p;
            }
            $hotel->setPrix($arrayPrix);
            $em->persist($hotel);
            $em->flush();
        }
        $session->getFlashBag()->add('success'," les hôtels sont à jour ");
        return $this->redirect($this->generateUrl('back_resabooking_hotels_liste'));
    }
}
