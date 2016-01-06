<?php

namespace EduSpeakBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="honor")
     * @ORM\JoinColumn(name="id_user1", referencedColumnName="id")
     */
    protected $user1;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="friend")
     * @ORM\JoinColumn(name="id_user2", referencedColumnName="id")
     */
    protected $user2;

    /**
     * @ORM\Column(type="datetime", name="added_at")
     */
    protected $addedAt;

    /**
     * @ORM\Column(type="boolean", name="accepted")
     */
    protected $accepted;

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
     * @return $user1
     */
    public function getUser1()
    {
        return $this->user1;
    }

    /**
     * @param $user1
     */
    public function setUser1($user1)
    {
        $this->user1 = $user1;
    }

    /**
     * @return $user2
     */
    public function getUser2()
    {
        return $this->user2;
    }

    /**
     * @param $user2
     */
    public function setUser2($user2)
    {
        $this->user2 = $user2;
    }

    /**
     * @return $addedAt
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * @param $addedAt
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;
    }

    /**
     * @return $accepted
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * @param $accepted
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addedAt = new DateTime();
        $this->accepted = false;
    }
}