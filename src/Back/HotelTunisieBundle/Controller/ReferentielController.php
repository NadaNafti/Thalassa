<?php

namespace Back\HotelTunisieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Back\HotelTunisieBundle\Entity\Media;
use Back\HotelTunisieBundle\Form\MediaType;
use Back\HotelTunisieBundle\Entity\Region;
use Back\HotelTunisieBundle\Form\RegionType;
use Back\HotelTunisieBundle\Entity\Ville;
use Back\HotelTunisieBundle\Form\VilleType;
use Back\HotelTunisieBundle\Entity\Categorie;
use Back\HotelTunisieBundle\Form\CategorieType;
use Back\HotelTunisieBundle\Entity\TypeAmenagement;
use Back\HotelTunisieBundle\Form\TypeAmenagementType;
use Back\HotelTunisieBundle\Entity\Amenagement;
use Back\HotelTunisieBundle\Form\AmenagementType;
use Back\HotelTunisieBundle\Entity\Theme;
use Back\HotelTunisieBundle\Form\ThemeType;
use Back\HotelTunisieBundle\Entity\Vue;
use Back\HotelTunisieBundle\Form\VueType;
use Back\HotelTunisieBundle\Entity\Optionn;
use Back\HotelTunisieBundle\Form\OptionnType;
use Back\HotelTunisieBundle\Entity\Localisation;
use Back\HotelTunisieBundle\Form\LocalisationType;
use Back\HotelTunisieBundle\Entity\Chambre;
use Back\HotelTunisieBundle\Form\ChambreType;
use Back\HotelTunisieBundle\Entity\Chaine;
use Back\HotelTunisieBundle\Form\ChaineType;
use Back\HotelTunisieBundle\Entity\Arrangement;
use Back\HotelTunisieBundle\Form\ArrangementType;
use Back\HotelTunisieBundle\Entity\Tag;
use Back\HotelTunisieBundle\Form\TagType;
use Back\HotelTunisieBundle\Entity\Supplement;
use Back\HotelTunisieBundle\Form\SupplementType;
use Back\HotelTunisieBundle\Entity\Reduction;
use Back\HotelTunisieBundle\Form\ReductionType;
use Symfony\Component\HttpFoundation\Session\Session;

class ReferentielController extends Controller
{

    public function deletePhotoAction(Media $media)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($media);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre photo a été supprimé avec succées ");
        return $this->redirect($session->get("routing"));
    }

//  Categorie    ********************************************************************************************************************
    Public function categorieAction()
    {
        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        //Appeler la liste des catégories
        $categories=$em->getRepository("BackHotelTunisieBundle:Categorie")->findAll();

        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/categorie:liste.html.twig', array(
                    'categories'=>$categories,
        ));
    }

    public function categorieSupprimerAction(Categorie $categorie)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($categorie);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre catégorie a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_categories"));
    }

    public function categorieAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet categorie
        $categorie=new Categorie();
        //Creation d'un formulaire 
        $form=$this->createForm(new CategorieType, $categorie);

        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $categorie=$form->getData();
                $em->persist($categorie);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre catégorie a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_categories"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/categorie:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function categorieModifierAction(Categorie $categorie)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new CategorieType, $categorie);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $categorie=$form->getData();
                $em->persist($categorie);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre catégorie a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_categories"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/categorie:modif.html.twig', array(
                    'form'     =>$form->createView(),
                    'categorie'=>$categorie,
        ));
    }

//  Region    ********************************************************************************************************************

    public function regionsAction()
    {
        $em=$this->getDoctrine()->getManager();
        $regions=$em->getRepository("BackHotelTunisieBundle:Region")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:listeRegion.html.twig', array(
                    'regions'=>$regions,
        ));
    }

    public function regionsAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        $region=new Region();
        $form=$this->createForm(new RegionType, $region);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $region=$form->getData();
                $em->persist($region);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Région a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_regions"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:ajoutRegion.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function regionsSupprimerAction(Region $region)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        try
        {
            $em->remove($region);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre région a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("gestion_regions"));
    }

    public function regionsModifierAction(Region $region)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm(new RegionType, $region);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $categorie=$form->getData();
                $em->persist($region);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Région a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_regions"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:modifRegion.html.twig', array(
                    'form'  =>$form->createView(),
                    'region'=>$region,
        ));
    }

