<?php

namespace Back\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\GroupableInterface;

/**
 * @ORM\Entity(repositoryClass="Back\UserBundle\Entity\Repository\UserRepository")
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
     * @ORM\ManyToOne(targetEntity="Back\AdministrationBundle\Entity\PointVente", inversedBy="users")
     */
    private $pointVente;
    
    /**
     * @ORM\OneToMany(targetEntity="Back\CaisseBundle\Entity\SessionCaisse", mappedBy="user")
     */
    private $sessions;

    /**
     * Constructor
     */
    
    
    public function __construct()
    {
        parent::__construct();
        $this->groups=new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessions=new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getLastSession()
    {
        if(count($this->sessions)==0)
            return null;
        return $this->sessions->last();
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

    
    /**
     * Set pointVente
     *
     * @param \Back\AdministrationBundle\Entity\PointVente $pointVente
     * @return User
     */
    public function setPointVente(\Back\AdministrationBundle\Entity\PointVente $pointVente = null)
    {
        $this->pointVente = $pointVente;

        return $this;
    }

    /**
     * Get pointVente
     *
     * @return \Back\AdministrationBundle\Entity\PointVente 
     */
    public function getPointVente()
    {
        return $this->pointVente;
    }

    /**
     * Add sessions
     *
     * @param \Back\CaisseBundle\Entity\SessionCaisse $sessions
     * @return User
     */
    public function addSession(\Back\CaisseBundle\Entity\SessionCaisse $sessions)
    {
        $this->sessions[] = $sessions;

        return $this;
    }

    /**
     * Remove sessions
     *
     * @param \Back\CaisseBundle\Entity\SessionCaisse $sessions
     */
    public function removeSession(\Back\CaisseBundle\Entity\SessionCaisse $sessions)
    {
        $this->sessions->removeElement($sessions);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSessions()
    {
        return $this->sessions;
    }
    
    public function sessionOuverte()
    {
        if($this->sessions->isEmpty())
            return false;
        return $this->sessions->last()->isOpen();
    }
}
