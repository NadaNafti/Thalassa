<?php

namespace Back\CaisseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\FormError;
use Back\CaisseBundle\Entity\Caisse;
use Back\AdministrationBundle\Entity\PointVente;
use Back\CaisseBundle\Form\CaisseType;
use Back\CaisseBundle\Entity\SessionCaisse;
use Back\CaisseBundle\Form\SessionCaisseType;
use Back\CaisseBundle\Entity\SessionCaisseLigne;
use Back\CaisseBundle\Form\SessionCaisseLigneType;

class CaisseController extends Controller {

    public function listeSessionAction($page) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new SessionCaisseLigneType(), new SessionCaisseLigne());
        $currentSession = $user->getSessions()->last();
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $ligne = $form->getData();
                $em->persist($ligne->setSession($currentSession)->setDateLigne(new \DateTime('now')));
                $em->flush();
                $session->getFlashBag()->add('success', "Mouvement ajouté");
                return $this->redirect($this->generateUrl('back_caisse_session_liste'));
            }
        }
        $paginator = $this->get('knp_paginator');
        $sessions = $paginator->paginate($user->getSessions(), $page, 20);
        return $this->render('BackCaisseBundle:Caisse:listeSession.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
                    'sessions' => $sessions,
        ));
    }

    public function ouvrirSessionAction() {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $user = $this->get('security.context')->getToken()->getUser();
        $sessionCaisse= new SessionCaisse();
        if ($request->isMethod('POST')) {
            $fondInitial = $this->getRequest()->get("fondInitial");
            $em->persist($sessionCaisse->setUser($user)->setDateOuverture(new \DateTime('now'))->setFondInitial($fondInitial));
            $em->flush();
            $session->getFlashBag()->add('success', "Session ouverte avec succès ");
        }
        return $this->redirect($this->generateUrl('back_caisse_session_liste'));
    }

    public function sessionAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $sessionCaisse = $em->find('BackCaisseBundle:SessionCaisse', $id);
        $form = $this->createForm(new SessionCaisseLigneType(), new SessionCaisseLigne());
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $ligne = $form->getData();
                $em->persist($ligne->setSession($sessionCaisse)->setDateLigne(new \DateTime('now')));
                $em->flush();
                $session->getFlashBag()->add('success', "Mouvement ajouté");
                return $this->redirect($this->generateUrl('back_caisse_session', array('id' => $id)));
            }
        }
        return $this->render('BackCaisseBundle:Caisse:session.html.twig', array(
                    'session' => $sessionCaisse,
                    'form' => $form->createView(),
                    'user' => $sessionCaisse->getUser()
        ));
    }

    public function fermerSessionAction(SessionCaisse $sessionCaisse) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $total = $sessionCaisse->getTotal();
            $montant = $this->getRequest()->get("montantPhysique");
            if ($montant == $total) {
                $em->persist($sessionCaisse->setDateFermeture(new \DateTime('now')));
                $em->flush();
                $session->getFlashBag()->add('success', "Session fermée avec succès ");
            } else
                $session->getFlashBag()->add('danger', "Veuillez vérifier votre caisse ou la balancer par l'écriture adéquate");
        }
        return $this->redirect($this->generateUrl('back_caisse_session', array('id' => $sessionCaisse->getId())));
    }

    public function mvtCaissesAction($page, $user, $session, $type, $dateLigne, $sort, $direction) {
        $em = $this->getDoctrine()->getManager();
        $lignes = $em->getRepository('BackCaisseBundle:SessionCaisseLigne')->filtre($user, $session, $type, $dateLigne, $sort, $direction);
        $users = $em->getRepository('BackUserBundle:User')->findBy(array(), array('username' => 'asc'));
        $types = $em->getRepository('BackCaisseBundle:TypeLigneCaisse')->findBy(array(), array('libelle' => 'asc'));
        $paginator = $this->get('knp_paginator');
        $lignes = $paginator->paginate($lignes, $page, 20);
        if ($this->getRequest()->isMethod('POST'))
            return $this->redirect($this->generateUrl('back_caisse_mvtCaisses'));
        return $this->render('BackCaisseBundle:Caisse:mvtCaisses.html.twig', array(
                    'lignes' => $lignes,
                    'users' => $users,
                    'types' => $types
        ));
    }

    public function filtreAction() {
        $request = $this->getRequest();
        return $this->redirect($this->generateUrl('back_caisse_mvtCaisses', array(
                            'user' => $request->get('user'),
                            'ouverture' => $request->get('ouverture') == '' ? 'all' : $request->get('ouverture'),
                            'fermeture' => $request->get('fermeture') == '' ? 'all' : $request->get('fermeture'),
                            'type' => $request->get('type'),
        )));
    }
    
    public function notificationAction() {
        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('BackCaisseBundle:caisse:notification.html.twig', array(
                    'user' => $user,
        ));
    }

}
