<?php
    namespace Back\GeneralBundle\Twig\Extension;

    use Doctrine\ORM\EntityManager;
    use Symfony\Component\DependencyInjection\Container;

    class InterfacesExtension extends \Twig_Extension
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
                'getStars'               => new \Twig_Function_Method($this,'getStars'),
                'differenceBetweenDates' => new \Twig_Function_Method($this,'differenceBetweenDates'),
                'functionTeste2'         => new \Twig_Function_Method($this,'getTeste2'),
                'getAgence'              => new \Twig_Function_Method($this,'getAgence'),
            );
        }

        public function getAgence()
        {
            return $this->em->find('BackAdministrationBundle:Agence',1);
        }

        public function getStars($num)
        {
            if(is_numeric($num)){
                $stars = "";
                for($i = 1;$i <= $num;$i++)
                    $stars .= '<i class="fa fa-star fa fa-white"></i>';
                return $stars;
            } else
                return $num;
        }

        public function differenceBetweenDates($date)
        {
            $start_date = $date;
            $since_start = $start_date->diff(new \DateTime());
            if($since_start->y == 1)
                return $since_start->y . ' Année';
            if($since_start->y != 0)
                return $since_start->y . ' Années';
            if($since_start->m == 1)
                return $since_start->m . ' Moi';
            if($since_start->m != 0)
                return $since_start->m . ' Mois';
            if($since_start->d == 1)
                return $since_start->d . ' Jour';
            if($since_start->d != 0)
                return $since_start->d . ' Jours';
            if($since_start->h == 1)
                return $since_start->h . ' Heure';
            if($since_start->h != 0)
                return $since_start->h . ' Heures';
            if($since_start->i == 1)
                return $since_start->i . ' Minute';
            if($since_start->i != 0)
                return $since_start->i . ' Minutes';
            return $since_start->s . ' Secondes';
        }

        public function getName()
        {
            return 'SdzAntispam';
        }
        // …
    }
