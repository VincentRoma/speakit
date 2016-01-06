<?php

namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use EduSpeakBundle\Entity\User as User;

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
     * @ORM\OneToMany(targetEntity="Session", mappedBy="discussion")
     */
    protected $sessions;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="discussions")
     */
    protected $participants;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->sessions = new ArrayCollection();
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
     * @param $session
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
     * @param $session
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
     * @param $participant
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
     * @param $participant
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
