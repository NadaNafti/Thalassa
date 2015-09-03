<?php
    namespace Back\HotelTunisieBundle\Controller;

    use Back\HotelTunisieBundle\Entity\Chambre;
    use Back\HotelTunisieBundle\Entity\SaisonFraisChambre;
    use Back\HotelTunisieBundle\Form\SaisonFraisChambreType;
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
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $data = array();
            $form = $this->createFormBuilder()
                ->add('libelle','text')
                ->add('type','choice',array(
                    'choices'     => array('1' => 'Saison','2' => 'Promotion','3' => 'Amicales'),
                    'required'    => TRUE,
                    'empty_value' => 'Type de saison',
                    'empty_data'  => NULL,
                ))
                ->add('saisons','entity',array(
                    'class'         => 'BackHotelTunisieBundle:Saison',
                    'query_builder' => function (EntityRepository $er) use ($hotel){
                        return $er->createQueryBuilder('s')
                            ->where('s.hotel = :id')
                            ->setParameter('id',$hotel->getId())
                            ->orderBy('s.id','desc');;
                    },
                    'property'      => 'contratLibelle',
                    'required'      => FALSE,
                    'empty_value'   => 'Saison de base',
                    'empty_data'    => NULL,
                ))
                ->add('contrats','entity',array(
                    'class'         => 'BackHotelTunisieBundle:Contrat',
                    'query_builder' => function (EntityRepository $er) use ($hotel){
                        return $er->createQueryBuilder('c')
                            ->where('c.hotel = :id')
                            ->setParameter('id',$hotel->getId())
                            ->orderBy('c.id','desc');;
                    },
                    'required'      => TRUE,
                    'attr'          => array('required' => TRUE),
                ))
                ->getForm();
            $request = $this->getRequest();
            if($request->isMethod("POST")){
                $form->submit($request);
                $data = $form->getData();
                if($data['saisons'] == NULL)
                    $Saison = $hotel->getSaisonBase();
                else
                    $Saison = $data['saisons'];
                $newSaison = clone $Saison;
                $newSaison->setContrat($data['contrats']);
                $newSaison->setHotelBase(NULL);
                $newSaison->setHotel($hotel);
                $newSaison->setLibelle($data['libelle']);
                $newSaison->setType($data['type']);
                $newSaison->setCreated(new \DateTime());
                $em->persist($newSaison);
                foreach($Saison->getArrangements() as $entity){
                    $newEntity = clone $entity;
                    $em->persist($newEntity->setSaison($newSaison));
                }
                foreach($Saison->getAutresReductions() as $entity){
                    $newEntity = clone $entity;
                    $em->persist($newEntity->setSaison($newSaison));
                }
                foreach($Saison->getAutresSupplements() as $entity){
                    $newEntity = clone $entity;
                    $em->persist($newEntity->setSaison($newSaison));
                }
                foreach($Saison->getChambres() as $entity){
                    $newEntity = clone $entity;
                    $em->persist($newEntity->setSaison($newSaison));
                }
                foreach($Saison->getSuppChambres() as $entity){
                    $newEntity = clone $entity;
                    $em->persist($newEntity->setSaison($newSaison));
                }
                foreach($Saison->getVues() as $entity){
                    $newEntity = clone $entity;
                    $em->persist($newEntity->setSaison($newSaison));
                }
                $em->flush();
                $session->getFlashBag()->add('success'," Votre saison a été générer avec succées ");
                return $this->redirect($this->generateUrl("PeriodeSaison",array('id' => $newSaison->getId())));
            }
            return $this->render('BackHotelTunisieBundle:Saisons:generer.html.twig',array(
                'hotel' => $hotel,
                'form'  => $form->createView(),
            ));
        }

        public function listeAction(Hotel $hotel)
        {
            $em = $this->getDoctrine()->getManager();
            $saisons = $em->getRepository('BackHotelTunisieBundle:Saison')->findBy(array('hotel' => $hotel),array('id' => 'desc'));
            $paginator = $this->get('knp_paginator');
            $saisons = $paginator->paginate($saisons,$this->getRequest()->query->get('page',1),10);
            return $this->render('BackHotelTunisieBundle:Saisons:liste.html.twig',array(
                'hotel'   => $hotel,
                'saisons' => $saisons,
            ));
        }

        public function periodeAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $form = $this->createForm(new SaisonPeriodesType(),$saison->addPeriode(new Periode())->addPeriode(new Periode())->addPeriode(new Periode()));
            if($saison->getType() == 3)
                $form->add("amicales");
            $request = $this->getRequest();
            if($request->isMethod("POST")){
                $form->submit($request);
                if($form->isValid()){
                    $saison = $form->getData();
                    foreach($saison->getPeriodes() as $periode){
                        if($periode->getDateDebut() == NULL || $periode->getDateFin() == NULL || $periode->getDateFin()->format("Y-m-d") < $periode->getDateDebut()->format("Y-m-d")){
                            $em->remove($periode);
                            $saison->removePeriode($periode);
                        } else
                            $em->persist($periode->setSaison($saison));
                    }
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("PeriodeSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:periodes.html.twig',array(
                'hotel'  => $saison->getHotel(),
                'saison' => $saison,
                'form'   => $form->createView(),
            ));
        }

        public function generalAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $hotel = $saison->getHotel();
            $form = $this->createForm(new SaisonType(),$saison);
            $form->add("ArrBase","entity",array(
                'class'         => 'BackHotelTunisieBundle:Arrangement',
                'query_builder' => function (EntityRepository $er) use ($hotel){
                    return $er->createQueryBuilder('a')
                        ->join("a.hotels","h")
                        ->where('h.id = :id')
                        ->setParameter('id',$hotel->getId());;
                },
            ));
            $request = $this->getRequest();
            if($request->isMethod("POST")){
                $form->bind($request);
                if($form->isValid()){
                    $saison = $form->getData();
                    $em->persist($saison);
                    foreach($saison->getArrangements() as $arr){
                        if($arr->getArrangement()->getId() == $saison->getArrBase()->getId())
                            $em->remove($arr);
                    }
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("GeneralSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:general.html.twig',array(
                'hotel'  => $hotel,
                'saison' => $saison,
                'form'   => $form->createView(),
            ));
        }

        public function occChambreAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            foreach($saison->getHotel()->getChambres() as $ch){
                $verif = $em->getRepository("BackHotelTunisieBundle:SaisonChambre")->findBy(array('saison' => $saison,'chambre' => $ch));
                if(count($verif) == 0){
                    $saisonChambres = new SaisonChambre();
                    $saisonChambres->setChambre($ch);
                    $saison->addChambre($saisonChambres);
                }
            }
            $form = $this->createForm(new SaisonCType(),$saison);
            if($request->isMethod("POST")){
                $form->bind($request);
                if($form->isValid()){
                    $saison = $form->getData();
                    foreach($saison->getChambres() as $chambres){
                        $em->persist($chambres->setSaison($saison));
                    }
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("OccChambreSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:occ_chambres.html.twig',array(
                'hotel'  => $saison->getHotel(),
                'saison' => $saison,
                'form'   => $form->createView(),
            ));
        }

        public function arrangementAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            $hotel = $saison->getHotel();
            foreach($hotel->getArrangements() as $arr){
                $verif = $em->getRepository("BackHotelTunisieBundle:SaisonArrangement")->findBy(array('saison' => $saison,'arrangement' => $arr));
                if(count($verif) == 0 && $arr != $saison->getArrBase()){
                    $saisonArrangement = new SaisonArrangement();
                    $saisonArrangement->setArrangement($arr);
                    $saison->addArrangement($saisonArrangement);
                }
            }
            $form = $this->createForm(new SaisonAType(),$saison);
            if($request->isMethod("POST")){
                $form->handleRequest($request);
                if($form->isValid()){
                    $saison = $form->getData();
                    foreach($saison->getArrangements() as $Arrangement){
                        $em->persist($Arrangement->setSaison($saison));
                    }
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("ArrangementSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:arrangement.html.twig',array(
                'hotel'  => $hotel,
                'saison' => $saison,
                'form'   => $form->createView(),
            ));
        }

        public function reductionAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if($saison->getSaisonReduc())
                $saisonReduc = $saison->getSaisonReduc();
            else
                $saisonReduc = new SaisonReduc();
            $form = $this->createForm(new SaisonReducType(),$saisonReduc);
            $request = $this->getRequest();
            if($request->isMethod("POST")){
                $form->bind($request);
                if($form->isValid()){
                    $saisonReduc = $form->getData();
                    $em->persist($saisonReduc);
                    $em->persist($saison->setSaisonReduc($saisonReduc));
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("ReductionSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:reductions.html.twig',array(
                'hotel'  => $saison->getHotel(),
                'saison' => $saison,
                'form'   => $form->createView(),
            ));
        }

        public function supplementAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if($saison->getSaisonSupp() == NULL)
                $saisonSupp = new SaisonSupp();
            else
                $saisonSupp = $saison->getSaisonSupp();
            $form = $this->createForm(new SaisonSuppType(),$saisonSupp);
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $saisonSupp = $form->getData();
                    $em->persist($saisonSupp);
                    $em->persist($saison->setSaisonSupp($saisonSupp));
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("SupplementSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render("BackHotelTunisieBundle:Saisons:supplement.html.twig",array(
                'hotel'  => $saison->getHotel(),
                'saison' => $saison,
                'form'   => $form->createView(),
            ));
        }

        public function autreChambreAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            $hotel = $saison->getHotel();
            foreach($hotel->getChambres() as $ch){
                $verif = $em->getRepository("BackHotelTunisieBundle:SaisonSuppChambre")->findBy(array('saison' => $saison,'chambre' => $ch));
                if(count($verif) == 0 && $ch->getType() == 0){
                    $saisonSuppChambres = new SaisonSuppChambre();
                    $saisonSuppChambres->setChambre($ch);
                    $saison->addSuppChambre($saisonSuppChambres);
                }
            }
            $form = $this->createForm(new SaisonSType(),$saison);
            if($request->isMethod("POST")){
                $form->bind($request);
                if($form->isValid()){
                    $saison = $form->getData();
                    foreach($saison->getSuppChambres() as $chambres){
                        $em->persist($chambres->setSaison($saison));
                    }
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("AutreChambreSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:autre_chambre.html.twig',array(
                'saison' => $saison,
                'hotel'  => $hotel,
                'form'   => $form->createView(),
            ));
        }

        public function vueAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            $hotel = $saison->getHotel();
            foreach($hotel->getVues() as $vue){
                $verif = $em->getRepository("BackHotelTunisieBundle:SaisonVue")->findBy(array('saison' => $saison,'vue' => $vue));
                if(count($verif) == 0){
                    $saisonVue = new SaisonVue();
                    $saisonVue->setVue($vue);
                    $saison->addVue($saisonVue);
                }
            }
            $form = $this->createForm(new SaisonVType(),$saison);
            if($request->isMethod("POST")){
                $form->bind($request);
                if($form->isValid()){
                    $saison = $form->getData();
                    foreach($saison->getVues() as $Vue){
                        $em->persist($Vue->setSaison($saison));
                    }
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("VuesSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:vue.html.twig',array(
                'hotel'  => $hotel,
                'saison' => $saison,
                'form'   => $form->createView(),
            ));
        }

        public function weekendAction(Saison $saison)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if($saison->getSaisonWeekend() == NULL)
                $saisonWeekend = new SaisonWeekend();
            else
                $saisonWeekend = $saison->getSaisonWeekend();
            $form = $this->createForm(new SaisonWeekendType(),$saisonWeekend);
            $form->add("chambres","entity",array(
                'class'         => 'BackHotelTunisieBundle:Chambre',
                'query_builder' => function (EntityRepository $er) use ($saison){
                    return $er->createQueryBuilder('a')
                        ->join("a.hotels","h")
                        ->where('h.id = :id')
                        ->setParameter('id',$saison->getHotel()->getId());;
                },
                'multiple'      => TRUE,
                'expanded'      => FALSE,
            ));
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $saisonWeekend = $form->getData();
                    $em->persist($saisonWeekend);
                    $em->persist($saison->setSaisonWeekend($saisonWeekend));
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("WeekendSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render("BackHotelTunisieBundle:Saisons:weekend.html.twig",array(
                'saison' => $saison,
                'hotel'  => $saison->getHotel(),
                'form'   => $form->createView(),
            ));
        }

        public function autreSuppAction(Saison $saison,$id2)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if($id2 == NULL)
                $saisonAutreSupp = new SaisonAutreSupp();
            else
                $saisonAutreSupp = $em->getRepository("BackHotelTunisieBundle:SaisonAutreSupp")->find($id2);
            $saisonAutreSupp->setSaison($saison);
            $form = $this->createForm(new SaisonAutreSuppType(),$saisonAutreSupp);
            $request = $this->getRequest();
            if($request->isMethod("POST")){
                $form->submit($request);
                if($form->isValid()){
                    $saisonAutreSupp = $form->getData();
                    $em->persist($saisonAutreSupp);
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("AutreSuppSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:autre_supp.html.twig',array(
                'saison'          => $saison,
                'hotel'           => $saison->getHotel(),
                'form'            => $form->createView(),
                'saisonAutreSupp' => $saisonAutreSupp,
            ));
        }

        public function deleteAutreSuppAction(SaisonAutreSupp $saisonAutreSupp)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($saisonAutreSupp);
            $em->flush();
            $session->getFlashBag()->add('success',"Supplement a été suprimmée avec succées");
            return $this->redirect($this->generateUrl("AutreSuppSaison",array(
                'id' => $saisonAutreSupp->getSaison()->getId(),
            )));
        }

        public function autreReducAction(Saison $saison,$id2)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if($id2 == NULL)
                $saisonAutreReduc = new SaisonAutreReduc();
            else
                $saisonAutreReduc = $em->getRepository("BackHotelTunisieBundle:SaisonAutreReduc")->find($id2);
            $saisonAutreReduc->setSaison($saison);
            $form = $this->createForm(new SaisonAutreReducType(),$saisonAutreReduc);
            $request = $this->getRequest();
            if($request->isMethod("POST")){
                $form->submit($request);
                if($form->isValid()){
                    $saisonAutreReduc = $form->getData();
                    $em->persist($saisonAutreReduc);
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre saison de base a été modifié avec succées ");
                    return $this->redirect($this->generateUrl("AutreReducSaison",array('id' => $saison->getId())));
                }
            }
            return $this->render('BackHotelTunisieBundle:Saisons:autre_reduc.html.twig',array(
                'saison'           => $saison,
                'hotel'            => $saison->getHotel(),
                'form'             => $form->createView(),
                'saisonAutreReduc' => $saisonAutreReduc,
            ));
        }

        public function deleteAutreReducAction(SaisonAutreReduc $saisonAutreReduc)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($saisonAutreReduc);
            $em->flush();
            $session->getFlashBag()->add('success',"La réduction a été supprimée avec succées");
            return $this->redirect($this->generateUrl("AutreReducSaison",array(
                'id' => $saisonAutreReduc->getSaison()->getId(),
            )));
        }

        public function prixAction(Saison $saison)
        {
            return $this->render('BackHotelTunisieBundle:Saisons:prix.html.twig',array(
                'saison' => $saison,
                'hotel'  => $saison->getHotel(),
            ));
        }

        public function recupAction(Saison $saison)
        {
            return $this->render('BackHotelTunisieBundle:Saisons:recup.html.twig',array(
                'saison' => $saison,
            ));
        }

        public function generateFraisChambreAction(Saison $saison,Chambre $chambre)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $fraisChambre = $em->getRepository('BackHotelTunisieBundle:SaisonFraisChambre')->findOneBy(array('saison' => $saison,'chambre' => $chambre));
            if($fraisChambre)
                $session->getFlashBag()->add('info',"le frais de la chambre " . $chambre->getLibelle() . " existe déjà.");
            else{
                $session->getFlashBag()->add('success',"le frais de la chambre " . $chambre->getLibelle() . " a été ajoutée avec succées.");
                $fraisChambre = new SaisonFraisChambre();
                $em->persist($fraisChambre->setSaison($saison)->setChambre($chambre));
                $em->flush();
            }
            return $this->redirect($this->generateUrl('saison_frais_autre_chambre',array(
                'id'      => $saison->getId(),
                'chambre' => $fraisChambre->getId(),
            )));
        }

        public function fraisChambreAction(Saison $saison,SaisonFraisChambre $chambre)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $form = $this->createForm(new SaisonFraisChambreType(),$chambre);
            $reqest = $this->getRequest();
            if($reqest->isMethod('POST')){
                $form->submit($reqest);
                if($form->isValid()){
                    $chambre = $form->getData();
                    $em->persist($chambre);
                    $em->flush();
                    $session->getFlashBag()->add('success',"le frais de la chambre " . $chambre->getChambre()->getLibelle() . " a été ajoutée avec succées.");
                    return $this->redirect($this->generateUrl('saison_frais_autre_chambre',array(
                        'id'      => $saison->getId(),
                        'chambre' => $chambre->getId(),
                    )));
                }
            }
            $occChambre = $em->getRepository('BackHotelTunisieBundle:SaisonChambre')->findOneBy(array('saison' => $saison,'chambre' => $chambre->getChambre()));
            return $this->render('BackHotelTunisieBundle:Saisons:frais_autres_chambres.html.twig',array(
                'maxAdultes' => $occChambre->getMaxAdulte(),
                'hotel'      => $saison->getHotel(),
                'saison'     => $saison,
                'form'       => $form->createView(),
                'chambre'    => $chambre,
            ));
        }

        public function deleteFraisChambreAction(SaisonFraisChambre $chambre)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($chambre);
            $em->flush();
            $session->getFlashBag()->add('success',"Frais chambre a été suprimmée avec succées");
            return $this->redirect($this->generateUrl("AutreChambreSaison",array(
                'id' => $chambre->getSaison()->getId(),
            )));
        }
    }
