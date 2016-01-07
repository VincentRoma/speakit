<?php

namespace ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EduSpeakBundle\Entity\User as User;

/**
 * @ORM\Entity
 * @ORM\Table(name="actuality")
 */
class Actuality
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
     * @ORM\Column(type="string", length=500)
     */
    protected $link;

    /**
     * @ORM\ManyToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="actualities")
     */
    protected $actuality_users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actuality_users = new ArrayCollection();
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
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set link
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Add actuality user
     *
     * @param User $actuality_user
     *
     * @return Actuality
     */
    public function addActualityUser(User $actuality_user)
    {
        if (!$this->hasActualityUser($actuality_user)) {
            $this->actuality_users->add($actuality_user);
        }
        return $this;
    }

    /**
     * Remove actuality user
     *
     * @param User $actuality_user
     *
     * @return Actuality
     */
    public function removeActualityUser(User $actuality_user)
    {
        if ($this->hasActualityUser($actuality_user)) {
            $this->actuality_users->removeElement($actuality_user);
        }
        return $this;
    }

    /**
     * Get actuality users
     *
     * @return Collection User
     */
    public function getActualityUsers()
    {
        return $this->actuality_users;
    }

    /**
     * Has actuality user
     *
     * @param User $actuality_user
     *
     * @return boolean
     */
    public function hasActualityUser(User $actuality_user)
    {
        return $this->actuality_users->contains($actuality_user);
    }
}