//  Ville    ********************************************************************************************************************

    public function villesAction()
    {
        $request=$this->getRequest();
        $em=$this->getDoctrine()->getManager();
        $villes=$em->getRepository("BackHotelTunisieBundle:Ville")->findAll();
        $paginator=$this->get('knp_paginator');
        $villes=$paginator->paginate($villes, $request->query->get('page', 1), 10);
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:listeVille.html.twig', array(
                    'villes'=>$villes,
        ));
    }

    public function villesAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        $ville=new Ville();
        $form=$this->createForm(new VilleType, $ville);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $ville=$form->getData();
                $em->persist($ville);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre ville a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_villes"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:ajoutVille.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function villesSupprimerAction(Ville $ville)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        try
        {
            $em->remove($ville);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre ville a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("gestion_villes"));
    }

    public function villesModifierAction(Ville $ville)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm(new VilleType, $ville);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $categorie=$form->getData();
                $em->persist($ville);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre ville a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_villes"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:modifVille.html.twig', array(
                    'form' =>$form->createView(),
                    'ville'=>$ville,
        ));
    }

    public function villesphotoAction(Ville $ville)
    {
        $session=$this->getRequest()->getSession();
        $session->set("routing", $this->generateUrl("photos_villes", array('id'=>$ville->getId())));
        $em=$this->getDoctrine()->getManager();
        $media=new Media();
        $media->setVille($ville);
        $form=$this->createForm(new MediaType(), $media);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $media=$form->getData();
                $em->persist($media);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre Photo a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("photos_villes", array('id'=>$ville->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/regionVille:photoVille.html.twig', array(
                    'ville' =>$ville,
                    'form'  =>$form->createView(),
                    'images'=>$ville->getImages(),
        ));
    }

// Type amenagement    ****************************************************************************************************************
    public function typeAmenagementAction()
    {
        $em=$this->getDoctrine()->getManager();
        $typeAmenegaments=$em->getRepository("BackHotelTunisieBundle:TypeAmenagement")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/amenagement:TypeAmenagementliste.html.twig', array(
                    'typeAmenegaments'=>$typeAmenegaments,
        ));
    }

    public function typeAmenagementAjouterAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $typeAmenagement=new TypeAmenagement();
        $form=$this->createForm(new TypeAmenagementType, $typeAmenagement);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $typeAmenagement=$form->getData();
                $em->persist($typeAmenagement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre type a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_type_amenagement"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/amenagement:TypeAmenagementAjout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function typeAmenagementModifierAction(TypeAmenagement $typeAmenagement)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $form=$this->createForm(new TypeAmenagementType, $typeAmenagement);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $typeAmenagement=$form->getData();
                $em->persist($typeAmenagement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre type a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("gestion_type_amenagement"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/amenagement:TypeAmenagementModif.html.twig', array(
                    'form'           =>$form->createView(),
                    'typeAmenagement'=>$typeAmenagement
        ));
    }

    public function typeAmenagementSupprimerAction(TypeAmenagement $typeAmenagement)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($typeAmenagement);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre type a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("gestion_type_amenagement"));
    }

// Amenagement    ****************************************************************************************************************
    public function amenagementAction()
    {
        $em=$this->getDoctrine()->getManager();
        $amenegaments=$em->getRepository("BackHotelTunisieBundle:Amenagement")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/amenagement:Amenagementliste.html.twig', array(
                    'amenegaments'=>$amenegaments,
        ));
    }

    public function amenagementAjouterAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $amenagement=new Amenagement();
        $form=$this->createForm(new AmenagementType, $amenagement);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $amenagement=$form->getData();
                $em->persist($amenagement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre aménagement a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_amenagement"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/amenagement:AmenagementAjout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function amenagementModifierAction(Amenagement $amenagement)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $form=$this->createForm(new AmenagementType, $amenagement);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $amenagement=$form->getData();
                $em->persist($amenagement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre améngament a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("gestion_amenagement"));
            }
        }
        return $this->render('BackHotelTunisieBundle:referentiel/amenagement:AmenagementModif.html.twig', array(
                    'form'       =>$form->createView(),
                    'amenagement'=>$amenagement
        ));
    }

    public function amenagementSupprimerAction(Amenagement $amenagement)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($amenagement);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre aménagement a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("gestion_amenagement"));
    }

