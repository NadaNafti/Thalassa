<?php

namespace Back\CommercialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\CommercialBundle\Entity\Fournisseur;
use Back\CommercialBundle\Form\FournisseurType;
use Back\CommercialBundle\Entity\Contact;
use Back\CommercialBundle\Form\ContactType;

class CommercialController extends Controller
{

    public function fournisseurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $fournisseur = new Fournisseur ();
        else
            $fournisseur = $em->getRepository('BackCommercialBundle:Fournisseur')->find($id);
        $fournisseurs = $em->getRepository('BackCommercialBundle:Fournisseur')->findAll();
        $form = $this->createForm(new FournisseurType(), $fournisseur);
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $fournisseur = $form->getData();
                $em->persist($fournisseur);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre fournisseur a été ajoutée avec succés ");
                return $this->redirect($this->generateUrl('commercial_fournisseur'));
            }
        }
        return $this->render('BackCommercialBundle::fournisseur.html.twig', array(
                    'form' => $form->createView(),
                    'fournisseurs' => $fournisseurs
        ));
    }

    public function deleteFournisseurAction(Fournisseur $fournisseur)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try
        {
            $em->remove($fournisseur);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre Fournisseur a été supprimé avec succées ");
        } catch (\Exception $ex)
        {
            $session->getFlashBag()->add('danger', 'Votre Fournisseur est utilisé dans une autre table');
        }
        return $this->redirect($this->generateUrl('commercial_fournisseur'));
    }

    public function contactAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $contact = new Contact ();
        else
            $contact = $em->getRepository('BackCommercialBundle:Contact')->find($id);
        $contacts = $em->getRepository('BackCommercialBundle:Contact')->findAll();
        $form = $this->createForm(new ContactType(), $contact);
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $contact = $form->getData();
                $em->persist($contact);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre contact a été ajoutée avec succés ");
                return $this->redirect($this->generateUrl('commercial_contact'));
            }
        }
        return $this->render('BackCommercialBundle::contact.html.twig', array(
                    'form' => $form->createView(),
                    'contacts' => $contacts
        ));
    }

    public function deleteContactAction(Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try
        {
            $em->remove($contact);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre Contact a été supprimé avec succées ");
        } catch (\Exception $ex)
        {
            $session->getFlashBag()->add('danger', 'Votre Contact est utilisé dans une autre table');
        }
        return $this->redirect($this->generateUrl('commercial_contact'));
    }
}
