<?php

namespace Back\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\GroupableInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="ost_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Client", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity="Back\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="ost_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->groups=new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set client
     *
     * @param \Back\UserBundle\Entity\Client $client
     * @return User
     */
    public function setClient(\Back\UserBundle\Entity\Client $client=null)
    {
        $this->client=$client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Back\UserBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    public function __toString()
    {
        if(is_null($this->client))
            return $this->username;
        else
            return $this->client->getNomPrenom();
    }
}
