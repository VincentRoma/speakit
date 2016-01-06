<?php

// src/ChatBundle/Entity/Discussion.php
namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
     * @ORM\OneToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="discussion")
     */
    protected $participants;

    /**
     * @ORM\OneToMany(targetEntity="Session", mappedBy="discussion")
     */
    protected $sessions;
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
     * Add participant
     *
     * @param \ChatBundle\Entity\User $participant
     *
     * @return Discussion
     */
    public function addParticipant(\ChatBundle\Entity\User $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \ChatBundle\Entity\User $participant
     */
    public function removeParticipant(\ChatBundle\Entity\User $participant)
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

    /**
     * Add session
     *
     * @param \ChatBundle\Entity\Session $session
     *
     * @return Discussion
     */
    public function addSession(\ChatBundle\Entity\Session $session)
    {
        $this->sessions[] = $session;

        return $this;
    }

    /**
     * Remove session
     *
     * @param \ChatBundle\Entity\Session $session
     */
    public function removeSession(\ChatBundle\Entity\Session $session)
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
}
