<?php

namespace Back\VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\VoyageOrganiseBundle\Entity\VoyageOrganise;
use Back\VoyageOrganiseBundle\Form\VoyageOrganiseType;
use Back\VoyageOrganiseBundle\Entity\Description;
use Back\VoyageOrganiseBundle\Form\DescriptionType;
use Back\VoyageOrganiseBundle\Entity\Photo;
use Back\VoyageOrganiseBundle\Form\PhotoType;
use Back\VoyageOrganiseBundle\Entity\Periode;
use Back\VoyageOrganiseBundle\Form\PeriodeType;
use Back\VoyageOrganiseBundle\Entity\Pack;
use Back\VoyageOrganiseBundle\Form\PackType;
use Back\VoyageOrganiseBundle\Entity\Ligne;
use Doctrine\ORM\EntityRepository;
use Back\VoyageOrganiseBundle\Form\LigneType;

class VoyageOrganiseController extends Controller
{

    public function listeAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $voyageOrgainses = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->findAll();
        $paginator = $this->get('knp_paginator');
        $voyageOrgainses = $paginator->paginate($voyageOrgainses, $page, 20);
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:liste.html.twig', array(
                    'voyages' => $voyageOrgainses
        ));
    }

    public function supprimerAction(VoyageOrganise $voyageOrganise)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($voyageOrganise);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre Voyage organisé a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_vo_liste'));
    }

    public function ajouterAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($id))
            $voyageOrganise = new VoyageOrganise ();
        else
            $voyageOrganise = $em->getRepository('BackVoyageOrganiseBundle:VoyageOrganise')->find($id);
        $form = $this->createForm(new VoyageOrganiseType(), $voyageOrganise);
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $voyageOrganise = $form->getData();
                $em->persist($voyageOrganise);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Voyage organisé a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl('back_vo_liste'));
            }
        }
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:ajouter.html.twig', array(
                    'form' => $form->createView(),
                    'voyage' => $voyageOrganise
        ));
    }

    public function descriptionAction(VoyageOrganise $voyage, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($id))
            $description = new Description ();
        else
            $description = $em->getRepository('BackVoyageOrganiseBundle:Description')->find($id);
        $descriptions = $em->getRepository('BackVoyageOrganiseBundle:Description')->findBy(array('voyage' => $voyage));
        $form = $this->createForm(new DescriptionType(), $description);
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $description = $form->getData();
                $em->persist($description->setVoyage($voyage));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre déscription a été traité avec succées ");
                return $this->redirect($this->generateUrl('back_vo_descriptions', array(
                                    'voyage' => $voyage->getId()
                )));
            }
        }
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:description.html.twig', array(
                    'form' => $form->createView(),
                    'voyage' => $voyage,
                    'descriptions' => $descriptions
        ));
    }

    public function SupprimerDescriptionAction(Description $description)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($description);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre déscription  a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_vo_descriptions', array(
                            'voyage' => $description->getVoyage()->getId()
        )));
    }

    public function photoAction(VoyageOrganise $voyage)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $photo = new Photo();
        $form = $this->createForm(new PhotoType(), $photo);
        $photos = $em->getRepository('BackVoyageOrganiseBundle:Photo')->findBy(array('voyage' => $voyage));
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            $photo = $form->getData();
            $em->persist($photo->setVoyage($voyage));
            $em->flush();
            $session->getFlashBag()->add('success', " Votre photo a été traité avec succées ");
            return $this->redirect($this->generateUrl('back_vo_photos', array(
                                'voyage' => $voyage->getId()
            )));
        }
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:photo.html.twig', array(
                    'form' => $form->createView(),
                    'voyage' => $voyage,
                    'photos' => $photos
        ));
    }

    public function periodeAction(VoyageOrganise $voyage, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($id))
            $periode = new Periode ();
        else
            $periode = $em->getRepository('BackVoyageOrganiseBundle:Periode')->find($id);
        $periodes = $em->getRepository('BackVoyageOrganiseBundle:Periode')->findBy(array('voyage' => $voyage));
        $form = $this->createForm(new PeriodeType(), $periode);
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $periode = $form->getData();
                $em->persist($periode->setVoyage($voyage));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre periode a été traité avec succées ");
                return $this->redirect($this->generateUrl('back_vo_periode', array(
                                    'voyage' => $voyage->getId()
                )));
            }
        }
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:periode.html.twig', array(
                    'form' => $form->createView(),
                    'voyage' => $voyage,
                    'periodes' => $periodes
        ));
    }

    public function SupprimerPeriodeAction(Periode $periode)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($periode);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre periode  a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_vo_periode', array(
                            'voyage' => $periode->getVoyage()->getId()
        )));
    }

    public function packAction(VoyageOrganise $voyage, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (count($voyage->getPeriodes()) == 0)
        {
            $session->getFlashBag()->add('info', " Vous devez avoir au moin une période");
            return $this->redirect($this->generateUrl('back_vo_periode', array('voyage' => $voyage->getId())));
        }
        if (is_null($id))
            $pack = new Pack ();
        else
            $pack = $em->getRepository('BackVoyageOrganiseBundle:Pack')->find($id);
        $packs = $em->getRepository('BackVoyageOrganiseBundle:Pack')->findByVoyage($voyage->getId());
        $form = $this->createForm(new PackType(), $pack);
        $form->add('periode', 'entity', array(
            'class' => 'BackVoyageOrganiseBundle:Periode',
            'query_builder' => function(EntityRepository $er) use ($voyage)
            {
                return $er->createQueryBuilder('s')
                                ->where('s.voyage = :id')
                                ->setParameter('id', $voyage->getId())
                                ->orderBy('s.id', 'desc');
                ;
            },
            'required' => true,
        ));
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $pack = $form->getData();
                $em->persist($pack);
                foreach ($pack->getSupplements() as $supp)
                    $em->persist($supp->setPack($pack));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre pack a été traité avec succées ");
                return $this->redirect($this->generateUrl('back_vo_pack', array(
                                    'voyage' => $voyage->getId(),
                                    'id' => $pack->getId()
                )));
            }
        }
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:pack.html.twig', array(
                    'form' => $form->createView(),
                    'voyage' => $voyage,
                    'packs' => $packs
        ));
    }

    public function SupprimerPackLigneAction(Ligne $ligne)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($ligne);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre ligne  a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_vo_pack', array(
                            'voyage' => $ligne->getPack()->getPeriode()->getVoyage()->getId(),
                            'id' => $ligne->getPack()->getId()
        )));
    }

    public function SupprimerPackAction(Pack $pack)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($pack);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre pack  a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_vo_pack', array(
                            'voyage' => $pack->getPeriode()->getVoyage()->getId()
        )));
    }

    public function circuitAction(VoyageOrganise $voyage, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (count($voyage->getPeriodes()) == 0)
        {
            $session->getFlashBag()->add('info', " Vous devez avoir au moin une période");
            return $this->redirect($this->generateUrl('back_vo_periode', array('voyage' => $voyage->getId())));
        }
        if (is_null($id))
            $ligne = new Ligne ();
        else
            $ligne = $em->getRepository('BackVoyageOrganiseBundle:Ligne')->find($id);
        $lignes = $em->getRepository('BackVoyageOrganiseBundle:Ligne')->findCircuitByVoyage($voyage->getId());
        $form = $this->createForm(new LigneType(), $ligne);
        $form->add('periodeC', 'entity', array(
            'class' => 'BackVoyageOrganiseBundle:Periode',
            'query_builder' => function(EntityRepository $er) use ($voyage)
            {
                return $er->createQueryBuilder('s')
                                ->where('s.voyage = :id')
                                ->setParameter('id', $voyage->getId())
                                ->orderBy('s.id', 'desc');
                ;
            },
            'required' => true,
        ));
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $ligne = $form->getData();
                $em->persist($ligne);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre circuit a été traité avec succées ");
                return $this->redirect($this->generateUrl('back_vo_circuit', array(
                                    'voyage' => $voyage->getId(),
                )));
            }
        }
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:circuit.html.twig', array(
                    'form' => $form->createView(),
                    'voyage' => $voyage,
                    'lignes' => $lignes
        ));
    }

    public function SupprimerCircuitAction(Ligne $ligne)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($ligne);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre ligne  a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_vo_circuit', array(
                            'voyage' => $pack->getVoyage()->getId()
        )));
    }

    public function fraisAction(VoyageOrganise $voyage, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (count($voyage->getPeriodes()) == 0)
        {
            $session->getFlashBag()->add('info', " Vous devez avoir au moin une période");
            return $this->redirect($this->generateUrl('back_vo_periode', array('voyage' => $voyage->getId())));
        }
        if (is_null($id))
            $ligne = new Ligne ();
        else
            $ligne = $em->getRepository('BackVoyageOrganiseBundle:Ligne')->find($id);
        $lignes = $em->getRepository('BackVoyageOrganiseBundle:Ligne')->findFraisByVoyage($voyage->getId());
        $form = $this->createForm(new LigneType(), $ligne);
        $form->add('periodeF', 'entity', array(
            'class' => 'BackVoyageOrganiseBundle:Periode',
            'query_builder' => function(EntityRepository $er) use ($voyage)
            {
                return $er->createQueryBuilder('s')
                                ->where('s.voyage = :id')
                                ->setParameter('id', $voyage->getId())
                                ->orderBy('s.id', 'desc');
                ;
            },
            'required' => true,
        ));
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isValid())
            {
                $ligne = $form->getData();
                $em->persist($ligne);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre frais a été traité avec succées ");
                return $this->redirect($this->generateUrl('back_vo_frais', array(
                                    'voyage' => $voyage->getId(),
                )));
            }
        }
        return $this->render('BackVoyageOrganiseBundle:voyageOrganise:frais.html.twig', array(
                    'form' => $form->createView(),
                    'voyage' => $voyage,
                    'lignes' => $lignes
        ));
    }

    public function SupprimerfraisAction(Ligne $ligne)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($ligne);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre ligne  a été supprimé avec succées ");
        return $this->redirect($this->generateUrl('back_vo_frais', array(
                            'voyage' => $pack->getVoyage()->getId()
        )));
    }

}
