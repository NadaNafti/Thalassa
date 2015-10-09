<?php

namespace Back\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Back\UserBundle\Entity\Client;
use Back\UserBundle\Form\ClientFullType;
use Back\UserBundle\Entity\Contact;
use Back\UserBundle\Form\ContactType;
use Back\HotelTunisieBundle\Entity\Reservation;

class CRMClientController extends Controller {

    public function listeAction($page) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $clients = $em->getRepository('BackUserBundle:Client')->findBy(array(), array('id' => 'desc'));
        $paginator = $this->get('knp_paginator');
        $clients = $paginator->paginate($clients, $page, 20);
        return $this->render('BackUserBundle:client:liste.html.twig', array(
                    'clients' => $clients
        ));
    }

    public function ajouterAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($id))
            $client = new Client ();
        else
            $client = $em->getRepository("BackUserBundle:Client")->find($id);
        $form = $this->createForm(new ClientFullType(), $client);
        if ($this->getRequest()->isMethod('POST')) {
            $form->submit($this->getRequest());
            if ($form->isValid()) {
                $client = $form->getData();
                $em->persist($client);
                $em->flush();
                $session->getFlashBag()->add('success', " Opération réussie ");
                return $this->redirect($this->generateUrl('back_crm_client_liste'));
            }
        }
        return $this->render('BackUserBundle:client:ajouter.html.twig', array(
                    'form' => $form->createView(),
                    'client' => $client,
        ));
    }

    public function deleteAction(Client $client) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($client);
            $em->flush();
            $session->getFlashBag()->add('success', " Le client a été supprimé avec succès ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', 'Problème de supression ' . $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_crm_client_liste'));
    }

    public function profilAction(Client $client) {
        return $this->render('BackUserBundle:client:profil\profil.html.twig', array(
                    'client' => $client,
        ));
    }

    public function modifierProfilAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $client = $em->getRepository("BackUserBundle:Client")->find($id);
        $form = $this->createForm(new ClientFullType(), $client);
        if ($this->getRequest()->isMethod('POST')) {
            $form->submit($this->getRequest());
            if ($form->isValid()) {
                $client = $form->getData();
                $em->persist($client);
                $em->flush();
                $session->getFlashBag()->add('success', " Modification réussie ");
                return $this->redirect($this->generateUrl('back_crm_client_profil', array('id' => $client->getId())));
            }
        }
        return $this->render('BackUserBundle:client:ajouter.html.twig', array(
                    'form' => $form->createView(),
                    'client' => $client,
        ));
    }

    public function profilContactAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $client = $em->find('BackUserBundle:Client', $id);
        if (is_null($id2))
            $contact = new Contact();
        else
            $contact = $em->find('BackUserBundle:Contact', $id2);
        $form = $this->createForm(new ContactType(), $contact)->remove('fournisseur')->remove('client');
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $contact = $form->getData();
                $em->persist($contact->setClient($client));
                $em->flush();
                $session->getFlashBag()->add('success', "Opération réussie");
                return $this->redirect($this->generateUrl('back_crm_client_profil_contact', array('id' => $client->getId())));
            }
        }
        return $this->render('BackUserBundle:client:profil\contactProfil.html.twig', array(
                    'form' => $form->createView(),
                    'client' => $client,
        ));
    }

    public function deleteProfilContactAction(Contact $contact) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($contact);
            $em->flush();
            $session->getFlashBag()->add('success', " Le contact a été supprimé avec succès ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', 'Problème de supression ' . $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_crm_client_profil_contact', array('id' => $contact->getClient()->getId())));
    }

    public function contactsAction($id, $page) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $contact = new Contact();
        else
            $contact = $em->find('BackUserBundle:Contact', $id);
        $form = $this->createForm(new ContactType(), $contact)->remove('fournisseur');
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $contact = $form->getData();
                $em->persist($contact);
                $em->flush();
                $session->getFlashBag()->add('success', "Opération réussie");
                return $this->redirect($this->generateUrl('back_crm_client_contacts'));
            }
        }
        $contacts = $em->getRepository('BackUserBundle:Contact')->listeClient();
        $paginator = $this->get('knp_paginator');
        $contacts = $paginator->paginate($contacts, $page, 20);
        return $this->render('BackUserBundle:client:contact.html.twig', array(
                    'form' => $form->createView(),
                    'contacts' => $contacts,
        ));
    }

    public function deleteContactAction(Contact $contact) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($contact);
            $em->flush();
            $session->getFlashBag()->add('success', " Le contact a été supprimé avec succès ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', 'Problème de supression ' . $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_crm_client_contacts'));
    }

    public function reservationsHTAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $client = $em->find('BackUserBundle:Client', $id);

        return $this->render('BackUserBundle:client:profil\reservationHT.html.twig', array(
                    'client' => $client,
                    'id' => $id,
        ));
    }

    public function reservationsBEAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $client = $em->find('BackUserBundle:Client', $id);
        return $this->render('BackUserBundle:client:profil\reservationBE.html.twig', array(
                    'client' => $client,
                    'id' => $id,
        ));
    }

    public function reservationsVOAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $client = $em->find('BackUserBundle:Client', $id);
        return $this->render('BackUserBundle:client:profil\reservationVO.html.twig', array(
                    'client' => $client,
                    'id' => $id,
        ));
    }

    public function reservationsPRAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $client = $em->find('BackUserBundle:Client', $id);
        return $this->render('BackUserBundle:client:profil\reservationPR.html.twig', array(
                    'client' => $client,
                    'id' => $id,
        ));
    }

    public function reservationsBAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $client = $em->find('BackUserBundle:Client', $id);
        return $this->render('BackUserBundle:client:profil\reservationB.html.twig', array(
                    'client' => $client,
                    'id' => $id,
        ));
    }

    public function reservationsMAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $client = $em->find('BackUserBundle:Client', $id);
        return $this->render('BackUserBundle:client:profil\reservationM.html.twig', array(
                    'client' => $client,
                    'id' => $id,
        ));
    }

}
