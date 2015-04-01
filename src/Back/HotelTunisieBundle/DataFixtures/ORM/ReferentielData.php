<?php

namespace Back\HotelTunisieBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Back\HotelTunisieBundle\Entity\Pays;
use Back\HotelTunisieBundle\Entity\Region;
use Back\HotelTunisieBundle\Entity\Categorie;
use Back\HotelTunisieBundle\Entity\Ville;
use Back\HotelTunisieBundle\Entity\Amenagement;
use Back\HotelTunisieBundle\Entity\TypeAmenagement;

use Back\HotelTunisieBundle\Entity\Arrangement;
use Back\HotelTunisieBundle\Entity\Chaine;
use Back\HotelTunisieBundle\Entity\Localisation;
use Back\HotelTunisieBundle\Entity\Optionn;
use Back\HotelTunisieBundle\Entity\Tag;
use Back\HotelTunisieBundle\Entity\Theme;
use Back\HotelTunisieBundle\Entity\Vue;
use Back\HotelTunisieBundle\Entity\Chambre;

class ReferentielData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $chambre = new Chambre();
        $manager->persist($chambre->setType(1)->setLibelle("Chambre Single"));
        $chambre = new Chambre();
        $manager->persist($chambre->setType(2)->setLibelle("Chambre Double"));
        $chambre = new Chambre();
        $manager->persist($chambre->setType(3)->setLibelle("Chambre Triple"));
        $chambre = new Chambre();
        $manager->persist($chambre->setType(4)->setLibelle("Chambre Quadruple"));
        
        $vue = new Vue();
        $manager->persist($vue->setLibelle("Vue mer"));
        $vue = new Vue();
        $manager->persist($vue->setLibelle("Vue piscine"));
        $vue = new Vue();
        $manager->persist($vue->setLibelle("Vue jardin"));
        $vue = new Vue();
        $manager->persist($vue->setLibelle("Vue jardin & mer"));
        
        $theme= new Theme();
        $manager->persist($theme->setLibelle("Afrique"));
        $theme= new Theme();
        $manager->persist($theme->setLibelle("Jeunesse"));
        $theme= new Theme();
        $manager->persist($theme->setLibelle("Affaire"));
        
        $tag = new Tag();
        $manager->persist($tag->setLibelle("Plage"));
        $tag = new Tag();
        $manager->persist($tag->setLibelle("De noce"));
        $tag = new Tag();
        $manager->persist($tag->setLibelle("Piscine"));
        $tag = new Tag();
        $manager->persist($tag->setLibelle("Fôret"));
        
        $option = new Optionn();
        $manager->persist($option->setLibelle("Option 1"));
        $option = new Optionn();
        $manager->persist($option->setLibelle("Option 2"));
        
        $localisation = new Localisation();
        $manager->persist($localisation->setLibelle("Zone touristique"));
        $localisation = new Localisation();
        $manager->persist($localisation->setLibelle("Cenre ville"));
        $localisation = new Localisation();
        $manager->persist($localisation->setLibelle("Compagne"));
        
        $chaine = new Chaine();
        $manager->persist($chaine->setLibelle("Costa croisiére"));
        $chaine = new Chaine();
        $manager->persist($chaine->setLibelle("Hôtel nozha beach"));
        
        $arr= new Arrangement();
        $manager->persist($arr->setCode("LPD")->setLibelle("Logement Petit déjeuner"));
        $arr= new Arrangement();
        $manager->persist($arr->setCode("DP")->setLibelle("Demi Pension"));
        $arr= new Arrangement();
        $manager->persist($arr->setCode("ALL")->setLibelle("All inclusive"));
        $arr= new Arrangement();
        $manager->persist($arr->setCode("PC")->setLibelle("Pension Complet"));
        
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
        $manager->persist($categorie  ->setLibelle("2 étoiles")->setNombreEtoiles(2));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("3 étoiles")->setNombreEtoiles(3));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("4 étoiles")->setNombreEtoiles(4));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("5 étoiles")->setNombreEtoiles(5));
        $categorie= new Categorie();
        $manager->persist($categorie  ->setLibelle("5 étoiles de lux")->setNombreEtoiles(5));
        
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

        $typeAmenagement=new TypeAmenagement();
        $manager->persist($typeAmenagement->setLibelle("Vue"));
        $typeAmenagement1=new TypeAmenagement();
        $manager->persist($typeAmenagement1->setLibelle("Restauration"));
        $typeAmenagement2=new TypeAmenagement();
        $manager->persist($typeAmenagement2->setLibelle("En extérieur"));
        
        $Amenagement= new Amenagement();
        $manager->persist($Amenagement->setLibelle("Vue sur la ville")->setTypeAmenagement($typeAmenagement));
        $Amenagement= new Amenagement();
        $manager->persist($Amenagement->setLibelle("Vue mer + piscine + balcon")->setTypeAmenagement($typeAmenagement));
        $Amenagement= new Amenagement();
        $manager->persist($Amenagement->setLibelle("Vue jardin + Terrasse")->setTypeAmenagement($typeAmenagement));
        $Amenagement= new Amenagement();
        $manager->persist($Amenagement->setLibelle("Salon de thé")->setTypeAmenagement($typeAmenagement1));
        $Amenagement= new Amenagement();
        $manager->persist($Amenagement->setLibelle("Restaurant à la carte")->setTypeAmenagement($typeAmenagement1));
        $Amenagement= new Amenagement();
        $manager->persist($Amenagement->setLibelle("Installation barbecue")->setTypeAmenagement($typeAmenagement2));
        $Amenagement= new Amenagement();
        $manager->persist($Amenagement->setLibelle("terrains de volley-ball")->setTypeAmenagement($typeAmenagement2));
        
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
