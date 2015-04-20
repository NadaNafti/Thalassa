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
use Back\HotelTunisieBundle\Entity\Periode;
use Back\HotelTunisieBundle\Form\SaisonPeriodesType;

class SaisonsController extends Controller
{

    public function GenererAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $data=array();
        $form=$this->createFormBuilder()
                        ->add('libelle', 'text')
                        ->add('type', 'choice', array(
                            'choices'    =>array( '1'=>'Saison', '2'=>'Promotion' ),
                            'required'   =>true,
                            'empty_value'=>'Type de saison',
                            'empty_data' =>null
                        ))
                        ->add('saisons', 'entity', array(
                            'class'        =>'BackHotelTunisieBundle:Saison',
                            'query_builder'=>function(EntityRepository $er) use ($hotel){
                                return $er->createQueryBuilder('s')
                                        ->where('s.hotel = :id')
                                        ->setParameter('id', $hotel->getId());
                                ;
                            },
                            'required'   =>false,
                            'empty_value'=>'Saison de base',
                            'empty_data' =>null
                        ))->getForm();
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->submit($request);
            $data=$form->getData();
            if($data['saisons'] == NULL)
                $Saison=$hotel->getSaisonBase();
            else
                $Saison=$data['saisons'];

            $newSaison=clone $Saison;
            $newSaison->setHotelBase(NULL);
            $newSaison->setHotel($hotel);
            $newSaison->setLibelle($data['libelle']);
            $newSaison->setType($data['type']);

            $em->persist($newSaison);
            foreach($Saison->getArrangements() as $entity)
            {
                $newEntity=clone $entity;
                $em->persist($newEntity->setSaison($newSaison));
            }
            foreach($Saison->getAutresReductions() as $entity)
            {
                $newEntity=clone $entity;
                $em->persist($newEntity->setSaison($newSaison));
            }
            foreach($Saison->getAutresSupplements() as $entity)
            {
                $newEntity=clone $entity;
                $em->persist($newEntity->setSaison($newSaison));
            }
            foreach($Saison->getChambres() as $entity)
            {
                $newEntity=clone $entity;
                $em->persist($newEntity->setSaison($newSaison));
            }
            foreach($Saison->getSuppChambres() as $entity)
            {
                $newEntity=clone $entity;
                $em->persist($newEntity->setSaison($newSaison));
            }
            foreach($Saison->getVues() as $entity)
            {
                $newEntity=clone $entity;
                $em->persist($newEntity->setSaison($newSaison));
            }
            $em->flush();
            $session->getFlashBag()->add('success', " Votre saison a été générer avec succées ");
            return $this->redirect($this->generateUrl("PeriodeSaison", array( 'id'=>$newSaison->getId() )));
        }
        return $this->render('BackHotelTunisieBundle:Saisons:generer.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

    public function listeAction(Hotel $hotel)
    {
        return $this->render('BackHotelTunisieBundle:Saisons:liste.html.twig', array(
                    'hotel'=>$hotel,
        ));
    }

    public function periodeAction(Saison $saison)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();

        $form=$this->createForm(new SaisonPeriodesType(), $saison->addPeriode(new Periode())->addPeriode(new Periode())->addPeriode(new Periode()));
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->submit($request);
            if($form->isValid())
            {
                $saison=$form->getData();
                foreach($saison->getPeriodes() as $periode)
                {
                    if($periode->getDateDebut() == null || $periode->getDateFin() == null)
                    {
                        $em->remove($periode);
                        $saison->removePeriode($periode);
                    }
                    else
                        $em->persist($periode->setSaison($saison));
                }
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison a été modifié avec succées ");
                return $this->redirect($this->generateUrl("PeriodeSaison", array( 'id'=>$saison->getId() )));
            }
        }
        return $this->render('BackHotelTunisieBundle:Saisons:periodes.html.twig', array(
                    'hotel' =>$saison->getHotel(),
                    'saison'=>$saison,
                    'form'  =>$form->createView()
        ));
    }

    public function generalAction(Saison $saison)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $hotel=$saison->getHotel(); 
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
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $saison=$form->getData();
                $em->persist($saison);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre saison a été modifié avec succées ");
                return $this->redirect($this->generateUrl("GeneralSaison", array( 'id'=>$saison->getId() )));
            }
        }
        return $this->render('BackHotelTunisieBundle:Saisons:general.html.twig', array(
                    'hotel'=>$hotel,
                    'saison'=>$saison,
                    'form' =>$form->createView()
        ));
    }
    
}
