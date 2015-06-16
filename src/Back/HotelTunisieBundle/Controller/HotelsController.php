<?php

namespace Back\HotelTunisieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;
use Back\HotelTunisieBundle\Entity\Hotel;
use Back\HotelTunisieBundle\Form\HotelType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Back\HotelTunisieBundle\Entity\Media;
use Back\HotelTunisieBundle\Form\MediaType;
use Back\HotelTunisieBundle\Entity\StopSales;
use Back\HotelTunisieBundle\Form\StopSalesType;
use Back\HotelTunisieBundle\Entity\HotelRepository;
use Back\HotelTunisieBundle\Entity\FicheTechnique;
use Back\HotelTunisieBundle\Form\FicheTechniqueType;
use Back\HotelTunisieBundle\Entity\HotelChambre;
use Back\HotelTunisieBundle\Form\HotelChambresType;

class HotelsController extends Controller
{

    public function etatAction(Hotel $hotel, $etat)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->persist($hotel->setEtat($etat));
        $em->flush();
        $session->getFlashBag()->add('success', $hotel->getLibelle() . " a été modifié avec succées ");
        return $this->redirect($this->generateUrl("list_hotels"));
    }

    public function ajoutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $hotel = new Hotel;
        $form = $this->createForm(new HotelType(), $hotel);
        if ($request->isMethod("POST"))
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $hotel = $form->getData();
                $em->persist($hotel->setEtat(1));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre hôtel a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("list_hotels"));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:ajout.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function filtreAction()
    {
        $request = $this->getRequest();
        if ($request->get('libelle') != '')
            $libelle = urlencode($request->get('libelle'));
        else
            $libelle = "all";
        return $this->redirect($this->generateUrl('list_hotels', array(
                            'ville' => $request->get('ville'),
                            'etat' => $request->get('etat'),
                            'chaine' => $request->get('chaine'),
                            'categorie' => $request->get('categorie'),
                            'libelle' => $libelle,
        )));
    }

    public function listeAction($ville, $chaine, $categorie, $etat, $libelle)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $hotels = $em->getRepository("BackHotelTunisieBundle:Hotel")->filtreBackOffice($ville, $chaine, $categorie, $etat, $libelle);
        $villes = $em->getRepository('BackHotelTunisieBundle:ville')->findBy(array(), array('libelle' => 'asc'));
        $chaines = $em->getRepository('BackHotelTunisieBundle:Chaine')->findBy(array(), array('libelle' => 'asc'));
        $categories = $em->getRepository('BackHotelTunisieBundle:Categorie')->findBy(array(), array('libelle' => 'asc'));
        $paginator = $this->get('knp_paginator');
        $hotels = $paginator->paginate($hotels, $request->query->get('page', 1), 20);
        return $this->render('BackHotelTunisieBundle:Hotels:liste.html.twig', array(
                    'hotels' => $hotels,
                    'villes' => $villes,
                    'chaines' => $chaines,
                    'categories' => $categories,
        ));
    }

    public function listeDeletedAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $filters = $em->getFilters();
        $filters->disable('softdeleteable');
        $hotels = $em->getRepository("BackHotelTunisieBundle:Hotel")->getDeletedList();
        $paginator = $this->get('knp_paginator');
        $hotels = $paginator->paginate($hotels, $request->query->get('page', 1), 10);
        return $this->render('BackHotelTunisieBundle:Hotels:listeDeleted.html.twig', array(
                    'hotels' => $hotels,
        ));
    }

    public function reloadAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $filters = $em->getFilters();
        $filters->disable('softdeleteable');
        $hotel = $em->getRepository("BackHotelTunisieBundle:Hotel")->find($id);
        $hotel->setDeletedAt(null);
        $em->persist($hotel);
        $em->flush();
        $session->getFlashBag()->add('success', " l'hotel " . $hotel->getLibelle() . " a été relancé avec succées ");
        return $this->redirect($this->generateUrl("list_hotels_deleted"));
    }

    public function modifAction(Hotel $hotel)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        if (!$hotel)
            throw $this->createNotFoundException('L\' hôtel n\'existe pas');
        $form = $this->createForm(new HotelType(), $hotel);
        if ($request->isMethod("POST"))
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $hotel = $form->getData();
                $em->persist($hotel);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre hôtel a été modifié avec succées ");
                return $this->redirect($this->generateUrl("modif_hotel", array('id' => $hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:modif.html.twig', array(
                    'form' => $form->createView(),
                    'hotel' => $hotel
        ));
    }

    public function supprimerAction(Hotel $hotel)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (!$hotel)
            throw $this->createNotFoundException('L\' hôtel n\'existe pas');
        $em->remove($hotel);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre hôtel a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("list_hotels"));
    }

    public function photosAction(Hotel $hotel)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $session->set("routing", $this->generateUrl("photos_hotel", array('id' => $hotel->getId())));
        $media = new Media();
        $media->setHotel($hotel);
        $form = $this->createForm(new MediaType(), $media);
        $request = $this->getRequest();
        if ($request->isMethod("POST"))
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $media = $form->getData();
                $em->persist($media);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Photo a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("photos_hotel", array('id' => $hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:photo.html.twig', array(
                    'hotel' => $hotel,
                    'form' => $form->createView(),
                    'images' => $hotel->getImages(),
        ));
    }

    public function stopsalesAction(Hotel $hotel)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $stopSale = new StopSales();
        $stopSale->setHotel($hotel);
        $form = $this->createForm(new StopSalesType(), $stopSale);
        $request = $this->getRequest();
        if ($request->isMethod("POST"))
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $stopSale = $form->getData();
                if ($stopSale->getDateDebut() > $stopSale->getDateFin())
                    $session->getFlashBag()->add('danger', "Date fin doit ètre supérieur a la date debut");
                else
                {
                    $em->persist($stopSale);
                    $em->flush();
                    $session->getFlashBag()->add('success', " Votre durée a été ajoutée avec succées ");
                    return $this->redirect($this->generateUrl("stopsales_hotel", array('id' => $hotel->getId())));
                }
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:stopsales.html.twig', array(
                    'hotel' => $hotel,
                    'form' => $form->createView(),
        ));
    }

    public function suppStopSalesAction(StopSales $stopSales)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $em->remove($stopSales);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre stop sale a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("stopsales_hotel", array('id' => $stopSales->getHotel()->getId())));
    }

    public function ficheTechniqueAction(Hotel $hotel)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($hotel->getFicheTechnique() != NULL)
            $ficheTechnique = $hotel->getFicheTechnique();
        else
            $ficheTechnique = new FicheTechnique ();
        $form = $this->createForm(new FicheTechniqueType(), $ficheTechnique);
        $request = $this->getRequest();
        if ($request->isMethod("POST"))
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $ficheTechnique = $form->getData();
                if ($ficheTechnique->getMax1AgeEnfant() > $ficheTechnique->getMin1AgeEnfant() && $ficheTechnique->getMin1AgeEnfant() >= 0 && (($ficheTechnique->getMin2AgeEnfant() == $ficheTechnique->getMax1AgeEnfant() + 1 && $ficheTechnique->getMax2AgeEnfant() > $ficheTechnique->getMin2AgeEnfant()) || ($ficheTechnique->getMin2AgeEnfant() == 0 && $ficheTechnique->getMax2AgeEnfant() == 0) ))
                {
                    $hotel->setFicheTechnique($ficheTechnique);
                    $em->persist($ficheTechnique);
                    $em->persist($hotel);
                    $em->flush();
                    $session->getFlashBag()->add('success', " Votre fiche technique a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("fiche_technique", array('id' => $hotel->getId())));
                }
                else
                    $session->getFlashBag()->add('danger', "les deux intervalles sont erronées");
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:fiche_technique.html.twig', array(
                    'hotel' => $hotel,
                    'form' => $form->createView()
        ));
    }

    public function hotelChambreAction(Hotel $hotel)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        foreach ($hotel->getChambres() as $ch)
        {
            $verif = $em->getRepository("BackHotelTunisieBundle:HotelChambre")->findBy(array('hotel' => $hotel, 'chambre' => $ch));
            if (count($verif) == 0)
            {
                $hotelChambre = new HotelChambre();
                $hotelChambre->setChambre($ch);
                $hotel->addHotelChambre($hotelChambre);
            }
        }
        $form = $this->createForm(new HotelChambresType(), $hotel);
        if ($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if ($form->isValid())
            {
                $hotel = $form->getData();
                foreach ($hotel->getHotelChambres() as $hotelChambre)
                {
                    $em->persist($hotelChambre->setHotel($hotel));
                }
                $em->persist($hotel);
                $em->flush();
                $session->getFlashBag()->add('success', " Vos chambres ont été modifié avec succées ");
                return $this->redirect($this->generateUrl("chambre_hotel", array('id' => $hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:chambres.html.twig', array(
                    'hotel' => $hotel,
                    'form' => $form->createView()
        ));
    }

}
