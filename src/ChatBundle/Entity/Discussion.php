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
     * @ORM\OneToMany(targetEntity="ChatBundle\Entity\Discussion", mappedBy="discussion")
     */
    protected $messages;

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
        $this->messages = new ArrayCollection();
    }

    /**
     * Constructor
     */
    public function toArray()
    {
        return 'bite';
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
     * @param Message $message
     *
     * @return Discussion
     */
    public function addMessage(Message $message)
    {
        if (!$this->hasSession($message)) {
            $this->messages->add($message);
        }
        return $this;
    }

    /**
     * Remove message
     *
     * @param Message $message
     *
     * @return Discussion
     */
    public function removeMessage(Message $message)
    {
        if ($this->hasSession($message)) {
            $this->messages->removeElement($message);
        }
        return $this;
    }

    /**
     * Get messages
     *
     * @return Collection Message
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Has message
     *
     * @param Message $message
     *
     * @return boolean
     */
    public function hasSession(Message $message)
    {
        return $this->messages->contains($message);
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
