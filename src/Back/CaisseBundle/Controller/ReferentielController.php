<?php

namespace Back\CaisseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\CaisseBundle\Entity\TypeLigneCaisse;
use Back\CaisseBundle\Form\TypeLigneCaisseType;

class ReferentielController extends Controller {

    public function typeAction() {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $type = new TypeLigneCaisse();
        $types = $em->getRepository('BackCaisseBundle:TypeLigneCaisse')->findAll();
        $form = $this->createForm(new TypeLigneCaisseType(), $type);
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $type = $form->getData();
                $em->persist($type);
                $em->flush();
                $session->getFlashBag()->add('success', "Type ajouté avec succès");
                return $this->redirect($this->generateUrl('back_caisse_referentiel_typeLigne'));
            }
        }
        return $this->render('BackCaisseBundle:Referentiel:ligneType.html.twig', array(
                    'form' => $form->createView(),
                    'types' => $types,
        ));
    }

    public function deleteTypeAction(TypeLigneCaisse $type) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        try {
            $em->remove($type);
            $em->flush();
            $session->getFlashBag()->add('success', " Le type de mouvement a été supprimé avec succées ");
        } catch (\Exception $ex) {
            $session->getFlashBag()->add('danger', 'Problème de supression ' . $ex->getMessage());
        }
        return $this->redirect($this->generateUrl('back_caisse_referentiel_typeLigne'));
    }
}

