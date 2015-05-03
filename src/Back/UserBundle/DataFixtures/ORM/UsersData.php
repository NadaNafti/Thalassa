<?php
namespace Back\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Back\UserBundle\Entity\User;
use Back\UserBundle\Entity\Group;

class UsersData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $utilisateur1 = new User();
        $utilisateur1   ->setUsername('admin')
                        ->setEmail('admin@gmail.com')
                        ->setEnabled(1)
                        ->addRole("ROLE_ADMIN")
                        ->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur1)->encodePassword('admin', $utilisateur1->getSalt()));
        $manager->persist($utilisateur1);
        
        $utilisateur2 = new User();
        $utilisateur2   ->setUsername('user')
                        ->setEmail('user@gmail.com')
                        ->setEnabled(1)
                        ->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur2)->encodePassword('user', $utilisateur2->getSalt()));
        $manager->persist($utilisateur2);
        
        $utilisateur3 = new User();
        $utilisateur3   ->setUsername('super')
                        ->setEmail('super@gmail.com')
                        ->setEnabled(1)
                        ->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur3)->encodePassword('super', $utilisateur3->getSalt()));
        
        $group = new Group("Super Admin");
        $group->addRole("ROLE_SUPER_ADMIN");
        $manager->persist($group);
        $manager->persist($utilisateur3->addGroup($group));
       
        $manager->flush();
        $this->addReference('utilisateur1', $utilisateur1);
        $this->addReference('utilisateur2', $utilisateur2);
    }
    
    public function getOrder()
    {
        return 1;
    }
}