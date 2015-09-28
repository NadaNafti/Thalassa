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
                $session->getFlashBag()->add('success', "");
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

    //Gestion des soins
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
        return $this->render('BackBienEtreBundle:Ref\soin:soin.html.twig', [
                    'form' => $form->createView(),
                    'soins' => $soins,
                    'soin' => $soin
        ]);
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

    public function soinTarifAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $soin = $em->find('BackBienEtreBundle:Soin', $id);
        if (is_null($id2))
            $tarif = new Tarif();
        else
            $tarif = $em->find('BackBienEtreBundle:Tarif', $id2);
        $form = $this->createForm(new TarifType, $tarif);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $tarif = $form->getData();
                $em->persist($tarif->setSoin($soin));
                $em->flush();
                $session->getFlashBag()->add('success', "");
                return $this->redirect($this->generateUrl('back_bienetre_ref_soin_tarif', array('id' => $soin->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\soin:tarifSoin.html.twig', [
                    'form' => $form->createView(),
                    'soin' => $soin
        ]);
    }

    public function deleteTarifSoinAction(Tarif $tarif) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($tarif);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le tarif a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_soin_tarif', array('id' => $tarif->getSoin()->getId())));
    }

    public function soinPhotoAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $soin = $em->find('BackBienEtreBundle:Soin', $id);
        if (is_null($id2))
            $photo = new Photo();
        else
            $photo = $em->find('BackBienEtreBundle:Photo', $id2);
        $form = $this->createForm(new PhotoType, $photo);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $photo = $form->getData();
                $em->persist($photo->setSoin($soin));
                $em->flush();
                $session->getFlashBag()->add('success', "");
                return $this->redirect($this->generateUrl('back_bienetre_ref_soin_photo', array('id' => $soin->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\soin:photoSoin.html.twig', [
                    'form' => $form->createView(),
                    'soin' => $soin
        ]);
    }

    public function deletePhotoSoinAction(Photo $photo) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($photo);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " L'image a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_soin_photo', array('id' => $photo->getSoin()->getId())));
    }

    //Gestion des cures
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
        return $this->render('BackBienEtreBundle:Ref/Cure:cure.html.twig', array(
                    'form' => $form->createView(),
                    'cures' => $cures,
                    'cure' => $cure,
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

    public function cureTarifAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $cure = $em->find('BackBienEtreBundle:Cure', $id);
        if (is_null($id2))
            $tarif = new Tarif();
        else
            $tarif = $em->find('BackBienEtreBundle:Tarif', $id2);
        $form = $this->createForm(new TarifType, $tarif);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $tarif = $form->getData();
                $em->persist($tarif->setCure($cure));
                $em->flush();
                $session->getFlashBag()->add('success', "");
                return $this->redirect($this->generateUrl('back_bienetre_ref_cure_tarif', array('id' => $cure->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\cure:tarifCure.html.twig', [
                    'form' => $form->createView(),
                    'cure' => $cure
        ]);
    }

    public function deleteTarifCureAction(Tarif $tarif) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($tarif);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le tarif a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_cure_tarif', array('id' => $tarif->getCure()->getId())));
    }

    public function curePhotoAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $cure = $em->find('BackBienEtreBundle:Cure', $id);
        if (is_null($id2))
            $photo = new Photo();
        else
            $photo = $em->find('BackBienEtreBundle:Photo', $id2);
        $form = $this->createForm(new PhotoType, $photo);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $photo = $form->getData();
                $em->persist($photo->setCure($cure));
                $em->flush();
                $session->getFlashBag()->add('success', "");
                return $this->redirect($this->generateUrl('back_bienetre_ref_cure_photo', array('id' => $cure->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\cure:photoCure.html.twig', [
                    'form' => $form->createView(),
                    'cure' => $cure
        ]);
    }

    public function deletePhotoCureAction(Photo $photo) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($photo);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " L'image a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_cure_photo', array('id' => $photo->getCure()->getId())));
    }

    //Gestion des packs
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
        return $this->render('BackBienEtreBundle:Ref/pack:pack.html.twig', array(
                    'form' => $form->createView(),
                    'pack' => $pack,
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

    public function packTarifAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $pack = $em->find('BackBienEtreBundle:Pack', $id);
        if (is_null($id2))
            $tarif = new Tarif();
        else
            $tarif = $em->find('BackBienEtreBundle:Tarif', $id2);
        $form = $this->createForm(new TarifType, $tarif);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $tarif = $form->getData();
                $em->persist($tarif->setPack($pack));
                $em->flush();
                $session->getFlashBag()->add('success', "");
                return $this->redirect($this->generateUrl('back_bienetre_ref_pack_tarif', array('id' => $pack->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\pack:tarifPack.html.twig', [
                    'form' => $form->createView(),
                    'pack' => $pack
        ]);
    }

    public function deleteTarifPackAction(Tarif $tarif) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($tarif);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " Le tarif a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_pack_tarif', array('id' => $tarif->getPack()->getId())));
    }

    public function packPhotoAction($id, $id2) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $pack = $em->find('BackBienEtreBundle:Pack', $id);
        if (is_null($id2))
            $photo = new Photo();
        else
            $photo = $em->find('BackBienEtreBundle:Photo', $id2);
        $form = $this->createForm(new PhotoType, $photo);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $photo = $form->getData();
                $em->persist($photo->setPack($pack));
                $em->flush();
                $session->getFlashBag()->add('success', "");
                return $this->redirect($this->generateUrl('back_bienetre_ref_pack_photo', array('id' => $pack->getId())));
            }
        }
        return $this->render('BackBienEtreBundle:Ref\pack:photoPack.html.twig', [
                    'form' => $form->createView(),
                    'pack' => $pack
        ]);
    }

    public function deletePhotoPackAction(Photo $photo) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($photo);
            $em->flush();
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('Problème de supression', $ex->getMessage());
        }
        $session->getFlashBag()->add('success', " L'image a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_bienetre_ref_pack_photo', array('id' => $photo->getPack()->getId())));
    }

}
