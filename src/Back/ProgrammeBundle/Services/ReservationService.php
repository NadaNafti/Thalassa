<?php
    namespace Back\ProgrammeBundle\Services;

    use Doctrine\ORM\EntityManager;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\DependencyInjection\Container;
    use Back\UserBundle\Entity\Client;
    use Back\ProgrammeBundle\Entity\Reservation;
    use Back\ProgrammeBundle\Entity\ReservationLigne;
    use Back\ProgrammeBundle\Entity\ReservationPersonne;
    use Back\ProgrammeBundle\Entity\Periode;

    class ReservationService
    {
        protected $em;

        protected $session;

        protected $container;

        protected $mailer;

        protected $templating;

        public function __construct(EntityManager $em,Session $session,Container $container,\Swift_Mailer $mailer,$templating)
        {
            $this->em = $em;
            $this->session = $session;
            $this->container = $container;
            $this->mailer = $mailer;
            $this->templating = $templating;
        }

        public function saveReservation(Periode $periode,Client $client,$data,$source)
        {
            $supplements = array();
            $coordoonnes = array($client->getNomPrenom(),$client->getTel1(),$client->getTel2(),$client->getAdresse());
            $tarifCommercial = $this->em->getRepository('BackCommercialBundle:Tarif')->find(1);
            $reservation = new Reservation();
            $reservation->setClient($client)
                ->setCoordonnees($coordoonnes)
                ->setEtat(1)
                ->setPeriode($periode)
                ->setProgramme($periode->getProgramme());
            if($tarifCommercial && $tarifCommercial->getTimbre())
                $reservation->setTimbre($tarifCommercial->getMontantTimbre());
            if($source == 'frontoffice')
                $reservation->setFrontOffice(TRUE);
            $this->em->persist($reservation);
            $x = 0;
            $nbrAdulte = $data['adultes'];
            $nbrEnfant = $data['enfants'];
            for($i = 1;$i <= $nbrAdulte;$i++){
                $reservationPersonne = new ReservationPersonne();
                $reservationPersonne->setReservationA($reservation)
                    ->setNomPrenom($data['Anom_' . $i])
                    ->setPassport($data['Apassport_' . $i]);
                $this->em->persist($reservationPersonne);
                $reservationLigne = new ReservationLigne();
                $reservationLigne->setPersonne($reservationPersonne)
                    ->setLibelle('Prix Adulte')
                    ->setCode('PrixAdulte')
                    ->setAchat($periode->getPrixAdulteAchat())
                    ->setVente($periode->getPrixAdulteVente());
                $this->em->persist($reservationLigne);
                foreach($periode->getSupplements() as $supp){
                    if($supp->getObligatoire() || isset($data['supplement' . $supp->getId()])){
                        if($i == 1)
                            $supplements[] = $supp->getId();
                        $reservationLigne = new ReservationLigne();
                        $reservationLigne->setPersonne($reservationPersonne)
                            ->setLibelle($supp->getLibelle())
                            ->setCode('SupplementAdulte')
                            ->setAchat($supp->getAdulteAchat())
                            ->setVente($supp->getAdulteVente());
                        $this->em->persist($reservationLigne);
                    }
                }
            }
            for($i = 1;$i <= $nbrEnfant;$i++){
                $reservationPersonne = new ReservationPersonne();
                $reservationPersonne->setReservationE($reservation)
                    ->setNomPrenom($data['Enom_' . $i])
                    ->setPassport($data['Epassport_' . $i])
                    ->setAge($data['Eage_' . $i]);
                $this->em->persist($reservationPersonne);
                $reservationLigne = new ReservationLigne();
                $reservationLigne->setPersonne($reservationPersonne)
                    ->setLibelle('Prix Enfant')
                    ->setCode('PrixEnfant')
                    ->setAchat($periode->getPrixEnfantAchat())
                    ->setVente($periode->getPrixEnfantVente());
                $this->em->persist($reservationLigne);
                foreach($periode->getSupplements() as $supp){
                    if($supp->getObligatoire() || isset($data['supplement' . $supp->getId()])){
                        if($i == 1)
                            $supplements[] = $supp->getId();
                        $reservationLigne = new ReservationLigne();
                        $reservationLigne->setPersonne($reservationPersonne)
                            ->setLibelle($supp->getLibelle())
                            ->setCode('SupplementEnfant')
                            ->setAchat($supp->getEnfantAchat())
                            ->setVente($supp->getEnfantVente());
                        $this->em->persist($reservationLigne);
                    }
                }
            }
            $this->em->persist($reservation->setSupplements($supplements));
            $this->em->flush();
            return $reservation->getId();
        }
    }
