<?php

namespace Back\HotelTunisieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\HotelTunisieBundle\Entity\Region;
use Back\HotelTunisieBundle\Form\RegionType;
use Back\HotelTunisieBundle\Entity\Ville;
use Back\HotelTunisieBundle\Form\VilleType;
use Back\HotelTunisieBundle\Entity\Categorie;
use Back\HotelTunisieBundle\Form\CategorieType;
use Symfony\Component\HttpFoundation\Session\Session;

class ReferentielController extends Controller
{

//  Categorie    ********************************************************************************************************************
    Public function categorieAction()
    {
        //appeler le entity manager
        $em = $this->getDoctrine()->getManager();

        //Appeler la liste des catégories
        $categories = $em->getRepository("BackHotelTunisieBundle:Categorie")->findAll();

        //Débuger la variable en mode dev
        dump($categories);

        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/categorie:liste.html.twig', array(
                    'categories' => $categories,
        ));
    }

    public function categorieSupprimerAction(Categorie $categorie)
    {
        //appeler la session
        $session = $this->getRequest()->getSession();

        //appeler le entity manager
        $em = $this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($categorie);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre catégorie a été supprimée avec succées ");
        } catch (\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_categories"));
    }

    public function categorieAjouterAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        //instencer un objet categorie
        $categorie = new Categorie();
        //Creation d'un formulaire 
        $form = $this->createForm(new CategorieType, $categorie);

        $request = $this->getRequest();
        //verifier si on a des post
        if ( $request->isMethod("POST") )
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if ( $form->isValid() )
            {
                $categorie = $form->getData();
                $em->persist($categorie);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre catégorie a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_categories"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/categorie:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function categorieModifierAction(Categorie $categorie)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form = $this->createForm(new CategorieType, $categorie);
        $request = $this->getRequest();
        //verifier si on a des post
        if ( $request->isMethod("POST") )
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if ( $form->isValid() )
            {
                $categorie = $form->getData();
                $em->persist($categorie);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre catégorie a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_categories"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/categorie:modif.html.twig', array(
                    'form' => $form->createView(),
                    'categorie' => $categorie,
        ));
    }

//  Region    ********************************************************************************************************************

    public function regionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository("BackHotelTunisieBundle:Region")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:listeRegion.html.twig', array(
                    'regions' => $regions,
        ));
    }

    public function regionsAjouterAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $region = new Region();
        $form = $this->createForm(new RegionType, $region);
        $request = $this->getRequest();
        if ( $request->isMethod("POST") )
        {
            $form->bind($request);
            if ( $form->isValid() )
            {
                $region = $form->getData();
                $em->persist($region);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Région a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_regions"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:ajoutRegion.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function regionsSupprimerAction(Region $region)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        try
        {
            $em->remove($region);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre région a été supprimée avec succées ");
        } catch (\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("gestion_regions"));
    }

    public function regionsModifierAction(Region $region)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new RegionType, $region);
        $request = $this->getRequest();
        if ( $request->isMethod("POST") )
        {
            $form->bind($request);
            if ( $form->isValid() )
            {
                $categorie = $form->getData();
                $em->persist($region);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Région a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_regions"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:modifRegion.html.twig', array(
                    'form' => $form->createView(),
                    'region' => $region,
        ));
    }

//  Ville    ********************************************************************************************************************

    public function villesAction()
    {
        $em = $this->getDoctrine()->getManager();
//        $filters = $em->getFilters();
//        $filters->disable('softdeleteable');
        $villes = $em->getRepository("BackHotelTunisieBundle:Ville")->findAll();
        dump($villes);
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:listeVille.html.twig', array(
                    'villes' => $villes,
        ));
    }

    public function villesAjouterAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $ville = new Ville();
        $form = $this->createForm(new VilleType, $ville);
        $request = $this->getRequest();
        if ( $request->isMethod("POST") )
        {
            $form->bind($request);
            if ( $form->isValid() )
            {
                $ville = $form->getData();
                $em->persist($ville);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre ville a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_villes"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:ajoutVille.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function villesSupprimerAction(Ville $ville)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        try
        {
            $em->remove($ville);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre ville a été supprimée avec succées ");
        } catch (\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("gestion_villes"));
    }

    public function villesModifierAction(Ville $ville)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new VilleType, $ville);
        $request = $this->getRequest();
        if ( $request->isMethod("POST") )
        {
            $form->bind($request);
            if ( $form->isValid() )
            {
                $categorie = $form->getData();
                $em->persist($ville);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre ville a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_villes"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:modifVille.html.twig', array(
                    'form' => $form->createView(),
                    'ville' => $ville,
        ));
    }

}
