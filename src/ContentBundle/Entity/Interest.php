<?php

namespace ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use EduSpeakBundle\Entity\User as User;

/**
 * @ORM\Entity
 * @ORM\Table(name="interest")
 */
class Interest
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="interests")
     */
    protected $interested_users;

    public function __construct()
    {
        $this->interested_users = new ArrayCollection();
    }

    /**
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Add interested user
     *
     * @param $interested_user
     *
     * @return Interest
     */
    public function addInterestedUser(User $interested_user)
    {
        $this->interested_users[] = $interested_user;

        return $this;
    }

    /**
     * Remove interested user
     *
     * @param $interested_user
     */
    public function removeInterestedUser(User $interested_user)
    {
        $this->interested_users->removeElement($interested_user);
    }

    /**
     * Get interested users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterestedUsers()
    {
        return $this->interested_users;
    }
}