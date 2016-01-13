<?php

// src/ChatBundle/Entity/Session.php
namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;

/**
 * @ORM\Entity
 * @ORM\Table(name="session")
 * @ORM\HasLifecycleCallbacks
 */
class Session extends EduAbstract
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ChatBundle\Entity\Message", mappedBy="session")
     */
    protected $messages;

    /**
     * @ORM\ManyToOne(targetEntity="Discussion", inversedBy="discussion")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     */
    protected $discussion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->discussion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add message
     *
     * @param \ChatBundle\Entity\Message $message
     *
     * @return Session
     */
    public function addMessage(\ChatBundle\Entity\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \ChatBundle\Entity\Message $message
     */
    public function removeMessage(\ChatBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set discussion
     *
     * @param \ChatBundle\Entity\Discussion $discussion
     *
     * @return Session
     */
    public function setDiscussion(\ChatBundle\Entity\Discussion $discussion = null)
    {
        $this->discussion = $discussion;

        return $this;
    }

    /**
     * Get discussion
     *
     * @return \ChatBundle\Entity\Discussion
     */
    public function getDiscussion()
    {
        return $this->discussion;
    }
}
