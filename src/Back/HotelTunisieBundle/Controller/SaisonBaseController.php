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
use Back\HotelTunisieBundle\Entity\SaisonSuppChambre;
use Back\HotelTunisieBundle\Form\SaisonSType;
use Back\HotelTunisieBundle\Entity\SaisonVue;
use Back\HotelTunisieBundle\Form\SaisonVType;
use Back\HotelTunisieBundle\Entity\SaisonSupp;
use Back\HotelTunisieBundle\Form\SaisonSuppType;
use Back\HotelTunisieBundle\Entity\SaisonWeekend;
use Back\HotelTunisieBundle\Form\SaisonWeekendType;
use Back\HotelTunisieBundle\Entity\SaisonAutreSupp;
use Back\HotelTunisieBundle\Form\SaisonAutreSuppType;
use Back\HotelTunisieBundle\Entity\SaisonAutreReduc;
use Back\HotelTunisieBundle\Form\SaisonAutreReducType;

class SaisonBaseController extends Controller
{

    public function saisonBaseFicheAction(Hotel $hotel)
    {
        return $this->render('BackHotelTunisieBundle:Hotels:fiche_saison_base.html.twig', array(
                    'hotel'=>$hotel,
        ));
    }

    public function saisonBaseAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        if($hotel->getFicheTechnique() == null)
        {
            $session->getFlashBag()->add('info', "Votre devez remplire la fiche technique");
            return $this->redirect($this->generateUrl("fiche_technique", array( 'id'=>$hotel->getId() )));
        }
        if($hotel->getSaisonBase() != NULL)
            $saison=$hotel->getSaisonBase();
        else
        {
            $saison=new Saison ();
            $saison->setLibelle("Saison de base");
        }
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
                return $this->redirect($this->generateUrl("saison_base", array( 'id'=>$hotel->getId() )));
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
            $verif=$em->getRepository("BackHotelTunisieBundle:SaisonChambre")->findBy(array( 'saison'=>$hotel->getSaisonBase(), 'chambre'=>$ch ));
            if(count($verif) == 0)
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
                return $this->redirect($this->generateUrl("saison_chambres", array( 'id'=>$hotel->getId() )));
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
        return $this->redirect($this->generateUrl("saison_chambres", array( 'id'=>$hotel->getId() )));
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
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_reduction", array( 'id'=>$hotel->getId() )));
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
            $verif=$em->getRepository("BackHotelTunisieBundle:SaisonArrangement")->findBy(array( 'saison'=>$hotel->getSaisonBase(), 'arrangement'=>$arr ));
            if(count($verif) == 0 && $arr != $hotel->getSaisonBase()->getArrBase())
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
                return $this->redirect($this->generateUrl("saison_arrangements", array( 'id'=>$hotel->getId() )));
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
        return $this->redirect($this->generateUrl("saison_arrangements", array( 'id'=>$hotel->getId() )));
    }

    public function saisonSuppChambresAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        $saisonBase=$hotel->getSaisonBase();
        foreach($hotel->getChambres() as $ch)
        {
            $verif=$em->getRepository("BackHotelTunisieBundle:SaisonSuppChambre")->findBy(array( 'saison'=>$hotel->getSaisonBase(), 'chambre'=>$ch ));
            if(count($verif) == 0 && $ch->getType() == 0)
            {
                $saisonSuppChambres=new SaisonSuppChambre();
                $saisonSuppChambres->setChambre($ch);
                $saisonBase->addSuppChambre($saisonSuppChambres);
            }
        }
        $form=$this->createForm(new SaisonSType(), $saisonBase);
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $saisonBase=$form->getData();
                foreach($saisonBase->getSuppChambres() as $chambres)
                {
                    $em->persist($chambres->setSaison($saisonBase)->setEtat(1));
                }
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_supp_chambres", array( 'id'=>$hotel->getId() )));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_supp_chambres.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function deleteSaisonSuppChambresAction(SaisonSuppChambre $saisonSuppChambre, Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($saisonSuppChambre);
        $em->flush();
        $session->getFlashBag()->add('success', "La chambre a été supprimée avec succées");
        return $this->redirect($this->generateUrl("saison_supp_chambres", array( 'id'=>$hotel->getId() )));
    }

    public function saisonVuesAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $request=$this->getRequest();
        $saisonBase=$hotel->getSaisonBase();
        foreach($hotel->getVues() as $vue)
        {
            $verif=$em->getRepository("BackHotelTunisieBundle:SaisonVue")->findBy(array( 'saison'=>$hotel->getSaisonBase(), 'vue'=>$vue ));
            if(count($verif) == 0)
            {
                $saisonVue=new SaisonVue();
                $saisonVue->setVue($vue);
                $saisonBase->addVue($saisonVue);
            }
        }
        $form=$this->createForm(new SaisonVType(), $saisonBase);
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $saisonBase=$form->getData();
                foreach($saisonBase->getVues() as $Vue)
                {
                    $em->persist($Vue->setSaison($saisonBase)->setEtat(1));
                }
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_vues", array( 'id'=>$hotel->getId() )));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_vue.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function deleteSaisonVuesAction(SaisonVue $saisonVue, Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($saisonVue);
        $em->flush();
        $session->getFlashBag()->add('success', "La vue a été supprimée avec succées");
        return $this->redirect($this->generateUrl("saison_vues", array( 'id'=>$hotel->getId() )));
    }

    public function saisonSuppAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($hotel->getSaisonBase()->getSaisonSupp() == NULL)
            $saisonSupp=new SaisonSupp();
        else
            $saisonSupp=$hotel->getSaisonBase()->getSaisonSupp();
        $form=$this->createForm(new SaisonSuppType(), $saisonSupp);
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $saisonSupp=$form->getData();
                $em->persist($saisonSupp);
                $em->persist($hotel->getSaisonBase()->setSaisonSupp($saisonSupp));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_supplement", array( 'id'=>$hotel->getId() )));
            }
        }

        return $this->render("BackHotelTunisieBundle:Hotels:saison_supplement.html.twig", array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function saisonWeekendAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($hotel->getSaisonBase()->getSaisonWeekend() == NULL)
            $saisonWeekend=new SaisonWeekend();
        else
            $saisonWeekend=$hotel->getSaisonBase()->getSaisonWeekend();
        $form=$this->createForm(new SaisonWeekendType(), $saisonWeekend);
        $form->add("chambres", "entity", array(
            'class'        =>'BackHotelTunisieBundle:Chambre',
            'query_builder'=>function(EntityRepository $er) use ($hotel){
                return $er->createQueryBuilder('a')
                                ->join("a.hotels", "h")
                                ->where('h.id = :id')
                                ->setParameter('id', $hotel->getId());
                ;
            },
            'multiple'    =>true,
            'expanded'    =>false,
        ));
        $request=$this->getRequest();
        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $saisonWeekend=$form->getData();
                $em->persist($saisonWeekend);
                $em->persist($hotel->getSaisonBase()->setSaisonWeekend($saisonWeekend));
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_weekend", array( 'id'=>$hotel->getId() )));
            }
        }

        return $this->render("BackHotelTunisieBundle:Hotels:saison_weekend.html.twig", array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function saisonAutreSuppAction(Hotel $hotel, $id2)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($id2 == null)
            $saisonAutreSupp=new SaisonAutreSupp();
        else
            $saisonAutreSupp=$em->getRepository("BackHotelTunisieBundle:SaisonAutreSupp")->find($id2);
        $saisonAutreSupp->setSaison($hotel->getSaisonBase());
        $form=$this->createForm(new SaisonAutreSuppType(), $saisonAutreSupp);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $saisonAutreSupp=$form->getData();
                $em->persist($saisonAutreSupp);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_autres_supp", array( 'id'=>$hotel->getId() )));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_autre_supp.html.twig', array(
                    'hotel'          =>$hotel,
                    'form'           =>$form->createView(),
                    'saisonAutreSupp'=>$saisonAutreSupp,
        ));
    }

    public function deleteAutreSuppAction(Hotel $hotel, SaisonAutreSupp $saisonAutreSupp)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($saisonAutreSupp);
        $em->flush();
        $session->getFlashBag()->add('success', "La reduclement a été reducrimée avec succées");
        return $this->redirect($this->generateUrl("saison_autres_reduc", array(
                            'id'=>$hotel->getId(),
        )));
    }

    public function saisonAutreReducAction(Hotel $hotel, $id2)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($id2 == null)
            $saisonAutreReduc=new SaisonAutreReduc();
        else
            $saisonAutreReduc=$em->getRepository("BackHotelTunisieBundle:SaisonAutreReduc")->find($id2);
        $saisonAutreReduc->setSaison($hotel->getSaisonBase());
        $form=$this->createForm(new SaisonAutreReducType(), $saisonAutreReduc);
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $saisonAutreReduc=$form->getData();
                $em->persist($saisonAutreReduc);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison de base a été modifié avec succées ");
                return $this->redirect($this->generateUrl("saison_autres_reduc", array( 'id'=>$hotel->getId() )));
            }
        }
        return $this->render('BackHotelTunisieBundle:Hotels:saison_autre_reduc.html.twig', array(
                    'hotel'           =>$hotel,
                    'form'            =>$form->createView(),
                    'saisonAutreReduc'=>$saisonAutreReduc,
        ));
    }

    public function deleteAutreReducAction(Hotel $hotel, SaisonAutreReduc $saisonAutreReduc)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($saisonAutreReduc);
        $em->flush();
        $session->getFlashBag()->add('success', "La réduction a été supprimée avec succées");
        return $this->redirect($this->generateUrl("saison_autres_reduc", array(
                            'id'=>$hotel->getId(),
        )));
    }

}
