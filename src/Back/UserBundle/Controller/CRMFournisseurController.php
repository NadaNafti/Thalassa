<?php

namespace Back\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Back\UserBundle\Entity\Fournisseur;
use Back\UserBundle\Form\FournisseurType;
use Back\UserBundle\Entity\Contact;
use Back\UserBundle\Form\ContactType;

class CRMFournisseurController extends Controller {

    public function listeAction($page) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $fournisseurs = $em->getRepository('BackUserBundle:Fournisseur')->findBy(array(), array('id' => 'desc'));
        $paginator = $this->get('knp_paginator');
        $fournisseurs = $paginator->paginate($fournisseurs, $page, 20);
        return $this->render('BackUserBundle:fournisseur:liste.html.twig', array(
                    'fournisseurs' => $fournisseurs
        ));
    }

    public function ajouterAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($id))
            $fournisseur = new Fournisseur ();
        else
            $fournisseur = $em->getRepository("BackUserBundle:Fournisseur")->find($id);
        $form = $this->createForm(new FournisseurType(), $fournisseur);
        if ($this->getRequest()->isMethod('POST')) {
            $form->submit($this->getRequest());
            if ($form->isValid()) {
                $fournisseur = $form->getData();
                $em->persist($fournisseur);
                $em->flush();
                $session->getFlashBag()->add('success', " Opération réussie ");
                return $this->redirect($this->generateUrl('back_crm_fournisseur_liste'));
            }
        }
        return $this->render('BackUserBundle:fournisseur:ajouter.html.twig', array(
                    'form' => $form->createView(),
                    'fournisseur' => $fournisseur,
        ));
    }

    public function detailsAction(Fournisseur $fournisseur) {
        return $this->render('BackUserBundle:fournisseur:details.html.twig', array(
                    'fournisseur' => $fournisseur,
        ));
    }

    public function deleteAction(Fournisseur $fournisseur) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($fournisseur);
            $em->flush();
            $session->getFlashBag()->add('success', " Le fournisseur a été supprimé avec succées ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', 'Problème de supression ' . $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_crm_fournisseur_liste'));
    }

    public function contactsAction($id, $page) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $contact = new Contact();
        else
            $contact = $em->find('BackUserBundle:Contact', $id);
        $form = $this->createForm(new ContactType(), $contact)->remove('titreCivilite')->remove('fonction')->remove('dateNaissance')->remove('client');
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $contact = $form->getData();
                $em->persist($contact);
                $em->flush();
                $session->getFlashBag()->add('success', "Opération réussie");
                return $this->redirect($this->generateUrl('back_crm_fournisseur_contacts'));
            }
        }
        $contacts = $em->getRepository('BackUserBundle:Contact')->listeFournisseur();
        $paginator = $this->get('knp_paginator');
        $contacts = $paginator->paginate($contacts, $page, 20);
        return $this->render('BackUserBundle:fournisseur:contact.html.twig', array(
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
            $session->getFlashBag()->add('success', " Le contact a été supprimé avec succées ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', 'Problème de supression ' . $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_crm_fournisseur_contacts'));
    }

}
