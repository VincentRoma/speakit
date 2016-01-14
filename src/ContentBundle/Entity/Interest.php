<?php

namespace ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EduSpeakBundle\Entity\User as User;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;

/**
 * @ORM\Entity
 * @ORM\Table(name="interest")
 * @ORM\HasLifecycleCallbacks
 */
class Interest extends EduAbstract
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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->interested_users = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Add interested user
     *
     * @param User $interested_user
     *
     * @return Interest
     */
    public function addInterestedUser(User $interested_user)
    {
        if (!$this->hasInterestedUser($interested_user)) {
            $this->interested_users->add($interested_user);
        }
        return $this;
    }

    /**
     * Remove interested user
     *
     * @param User $interested_user
     *
     * @return Interest
     */
    public function removeInterestedUser(User $interested_user)
    {
        if ($this->hasInterestedUser($interested_user)) {
            $this->interested_users->removeElement($interested_user);
        }
        return $this;
    }

    /**
     * Get interested users
     *
     * @return Collection User
     */
    public function getInterestedUsers()
    {
        return $this->interested_users;
    }

    /**
     * Has interested user
     *
     * @param User $interested_user
     *
     * @return boolean
     */
    public function hasInterestedUser(User $interested_user)
    {
        return $this->interested_users->contains($interested_user);
    }
}
