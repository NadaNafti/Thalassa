<?php

namespace Back\CommercialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\CommercialBundle\Entity\Fournisseur;
use Back\CommercialBundle\Form\FournisseurType;
use Back\CommercialBundle\Entity\Contact;
use Back\CommercialBundle\Form\ContactType;
use Back\CommercialBundle\Form\PieceType;
use Back\CommercialBundle\Entity\Piece;
use Back\CommercialBundle\Entity\Tarif;
use Back\CommercialBundle\Form\TarifType;

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
	}
	catch (\Exception $ex)
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
	}
	catch (\Exception $ex)
	{
	    $session->getFlashBag()->add('danger', 'Votre Contact est utilisé dans une autre table');
	}
	return $this->redirect($this->generateUrl('commercial_contact'));
    }

    public function pieceAction($page, $client)
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$request = $this->getRequest();
	$form = $this->createFormBuilder()
		->add("newPiece", new PieceType())
		->add('piece', 'entity', array(
		    'class' => 'Back\CommercialBundle\Entity\Piece',
		))
		->getForm();
	$clients = $em->getRepository('BackUserBundle:Client')->findBy(array(), array('nomPrenom' => 'asc'));
	if ($client != 'all')
	    $pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array('client' => $client), array('id' => 'desc'));
	else
	    $pieces = $em->getRepository('BackCommercialBundle:Piece')->findBy(array(), array('id' => 'desc'));
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    $date = $form->getData();
	    $piece = $date['piece'];
	    $newPiece = $date['newPiece'];
	    if ($newPiece->getMontantOrigine() >= $piece->getMontantOrigine())
	    {
		$piece->setNumero($newPiece->getNumero())
			->setModeReglement($newPiece->getModeReglement())
			->setDateEcheance($newPiece->getDateEcheance())
			->setMontant($piece->getMontant() + ($newPiece->getMontantOrigine() - $piece->getMontantOrigine()))
			->setMontantOrigine($newPiece->getMontantOrigine());
		if ($piece->getMontant() > 0)
		{
		    $piece->setDateReglement(null)
			    ->setRegle(false);
		    $session->getFlashBag()->add('success', " Le nouveau montant réstant de la piéce est  " . $piece->getMontant() . ' DT');
		}
		$em->persist($piece);
		$em->flush();
		$session->getFlashBag()->add('success', " Votre piéce a été remplacé avec succées ");
	    }
	    else
		$session->getFlashBag()->add('danger', 'Le montant de la nouvelle piéce doit étre superrieur a l\'ancienne ');
	    return $this->redirect($this->generateUrl('liste_piece', array(
				'page' => $page,
				'$client' => $client
	    )));
	}
	$paginator = $this->get('knp_paginator');
	$pieces = $paginator->paginate($pieces, $page, 20);
	return $this->render('BackCommercialBundle::pieces.html.twig', array(
		    'form' => $form->createView(),
		    'pieces' => $pieces,
		    'clients' => $clients
	));
    }

    public function filtrePiecesAction()
    {
	return $this->redirect($this->generateUrl('liste_piece', array('client' => $this->getRequest()->get('client'))));
    }

    public function tarifAction()
    {
	$em = $this->getDoctrine()->getManager();
	$session = $this->getRequest()->getSession();
	$tarif = $em->getRepository('BackCommercialBundle:Tarif')->find(1);
	if (!$tarif)
	    $tarif = new Tarif ();
	$form = $this->createForm(new TarifType(), $tarif);
	$request = $this->getRequest();
	if ($request->isMethod('POST'))
	{
	    $form->submit($request);
	    if ($form->isValid())
	    {
		$tarif = $form->getData();
		$em->persist($tarif);
		$em->flush();
		$session->getFlashBag()->add('success', " Vos tarif ont été modifié avec succés ");
		return $this->redirect($this->generateUrl('commercial_config_tarif'));
	    }
	}
	return $this->render('BackCommercialBundle:config:tarif.html.twig', array(
		    'form' => $form->createView()
	));
    }

}
