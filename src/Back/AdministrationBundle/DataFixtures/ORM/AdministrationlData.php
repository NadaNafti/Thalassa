<?php

namespace Back\HotelTunisieBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Back\AdministrationBundle\Entity\Produit;
use Back\AdministrationBundle\Entity\Amicale;

class AdministrationlData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $produit1 = new Produit();
        $manager->persist($produit1->setCode("SHT")->setLibelle("Séjour hôtel en tunisie"));
        $produit2 = new Produit();
        $manager->persist($produit2->setCode("SHM")->setLibelle("Séjour hôtel dans le monde"));
        $produit = new Produit();
        $manager->persist($produit->setCode("VO")->setLibelle("Voyage organisé"));
        $produit = new Produit();
        $manager->persist($produit->setCode("CR")->setLibelle("Croisiére"));
        $produit = new Produit();
        $manager->persist($produit->setCode("BE")->setLibelle("Bien ètre"));
        $produit = new Produit();
        $manager->persist($produit->setCode("P")->setLibelle("Programme"));
        
        $amicale=new Amicale();
        $manager->persist($amicale->setLibelle("Banque Tunisie")->setAdresse("tunis centre ville")->setFax("71 321 654")->setPlafond(50000)->setMontant(0)->setTel("72 321 654")->addProduit($produit1)->addProduit($produit2));
        $amicale=new Amicale();
        $manager->persist($amicale->setLibelle("Douane")->setAdresse("tunis centre ville")->setFax("71 321 654")->setPlafond(75000)->setMontant(0)->setTel("72 321 654")->addProduit($produit1));
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }

}
