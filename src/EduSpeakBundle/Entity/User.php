<?php
// src/EduSpeakBundle/Entity/User.php

namespace EduSpeakBundle\Entity;

use ChatBundle\Entity\Discussion as Discussion;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="ChatBundle\Entity\Discussion", inversedBy="participants")
     * @ORM\JoinTable(name="participants_discussions")
     */
    protected $discussions;

    public function __construct()
    {
        parent::__construct();
        $this->discussions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add discussion
     *
     * @param Discussion $discussion
     *
     * @return User
     */
    public function addDiscussion(Discussion $discussion)
    {
        $this->discussions->add($discussion);

        return $this;
    }

    /**
     * Remove discussion
     *
     * @param Discussion $discussion
     */
    public function removeDiscussion(Discussion $discussion)
    {
        $this->discussions->removeElement($discussion);
    }

    /**
     * Get discussions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiscussions()
    {
        return $this->discussions;
    }
}
