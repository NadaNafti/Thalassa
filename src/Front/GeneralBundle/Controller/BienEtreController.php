<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\UserBundle\Form\ClientType;
use Doctrine\ORM\EntityRepository;

class BienEtreController extends Controller {

    public function listeAction($page, $name, $produits, $sort, $direction) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $produits = $em->getRepository('BackBienEtreBundle:Produit')->findBy(array(), array('libelle' => 'asc'));
        if ($request->isMethod('POST')) {
            $produitsArray = array();
            $arrays = array();
            foreach ($produits as $pr) {
                if ($request->get('produits_' . $pr->getId()))
                    $produitsArray[] = $pr->getId();
            }
            if (count($produitsArray) == 0)
                $arrays['produits'] = 'all';
            else
                $arrays['produits'] = implode(',', $produitsArray);
            $arrays['name'] = urlencode($request->get('motclesSearch'));
            return $this->redirect($this->generateUrl('front_bienetre_liste', $arrays));
        }
        $paginator = $this->get('knp_paginator');
        $produits = $paginator->paginate($produits, $page, 9);
        return $this->render('FrontGeneralBundle:bienetre\liste:liste.html.twig', array(
                    'produits' => $produits,
                    'motcle' => urldecode($name),
        ));
    }

    public function sortAction($produits, $name) {
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $arrays = array();
            $arrays['produits'] = $produits;
            $arrays['name'] = $name;
            if ($request->get('direction') != '') {
                $arrays['direction'] = $request->get('direction');
                $arrays['sort'] = $request->get('sort');
            }
            return $this->redirect($this->generateUrl('front_bienetre_liste', $arrays));
        }
    }
    
    public function detailsAction($slug)
        {
            $em = $this->getDoctrine()->getManager();
            $produit = $em->getRepository('BackBienEtreBundle:Produit')->findOneBy(array('slug' => $slug));
            return $this->render('FrontGeneralBundle:bienetre/details:details.html.twig',array(
                'produit' => $produit,
            ));
        }

}