//  chaine    ********************************************************************************************************************
    Public function chaineAction()
    {
        $em=$this->getDoctrine()->getManager();
        $chaines=$em->getRepository("BackHotelTunisieBundle:Chaine")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/chaine:liste.html.twig', array(
                    'chaines'=>$chaines,
        ));
    }

    public function chaineSupprimerAction(Chaine $chaines)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($chaines);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre chaine a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_chaine"));
    }

    public function chaineAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet chaine
        $chaine=new Chaine();
        //Creation d'un formulaire 
        $form=$this->createForm(new ChaineType, $chaine);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $chaine=$form->getData();
                $em->persist($chaine);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre chaine a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_chaine"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/chaine:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function chaineModifierAction(Chaine $chaine)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new ChaineType, $chaine);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $chaine=$form->getData();
                $em->persist($chaine);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre chaine a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_chaine"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/chaine:modif.html.twig', array(
                    'form'  =>$form->createView(),
                    'chaine'=>$chaine,
        ));
    }

//  theme    ********************************************************************************************************************
    Public function themeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $themes=$em->getRepository("BackHotelTunisieBundle:Theme")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/theme:liste.html.twig', array(
                    'themes'=>$themes,
        ));
    }

    public function themeSupprimerAction(Theme $themes)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($themes);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre thème a été supprimé avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_theme"));
    }

    public function themeAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet chaine
        $theme=new Theme();
        //Creation d'un formulaire 
        $form=$this->createForm(new ThemeType, $theme);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $theme=$form->getData();
                $em->persist($theme);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre thème a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("gestion_theme"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/theme:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function themeModifierAction(Theme $theme)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new ThemeType, $theme);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $theme=$form->getData();
                $em->persist($theme);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre thème a été modifié avec succées ");
                return $this->redirect($this->generateUrl("gestion_theme"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/theme:modif.html.twig', array(
                    'form' =>$form->createView(),
                    'theme'=>$theme,
        ));
    }

//   Vue   ********************************************************************************************************************
    Public function vueAction()
    {
        $em=$this->getDoctrine()->getManager();
        $vues=$em->getRepository("BackHotelTunisieBundle:Vue")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/vue:liste.html.twig', array(
                    'vues'=>$vues,
        ));
    }

    public function vueSupprimerAction(Vue $vues)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($vues);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre vue a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_vue"));
    }

    public function vueAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet vue
        $vue=new Vue();
        //Creation d'un formulaire 
        $form=$this->createForm(new VueType, $vue);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $vue=$form->getData();
                $em->persist($vue);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre vue a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_vue"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/vue:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function vueModifierAction(Vue $vue)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new VueType, $vue);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $vue=$form->getData();
                $em->persist($vue);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre vue a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_vue"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/vue:modif.html.twig', array(
                    'form'=>$form->createView(),
                    'vue' =>$vue,
        ));
    }

//   Option  ********************************************************************************************************************
    Public function optionnAction()
    {
        $em=$this->getDoctrine()->getManager();
        $optionns=$em->getRepository("BackHotelTunisieBundle:Optionn")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/optionn:liste.html.twig', array(
                    'optionns'=>$optionns,
        ));
    }

    public function optionnSupprimerAction(Optionn $optionns)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($optionns);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre option a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_optionn"));
    }

    public function optionnAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet vue
        $optionn=new Optionn();
        //Creation d'un formulaire 
        $form=$this->createForm(new OptionnType, $optionn);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $optionn=$form->getData();
                $em->persist($optionn);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre option a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_optionn"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/optionn:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function optionnModifierAction(Optionn $optionn)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new OptionnType, $optionn);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $optionn=$form->getData();
                $em->persist($optionn);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre option a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_optionn"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/optionn:modif.html.twig', array(
                    'form'   =>$form->createView(),
                    'optionn'=>$optionn,
        ));
    }

