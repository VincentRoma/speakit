<?php

namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EduSpeakBundle\Entity\User as User;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;

/**
 * @ORM\Entity
 * @ORM\Table(name="discussion")
 * @ORM\HasLifecycleCallbacks
 */
class Discussion extends EduAbstract
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ChatBundle\Entity\Session", mappedBy="discussion")
     */
    protected $sessions;

    /**
     * @ORM\ManyToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="discussions")
     */
    protected $participants;

    /**
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\City", inversedBy="discussions")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @ORM\Column(type="text")
     */
    protected $token;


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
     * @param Session $session
     *
     * @return Discussion
     */
    public function addSession(Session $session)
    {
        if (!$this->hasSession($session)) {
            $this->sessions->add($session);
        }
        return $this;
    }

    /**
     * Remove session
     *
     * @param Session $session
     *
     * @return Discussion
     */
    public function removeSession(Session $session)
    {
        if ($this->hasSession($session)) {
            $this->sessions->removeElement($session);
        }
        return $this;
    }

    /**
     * Get sessions
     *
     * @return Collection Session
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Has session
     *
     * @param Session $session
     *
     * @return boolean
     */
    public function hasSession(Session $session)
    {
        return $this->sessions->contains($session);
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
        if (!$this->hasParticipant($participant)) {
            $this->participants->add($participant);
        }
        return $this;
    }

    /**
     * Remove participant
     *
     * @param User $participant
     *
     * @return Discussion
     */
    public function removeParticipant(User $participant)
    {
        if ($this->hasParticipant($participant)) {
            $this->participants->removeElement($participant);
        }
        return $this;
    }

    /**
     * Get participants
     *
     * @return Collection User
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Has participant
     *
     * @param User $participant
     *
     * @return boolean
     */
    public function hasParticipant(User $participant)
    {
        return $this->participants->contains($participant);
    }

    /**
     * Set city
     *
     * @param \GeoBundle\Entity\City $city
     *
     * @return Discussion
     */
    public function setCity(\GeoBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \GeoBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Discussion
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
