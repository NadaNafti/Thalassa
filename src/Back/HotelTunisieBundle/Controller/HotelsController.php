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
use Back\HotelTunisieBundle\Entity\Saison;
use Back\HotelTunisieBundle\Form\SaisonType;
use Back\HotelTunisieBundle\Form\SaisonCType;
use Back\HotelTunisieBundle\Entity\SaisonChambre;
use Back\HotelTunisieBundle\Form\SaisonChambreType;
use Back\HotelTunisieBundle\Entity\SaisonReduc;
use Back\HotelTunisieBundle\Form\SaisonReducType;
use Back\HotelTunisieBundle\Entity\SaisonArrangement;
use Back\HotelTunisieBundle\Form\SaisonAType;

class HotelsController extends Controller
{

    public function etatAction(Hotel $hotel, $etat)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->persist($hotel->setEtat($etat));
        $em->flush();
        $session->getFlashBag()->add('success', $hotel->getLibelle()." a été modifié avec succées ");
        return $this->redirect($this->generateUrl("list_hotels"));
    }

    public function ajoutAction()
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $session=$this->getRequest()->getSession();
        $hotel=new Hotel;
        $form=$this->createForm(new HotelType(), $hotel);
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $hotel=$form->getData();
                $em->persist($hotel->setEtat(1));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre hôtel a été ajouté avec succées ");
                return $this->redirect($this->generateUrl("list_hotels"));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:ajout.html.twig', array(
                    'form'=>$form->createView()
        ));
    }

    public function listeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $hotels=$em->getRepository("BackHotelTunisieBundle:Hotel")->findAll();
        $paginator=$this->get('knp_paginator');
        $hotels=$paginator->paginate($hotels, $request->query->get('page', 1), 10);
        return $this->render('BackHotelTunisieBundle:Hotels:liste.html.twig', array(
                    'hotels'=>$hotels,
        ));
    }

    public function listeDeletedAction()
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $filters=$em->getFilters();
        $filters->disable('softdeleteable');
        $hotels=$em->getRepository("BackHotelTunisieBundle:Hotel")->getDeletedList();
        $paginator=$this->get('knp_paginator');
        $hotels=$paginator->paginate($hotels, $request->query->get('page', 1), 10);
        return $this->render('BackHotelTunisieBundle:Hotels:listeDeleted.html.twig', array(
                    'hotels'=>$hotels,
        ));
    }

    public function reloadAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $session=$request->getSession();
        $filters=$em->getFilters();
        $filters->disable('softdeleteable');
        $hotel=$em->getRepository("BackHotelTunisieBundle:Hotel")->find($id);
        $hotel->setDeletedAt(null);
        $em->persist($hotel);
        $em->flush();
        $session->getFlashBag()->add('success', " l'hotel ".$hotel->getLibelle()." a été relancé avec succées ");
        return $this->redirect($this->generateUrl("list_hotels_deleted"));
    }

    public function modifAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $request=$this->getRequest();
        $session=$request->getSession();
        if(!$hotel)
            throw $this->createNotFoundException('L\' hôtel n\'existe pas');
        $form=$this->createForm(new HotelType(), $hotel);
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $hotel=$form->getData();
                $em->persist($hotel);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre hôtel a été modifié avec succées ");
                return $this->redirect($this->generateUrl("modif_hotel", array('id'=>$hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:modif.html.twig', array(
                    'form' =>$form->createView(),
                    'hotel'=>$hotel
        ));
    }

    public function supprimerAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(!$hotel)
            throw $this->createNotFoundException('L\' hôtel n\'existe pas');
        $em->remove($hotel);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre hôtel a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("list_hotels"));
    }

    public function photosAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $session->set("routing", $this->generateUrl("photos_hotel", array('id'=>$hotel->getId())));
        $media=new Media();
        $media->setHotel($hotel);
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
                return $this->redirect($this->generateUrl("photos_hotel", array('id'=>$hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:photo.html.twig', array(
                    'hotel' =>$hotel,
                    'form'  =>$form->createView(),
                    'images'=>$hotel->getImages(),
        ));
    }

    public function stopsalesAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $stopSale=new StopSales();
        $stopSale->setHotel($hotel);
        $form=$this->createForm(new StopSalesType(), $stopSale);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $stopSale=$form->getData();
                if($stopSale->getDateDebut()>$stopSale->getDateFin())
                    $session->getFlashBag()->add('danger', "Date fin doit ètre supérieur a la date debut");
                else
                {
                    $em->persist($stopSale);
                    $em->flush();
                    $session->getFlashBag()->add('success', " Votre durée a été ajoutée avec succées ");
                    return $this->redirect($this->generateUrl("stopsales_hotel", array('id'=>$hotel->getId())));
                }
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:stopsales.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView(),
        ));
    }

    public function suppStopSalesAction(StopSales $stopSales)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($stopSales);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre stop sale a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("stopsales_hotel", array('id'=>$stopSales->getHotel()->getId())));
    }

    public function ficheTechniqueAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($hotel->getFicheTechnique()!=NULL)
            $ficheTechnique=$hotel->getFicheTechnique();
        else
            $ficheTechnique=new FicheTechnique ();
        $form=$this->createForm(new FicheTechniqueType(), $ficheTechnique);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $ficheTechnique=$form->getData();
                if($ficheTechnique->getMax1AgeEnfant()>$ficheTechnique->getMin1AgeEnfant()&&$ficheTechnique->getMin1AgeEnfant()>=0&&(($ficheTechnique->getMin2AgeEnfant()==$ficheTechnique->getMax1AgeEnfant()+1&&$ficheTechnique->getMax2AgeEnfant()>$ficheTechnique->getMin2AgeEnfant())||($ficheTechnique->getMin2AgeEnfant()==0&&$ficheTechnique->getMax2AgeEnfant()==0) ))
                {
                    $hotel->setFicheTechnique($ficheTechnique);
                    $em->persist($ficheTechnique);
                    $em->persist($hotel);
                    $em->flush();
                    $session->getFlashBag()->add('success', " Votre fiche technique a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("fiche_technique", array('id'=>$hotel->getId())));
                }
                else
                    $session->getFlashBag()->add('danger', "les deux intervalles sont erronées");
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:fiche_technique.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function saisonBaseAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        if($hotel->getFicheTechnique()==null)
        {
            $session->getFlashBag()->add('info', "Votre devez remplire la fiche technique");
            return $this->redirect($this->generateUrl("fiche_technique", array('id'=>$hotel->getId())));
        }
        if($hotel->getSaisonBase()!=NULL)
            $saison=$hotel->getSaisonBase();
        else
            $saison=new Saison ();
        $form=$this->createForm(new SaisonType(), $saison);
        $form->add("ArrBase", "entity", array(
            'class'        =>'BackHotelTunisieBundle:Arrangement',
            'query_builder'=>function(EntityRepository $er) use ($hotel){
                return $er->createQueryBuilder('a')
                                ->join("a.hotels", "h")
                                ->where('h.id = :id')
                                ->setParameter('id', $hotel->getId());
                ;
            }
        ));
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $saison=$form->getData();
                $hotel->setSaisonBase($saison);
                $em->persist($saison);
                $em->persist($hotel);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_base", array('id'=>$hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_base.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function saisonChambresAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        $saisonBase=$hotel->getSaisonBase();
        foreach($hotel->getChambres() as $ch)
        {
            $verif=$em->getRepository("BackHotelTunisieBundle:SaisonChambre")->findBy(array('saison'=>$hotel->getSaisonBase(), 'chambre'=>$ch));
            if(count($verif)==0)
            {
                $saisonChambres=new SaisonChambre();
                $saisonChambres->setChambre($ch);
                $saisonBase->addChambre($saisonChambres);
            }
        }
        $form=$this->createForm(new SaisonCType(), $saisonBase);
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $saisonBase=$form->getData();
                foreach($saisonBase->getChambres() as $chambres)
                {
                    $em->persist($chambres->setSaison($saisonBase)->setEtat(1));
                }
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_chambres", array('id'=>$hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_chambres.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function deleteSaisonChambresAction(SaisonChambre $saisonChambre, Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($saisonChambre);
        $em->flush();
        $session->getFlashBag()->add('success', "La chambre a été supprimée avec succées");
        return $this->redirect($this->generateUrl("saison_chambres", array('id'=>$hotel->getId())));
    }

    public function saisonReducAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($hotel->getSaisonBase()->getSaisonReduc())
            $saisonReduc=$hotel->getSaisonBase()->getSaisonReduc();
        else
            $saisonReduc=new SaisonReduc();
        $form=$this->createForm(new SaisonReducType(), $saisonReduc);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $saisonReduc=$form->getData();
                $em->persist($saisonReduc);
                $em->persist($hotel->getSaisonBase()->setSaisonReduc($saisonReduc));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison réduction de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_reduction", array('id'=>$hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_reductions.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function saisonArrangementsAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        $saisonBase=$hotel->getSaisonBase();
        foreach($hotel->getArrangements() as $arr)
        {
            $verif=$em->getRepository("BackHotelTunisieBundle:SaisonArrangement")->findBy(array('saison'=>$hotel->getSaisonBase(), 'arrangement'=>$arr));
            if(count($verif)==0&&$arr!=$hotel->getSaisonBase()->getArrBase())
            {
                $saisonArrangement=new SaisonArrangement();
                $saisonArrangement->setArrangement($arr);
                $saisonBase->addArrangement($saisonArrangement);
            }
        }
        $form=$this->createForm(new SaisonAType(), $saisonBase);
        if($request->isMethod("POST"))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $saisonBase=$form->getData();
                foreach($saisonBase->getArrangements() as $Arrangement)
                {
                    $em->persist($Arrangement->setSaison($saisonBase)->setEtat(1));
                }
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_arrangements", array('id'=>$hotel->getId())));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_arrangement.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function deleteSaisonArragementsAction(SaisonArrangement $saisonArrangement, Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($saisonArrangement);
        $em->flush();
        $session->getFlashBag()->add('success', "L'arrangement a été supprimée avec succées");
        return $this->redirect($this->generateUrl("saison_arrangements", array('id'=>$hotel->getId())));
    }
}