//   Localisation  ********************************************************************************************************************
    Public function localisationAction()
    {
        $em=$this->getDoctrine()->getManager();
        $localisations=$em->getRepository("BackHotelTunisieBundle:Localisation")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/localisation:liste.html.twig', array(
                    'localisations'=>$localisations,
        ));
    }

    public function localisationSupprimerAction(Localisation $localisations)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($localisations);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre localisation a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_localisation"));
    }

    public function localisationAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet localisation
        $localisation=new Localisation();
        //Creation d'un formulaire 
        $form=$this->createForm(new LocalisationType, $localisation);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $localisation=$form->getData();
                $em->persist($localisation);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre localisation a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_localisation"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/localisation:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function localisationModifierAction(Localisation $localisation)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new LocalisationType, $localisation);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $localisation=$form->getData();
                $em->persist($localisation);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre localisation a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_localisation"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/localisation:modif.html.twig', array(
                    'form'        =>$form->createView(),
                    'localisation'=>$localisation,
        ));
    }

//   Chambre  ********************************************************************************************************************
    Public function chambreAction()
    {
        $em=$this->getDoctrine()->getManager();
        $chambres=$em->getRepository("BackHotelTunisieBundle:Chambre")->findAll();
        return $this->render('BackHotelTunisieBundle:referentiel/chambre:liste.html.twig', array(
                    'chambres'=>$chambres,
        ));
    }

    public function chambreSupprimerAction(Chambre $chambres)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($chambres);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre chambre a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_chambre"));
    }

    public function chambreAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet chambre
        $chambre=new Chambre();
        //Creation d'un formulaire 
        $form=$this->createForm(new ChambreType, $chambre);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $chambre=$form->getData();
                $em->persist($chambre);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre chambre a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_chambre"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/chambre:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function chambreModifierAction(Chambre $chambre)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new ChambreType, $chambre);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $chambre=$form->getData();
                $em->persist($chambre);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre chambre a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_chambre"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/chambre:modif.html.twig', array(
                    'form'   =>$form->createView(),
                    'chambre'=>$chambre,
        ));
    }

//  Arrangement    ********************************************************************************************************************
    Public function arrangementAction()
    {
        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        //Appeler la liste des arrangements
        $arrangements=$em->getRepository("BackHotelTunisieBundle:Arrangement")->findAll();

        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/arrangement:liste.html.twig', array(
                    'arrangements'=>$arrangements,
        ));
    }

    public function arrangementSupprimerAction(Arrangement $arrangement)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($arrangement);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre arrangement a été supprimé avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_arrangement"));
    }

    public function arrangementAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet categorie
        $arrangement=new Arrangement();
        //Creation d'un formulaire 
        $form=$this->createForm(new ArrangementType, $arrangement);

        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $arrangement=$form->getData();
                $em->persist($arrangement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre arrangement a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("gestion_arrangement"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/arrangement:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function arrangementModifierAction(Arrangement $arrangement)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new ArrangementType, $arrangement);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $arrangement=$form->getData();
                $em->persist($arrangement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre arrangement a été modifié avec succées ");
                return $this->redirect($this->generateUrl("gestion_arrangement"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/arrangement:modif.html.twig', array(
                    'form'       =>$form->createView(),
                    'arrangement'=>$arrangement,
        ));
    }

//  Tag    ********************************************************************************************************************
    Public function tagAction()
    {
        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        //Appeler la liste des tags
        $tags=$em->getRepository("BackHotelTunisieBundle:Tag")->findAll();

        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/tag:liste.html.twig', array(
                    'tags'=>$tags,
        ));
    }

    public function tagSupprimerAction(Tag $tag)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($tag);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre tag a été supprimé avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_tag"));
    }

    public function tagAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet tag
        $tag=new Tag();
        //Creation d'un formulaire 
        $form=$this->createForm(new TagType, $tag);

        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $tag=$form->getData();
                $em->persist($tag);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre tag a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("gestion_tag"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/tag:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function tagModifierAction(Tag $tag)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new TagType, $tag);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $tag=$form->getData();
                $em->persist($tag);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre tagt a été modifié avec succées ");
                return $this->redirect($this->generateUrl("gestion_tag"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/tag:modif.html.twig', array(
                    'form'=>$form->createView(),
                    'tag' =>$tag,
        ));
    }

