<?php

namespace EduSpeakBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use \DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="friendship")
 */
class Friendship
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="friendships")
     */
    protected $friends;

    /**
     * @ORM\Column(type="datetime", name="added_at")
     */
    protected $addedAt;

    /**
     * @ORM\Column(type="boolean", name="accepted")
     */
    protected $accepted;

    /**
     * @ORM\Column(type="boolean", name="blocked")
     */
    protected $blocked;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->friends = new ArrayCollection();
        $this->addedAt = new DateTime();
        $this->accepted = false;
        $this->blocked = false;
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
     * Get added at
     *
     * @return datetime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * Get accepted
     *
     * @return boolean
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set accepted
     *
     * @param boolean $accepted
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
    }

    /**
     * Get blocked
     *
     * @return boolean
     */
    public function getBlocked()
    {
        return $this->accepted;
    }

    /**
     * Set blocked
     *
     * @param boolean $blocked
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;
    }

    /**
     * Add friend
     *
     * @param User $friend
     *
     * @return Friendship
     */
    public function addFriend(User $friend)
    {
        if (!$this->hasFriend($friend)) {
            $this->friends->add($friend);
        }
        return $this;
    }

    /**
     * Remove friend
     *
     * @param User $friend
     *
     * @return Friendship
     */
    public function removeFriend(User $friend)
    {
        if ($this->hasFriend($friend)) {
            $this->friends->removeElement($friend);
        }
        return $this;
    }

    /**
     * Get friends
     *
     * @return Collection User
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * Has friend
     *
     * @param User $friend
     *
     * @return boolean
     */
    public function hasFriend(User $friend)
    {
        return $this->friends->contains($friend);
    }
}