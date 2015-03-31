<?php

namespace Back\HotelTunisieBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Back\CommercialBundle\Entity\Fournisseur;
use Back\CommercialBundle\Entity\Contact;

class FixtureData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fournisseur=new Fournisseur();
        $manager->persist($fournisseur->setLibelle("Costa croisiére"));
        $fournisseur1=new Fournisseur();
        $manager->persist($fournisseur1->setLibelle("Al Hambra"));
        $fournisseur2=new Fournisseur();
        $manager->persist($fournisseur2->setLibelle("Hotel nozha beach"));
        
        $contact= new Contact();
        $manager->persist($contact->setEmail("zied.kharraz@gmail.com")->setFonction("Directeur")->setNomPrenom("Zied Kharraz")->setFournisseur($fournisseur));
        $contact= new Contact();
        $manager->persist($contact->setEmail("contact@gmail.com")->setFonction("Commercial")->setNomPrenom("Foulen ben foulen")->setFournisseur($fournisseur1));
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

}