//  Supplement    ********************************************************************************************************************
    Public function supplementAction()
    {
        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        //Appeler la liste des supplements
        $supplements=$em->getRepository("BackHotelTunisieBundle:Supplement")->findAll();

        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/supplement:liste.html.twig', array(
                    'supplements'=>$supplements,
        ));
    }

    public function supplementSupprimerAction(Supplement $supplement)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($supplement);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre supplément a été supprimé avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_supplement"));
    }

    public function supplementAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet supplement
        $supplement=new Supplement();
        //Creation d'un formulaire 
        $form=$this->createForm(new SupplementType, $supplement);

        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $supplement=$form->getData();
                $em->persist($supplement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre supplément a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("gestion_supplement"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/supplement:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function supplementModifierAction(Supplement $supplement)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new SupplementType, $supplement);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $supplement=$form->getData();
                $em->persist($supplement);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre supplément a été modifié avec succées ");
                return $this->redirect($this->generateUrl("gestion_supplement"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/supplement:modif.html.twig', array(
                    'form'      =>$form->createView(),
                    'supplement'=>$supplement,
        ));
    }

//  Reduction    ********************************************************************************************************************
    Public function reductionAction()
    {
        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        //Appeler la liste des supplements
        $reductions=$em->getRepository("BackHotelTunisieBundle:Reduction")->findAll();

        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/reduction:liste.html.twig', array(
                    'reductions'=>$reductions,
        ));
    }

    public function reductionSupprimerAction(Reduction $reduction)
    {
        //appeler la session
        $session=$this->getRequest()->getSession();

        //appeler le entity manager
        $em=$this->getDoctrine()->getManager();

        try
        {
            //Effacer la ligne
            $em->remove($reduction);
            //commit base de données
            $em->flush();
            //afficher la message de succes
            $session->getFlashBag()->add('success', " Votre réduction a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            //afficher la message d'erreur
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }

        //Faire un redirection
        return $this->redirect($this->generateUrl("gestion_reduction"));
    }

    public function reductionAjouterAction()
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //instencer un objet reduction
        $reduction=new Reduction();
        //Creation d'un formulaire 
        $form=$this->createForm(new ReductionType, $reduction);

        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $reduction=$form->getData();
                $em->persist($reduction);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre reduction a été ajoutée avec succées ");
                return $this->redirect($this->generateUrl("gestion_reduction"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/reduction:ajout.html.twig', array(
                    'form'=>$form->createView(),
        ));
    }

    public function reductionModifierAction(Reduction $reduction)
    {
        $session=$this->getRequest()->getSession();
        $em=$this->getDoctrine()->getManager();
        //Creation d'un formulaire 
        $form=$this->createForm(new ReductionType, $reduction);
        $request=$this->getRequest();
        //verifier si on a des post
        if($request->isMethod("POST"))
        {
            //metre le request dans le formulaire
            $form->bind($request);
            if($form->isValid())
            {
                $reduction=$form->getData();
                $em->persist($reduction);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre réduction a été modifiée avec succées ");
                return $this->redirect($this->generateUrl("gestion_reduction"));
            }
        }
        //Appeler la page twig 
        return $this->render('BackHotelTunisieBundle:referentiel/reduction:modif.html.twig', array(
                    'form'     =>$form->createView(),
                    'reduction'=>$reduction,
        ));
    }

}
