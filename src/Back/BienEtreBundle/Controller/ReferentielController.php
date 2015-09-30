<?php

namespace Back\BienEtreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\BienEtreBundle\Entity\Centre;
use Back\BienEtreBundle\Form\CentreType;
use Back\BienEtreBundle\Entity\Produit;
use Back\BienEtreBundle\Form\ProduitType;
use Back\BienEtreBundle\Entity\Tarif;
use Back\BienEtreBundle\Form\TarifType;
use Back\BienEtreBundle\Entity\Photo;
use Back\BienEtreBundle\Form\PhotoType;

class ReferentielController extends Controller {

    //Gestion des centres
    public function centreAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $centre = new Centre();
        else
            $centre = $em->find('BackBienEtreBundle:Centre', $id);
        $centres = $em->getRepository('BackBienEtreBundle:Centre')->findAll();
        $form = $this->createForm(new CentreType(), $centre);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $centre = $form->getData();
                $em->persist($centre);
                $em->flush();
                $session->getFlashBag()->add('success', "Opération réussie");
                return $this->redirect($this->generateUrl('back_bienetre_ref_centre'));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\centre:centre.html.twig', array(
                    'form' => $form->createView(),
                    'centres' => $centres,
                    'centre' => $centre
        ));
    }

    public function deleteCentreAction(Centre $centre) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($centre);
            $em->flush();
            $session->getFlashBag()->add('success', " Le centre a été supprimé avec succées ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', 'Problème de supression ' . $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_bienetre_ref_centre'));
    }

    public function centrePhotoAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $centre = $em->find('BackBienEtreBundle:Centre', $id);
        if (is_null($id2))
            $photo = new Photo();
        else
            $photo = $em->find('BackBienEtreBundle:Photo', $id2);
        $form = $this->createForm(new PhotoType, $photo);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $photo = $form->getData();
                $em->persist($photo->setCentre($centre));
                $em->flush();
                $session->getFlashBag()->add('success', "Opération réussie");
                return $this->redirect($this->generateUrl('back_bienetre_ref_centre_photo', array('id' => $centre->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\centre:photoCentre.html.twig', [
                    'form' => $form->createView(),
                    'centre' => $centre
        ]);
    }

    public function deletePhotoCentreAction(Photo $photo) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($photo);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " L'image a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_centre_photo', array('id' => $photo->getCentre()->getId())));
    }

    //Gestion des produits
    public function produitAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $produit = new Produit();
        else
            $produit = $em->find('BackBienEtreBundle:Produit', $id);
        $produits = $em->getRepository('BackBienEtreBundle:Produit')->findAll();
        $form = $this->createForm(new ProduitType(), $produit);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $produit = $form->getData();
                $em->persist($produit);
                $em->flush();
                $session->getFlashBag()->add('success', "Opération réussie");
                return $this->redirect($this->generateUrl('back_bienetre_ref_produit'));
            }
        }
        return $this->render('BackBienEtreBundle:Ref/produit:produit.html.twig', array(
                    'form' => $form->createView(),
                    'produit' => $produit,
                    'produits' => $produits,
        ));
    }

    public function deleteProduitAction(Produit $produit) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($produit);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le produit a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_produit'));
    }

    public function produitTarifAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $produit = $em->find('BackBienEtreBundle:Produit', $id);
        if (is_null($id2))
            $tarif = new Tarif();
        else
            $tarif = $em->find('BackBienEtreBundle:Tarif', $id2);
        $form = $this->createForm(new TarifType, $tarif);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $tarif = $form->getData();
                $em->persist($tarif->setProduit($produit));
                $em->flush();
                $session->getFlashBag()->add('success', "Opération réussie");
                return $this->redirect($this->generateUrl('back_bienetre_ref_produit_tarif', array('id' => $produit->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\produit:tarifProduit.html.twig', [
                    'form' => $form->createView(),
                    'produit' => $produit
        ]);
    }

    public function deleteTarifProduitAction(Tarif $tarif) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($tarif);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le tarif a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_produit_tarif', array('id' => $tarif->getProduit()->getId())));
    }

    public function produitPhotoAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $produit = $em->find('BackBienEtreBundle:Produit', $id);
        if (is_null($id2))
            $photo = new Photo();
        else
            $photo = $em->find('BackBienEtreBundle:Photo', $id2);
        $form = $this->createForm(new PhotoType, $photo);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $photo = $form->getData();
                $em->persist($photo->setProduit($produit));
                $em->flush();
                $session->getFlashBag()->add('success', "L'image a été ajouté avec succès");
                return $this->redirect($this->generateUrl('back_bienetre_ref_produit_photo', array('id' => $produit->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\produit:photoProduit.html.twig', [
                    'form' => $form->createView(),
                    'produit' => $produit
        ]);
    }

    public function deletePhotoProduitAction(Photo $photo) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($photo);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " L'image a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_produit_photo', array('id' => $photo->getProduit()->getId())));
    }

}
