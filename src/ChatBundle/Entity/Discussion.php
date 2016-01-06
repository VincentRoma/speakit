<?php

// src/ChatBundle/Entity/Discussion.php
namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EduSpeakBundle\Entity\User as User;

/**
 * @ORM\Entity(repositoryClass="ChatBundle\Entity\DiscussionRepository")
 * @ORM\Table(name="discussion")
 */
class Discussion
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Session", mappedBy="discussion")
     */
    protected $sessions;

    /**
     * @ORM\ManyToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="discussions")
     */
    protected $participants;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add session
     *
     * @param \ChatBundle\Entity\Session $session
     *
     * @return Discussion
     */
    public function addSession(Session $session)
    {
        $this->sessions[] = $session;

        return $this;
    }

    /**
     * Remove session
     *
     * @param \ChatBundle\Entity\Session $session
     */
    public function removeSession(Session $session)
    {
        $this->sessions->removeElement($session);
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

    /**
     * Add participant
     *
     * @param User $participant
     *
     * @return Discussion
     */
    public function addParticipant(User $participant)
    {
        $this->participants->add($participant);
        return $this;
    }

    /**
     * Remove participant
     *
     * @param User $participant
     */
    public function removeParticipant(User $participant)
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }
}
