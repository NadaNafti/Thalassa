<?php
    namespace Back\HotelTunisieBundle\Twig\Extension;

    use Doctrine\ORM\EntityManager;
    use Symfony\Component\DependencyInjection\Container;
    use Back\HotelTunisieBundle\Entity\SaisonAutreSupp;

    class SaisonExtension extends \Twig_Extension
    {
        protected $em;

        protected $container;

        public function __construct(EntityManager $em,Container $container)
        {
            $this->em = $em;
            $this->container = $container;
        }

        public function getFunctions()
        {
            return array(
                'verifSuppReducDate' => new \Twig_Function_Method($this,'verifSuppReducDate'),
                'isFraisChambre'     => new \Twig_Function_Method($this,'isFraisChambre'),
            );
        }

        public function verifSuppReducDate($suppReduc,$date1,$date2)
        {
            $dates = $this->container->get('library')->getDatesBetween($date1->format('Y-m-d'),$date2->format('Y-m-d'));
            $dates2 = $this->container->get('library')->getDatesBetween($suppReduc->getDateFin(date('Y')),$suppReduc->getDateDebut(date('Y')));
            foreach($dates as $date){
                foreach($dates2 as $date2){
                    if($date == $date2)
                        return TRUE;
                }
            }
            return FALSE;
        }

        public function isFraisChambre($idSaison,$ch)
        {
            $saison=$this->em->find('BackHotelTunisieBundle:Saison',$idSaison);
            foreach($saison->getFraisChambres() as $frais)
            {
                if($frais->getChambre()->getId() == $ch)
                    return 'true';
            }
            return 'false';
        }

        public function getName()
        {
            return 'FunctionExtension';
        }
    }
