<?php

namespace Back\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\UserBundle\Entity\Client;
use Back\UserBundle\Form\ClientType;
use Back\UserBundle\Entity\User;
use Back\UserBundle\Form\RegistrationFormType;

class ClientController extends Controller {

    public function listeAction() {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $clients = $em->getRepository("BackUserBundle:Client")->findBy(array(), array('id' => 'desc'));
        $paginator = $this->get('knp_paginator');
        $clients = $paginator->paginate($clients, $this->getRequest()->query->get('page', 1), 10);
        return $this->render('BackAdministrationBundle:client:liste.html.twig', array(
                    'clients' => $clients,
        ));
    }

    public function addUserAction(Client $client) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($client->getUser()))
            $user = new User ();
        else
            $user = $client->getUser();
        $form = $this->createForm(new RegistrationFormType(), $user)->remove('groups');
        if ($this->getRequest()->isMethod('POST')) {
            $form->submit($this->getRequest());
            if ($form->isValid()) {
                $user = $form->getData();
                $em->persist($user->setEnabled(TRUE)->setClient($client));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Client a été traité avec succées ");
                return $this->redirect($this->generateUrl('user_client', array('id' => $client->getId())));
            }
        }
        return $this->render('BackAdministrationBundle:client:user.html.twig', array(
                    'form' => $form->createView(),
                    'client' => $client,
        ));
    }

    public function ajouterAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($id))
            $client = new Client ();
        else
            $client = $em->getRepository("BackUserBundle:Client")->find($id);
        $form = $this->createForm(new ClientType(), $client)->remove('responsable');
        if ($this->getRequest()->isMethod('POST')) {
            $form->submit($this->getRequest());
            if ($form->isValid()) {
                $client = $form->getData();
                $em->persist($client);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Client a été traité avec succées ");
                return $this->redirect($this->generateUrl('liste_client'));
            }
        }
        return $this->render('BackAdministrationBundle:client:ajouter.html.twig', array(
                    'form' => $form->createView(),
                    'client' => $client,
        ));
    }

    public function supprimerAction(Client $client) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($client);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre Client a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('liste_client'));
    }

}
