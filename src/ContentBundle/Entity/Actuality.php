<?php

namespace ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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

    public function __construct()
    {
        $this->actuality_users = new ArrayCollection();
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
     * @return $link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Add actuality user
     *
     * @param $actuality_user
     *
     * @return Actuality
     */
    public function addActualityUser(User $actuality_user)
    {
        $this->actuality_users[] = $actuality_user;

        return $this;
    }

    /**
     * Remove actuality user
     *
     * @param $actuality_user
     */
    public function removeActualityUser(User $actuality_user)
    {
        $this->actuality_users->removeElement($actuality_user);
    }

    /**
     * Get actuality users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActualityUsers()
    {
        return $this->actuality_users;
    }
}