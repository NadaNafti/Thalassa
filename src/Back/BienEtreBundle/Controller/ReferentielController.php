<?php

namespace Back\BienEtreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\BienEtreBundle\Entity\Centre;
use Back\BienEtreBundle\Form\CentreType;
use Back\BienEtreBundle\Entity\Soin;
use Back\BienEtreBundle\Form\SoinType;
use Back\BienEtreBundle\Entity\Cure;
use Back\BienEtreBundle\Form\CureType;
use Back\BienEtreBundle\Entity\Pack;
use Back\BienEtreBundle\Form\PackType;

class ReferentielController extends Controller {

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
                return $this->redirect($this->generateUrl('back_bienetre_ref_centre'));
            }
        }
        return $this->render('BackBienEtreBundle:Ref:centre.html.twig', array(
                    'form' => $form->createView(),
                    'centres' => $centres,
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
            $session->getFlashBag()->add('danger','Problème de supression '. $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_bienetre_ref_centre'));
    }

    public function soinAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $soin = new Soin();
        else
            $soin = $em->find('BackBienEtreBundle:Soin', $id);
        $soins = $em->getRepository('BackBienEtreBundle:Soin')->findAll();
        $form = $this->createForm(new SoinType(), $soin);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $soin = $form->getData();
                $em->persist($soin);
                $em->flush();
                return $this->redirect($this->generateUrl('back_bienetre_ref_soin'));
            }
        }
        return $this->render('BackBienEtreBundle:Ref:soin.html.twig', array(
                    'form' => $form->createView(),
                    'soins' => $soins,
        ));
    }

    public function deleteSoinAction(Soin $soin) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($soin);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le soin a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_soin'));
    }

    public function cureAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $cure = new Cure();
        else
            $cure = $em->find('BackBienEtreBundle:Cure', $id);
        $cures = $em->getRepository('BackBienEtreBundle:Cure')->findAll();
        $form = $this->createForm(new CureType(), $cure);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $cure = $form->getData();
                $em->persist($cure);
                $em->flush();
                return $this->redirect($this->generateUrl('back_bienetre_ref_cure'));
            }
        }
        return $this->render('BackBienEtreBundle:Ref:cure.html.twig', array(
                    'form' => $form->createView(),
                    'cures' => $cures,
        ));
    }

    public function deleteCureAction(Cure $cure) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($cure);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le cure a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_cure'));
    }

    public function packAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        if (is_null($id))
            $pack = new Pack();
        else
            $pack = $em->find('BackBienEtreBundle:Pack', $id);
        $packs = $em->getRepository('BackBienEtreBundle:Pack')->findAll();
        $form = $this->createForm(new PackType(), $pack);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $pack = $form->getData();
                $em->persist($pack);
                $em->flush();
                return $this->redirect($this->generateUrl('back_bienetre_ref_pack'));
            }
        }
        return $this->render('BackBienEtreBundle:Ref:pack.html.twig', array(
                    'form' => $form->createView(),
                    'packs' => $packs,
        ));
    }

    public function deletePackAction(Pack $pack) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($pack);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le pack a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_pack'));
    }

}
