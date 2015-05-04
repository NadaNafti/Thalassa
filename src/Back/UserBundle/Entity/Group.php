<?php

namespace Back\UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ost_group")
 */
class Group extends BaseGroup
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
     */
    private $users;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \Back\UserBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\Back\UserBundle\Entity\User $users)
    {
        $this->users[]=$users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Back\UserBundle\Entity\User $users
     */
    public function removeUser(\Back\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
