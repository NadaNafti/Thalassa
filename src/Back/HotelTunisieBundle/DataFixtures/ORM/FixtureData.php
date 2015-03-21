<?php

namespace Back\HotelTunisieBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Back\HotelTunisieBundle\Entity\Pays;
use Back\HotelTunisieBundle\Entity\Region;
use Back\HotelTunisieBundle\Entity\Categorie;
use Back\HotelTunisieBundle\Entity\Ville;
class FixtureData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $pays1 = new Pays();
        $manager->persist($pays1->setCode("tn")->setLibelle("Tunisie")->setSlug("tunisie"));
        $pays2 = new Pays();
        $manager->persist($pays2->setCode("fr")->setLibelle("France")->setSlug("france"));
        $pays3 = new Pays();
        $manager->persist($pays3->setCode("mc")->setLibelle("Maroc")->setSlug("maroc"));
        $pays4 = new Pays();
        $manager->persist($pays4->setCode("al")->setLibelle("Algerie")->setSlug("algerie"));
        
        $region1= new Region();
        $manager->persist($region1 ->setLibelle("Nord"));
        $region2= new Region();
        $manager->persist($region2 ->setLibelle("Sud"));
        $region3= new Region();
        $manager->persist($region3 ->setLibelle("Capbon"));
        
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("2 étoiles"));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("3 étoiles"));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("4 étoiles"));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("5 étoiles"));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("5 étoiles de lux"));
        
        $ville= new Ville();
        $manager->persist($ville->setPays($pays1)->setRegion($region3)->setLibelle("Nabeul"));
        $ville= new Ville();
        $manager->persist($ville->setPays($pays1)->setRegion($region3)->setLibelle("Hammamet"));
        $ville= new Ville();
        $manager->persist($ville->setPays($pays1)->setRegion($region3)->setLibelle("Manzel tmim"));
        $ville= new Ville();
        $manager->persist($ville->setPays($pays1)->setRegion($region1)->setLibelle("Tunis"));
        $ville= new Ville();
        $manager->persist($ville->setPays($pays2)->setRegion($region1)->setLibelle("Paris"));

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}
