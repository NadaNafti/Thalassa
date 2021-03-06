<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Back\GeneralBundle\BackGeneralBundle(),
            new Back\UserBundle\BackUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Back\HotelTunisieBundle\BackHotelTunisieBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Back\CommercialBundle\BackCommercialBundle(),
            new Back\AdministrationBundle\BackAdministrationBundle(),
            new Back\VoyageOrganiseBundle\BackVoyageOrganiseBundle(),
            new Front\GeneralBundle\FrontGeneralBundle(),
            new Front\ConfigBundle\FrontConfigBundle(),
            new Back\ProgrammeBundle\BackProgrammeBundle(),
            new EspaceClientBundle\EspaceClientBundle(),
            new Back\BienEtreBundle\BackBienEtreBundle(),
            new Back\BilletterieMaritimeBundle\BackBilletterieMaritimeBundle(),
            new Back\CaisseBundle\BackCaisseBundle(),
            new Back\ResaBookingBundle\BackResaBookingBundle(),
            new Back\TransfertBundle\BackTransfertBundle(),
            new Back\ReservationDiversBundle\BackReservationDiversBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new CoreSphere\ConsoleBundle\CoreSphereConsoleBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
