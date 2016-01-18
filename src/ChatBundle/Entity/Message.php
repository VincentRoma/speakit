<?php

// src/ChatBundle/Entity/Message.php
namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;

/**
 * @ORM\Entity
 * @ORM\Table(name="message")
 * @ORM\HasLifecycleCallbacks
 */
class Message extends EduAbstract
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="session")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    protected $language;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="session")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    protected $session;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->language = new \Doctrine\Common\Collections\ArrayCollection();
        $this->session = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set content
     *
     * @param string $content
     *
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set language
     *
     * @param \ChatBundle\Entity\Session $language
     *
     * @return Message
     */
    public function setLanguage(\ChatBundle\Entity\Session $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \ChatBundle\Entity\Session
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set session
     *
     * @param \ChatBundle\Entity\Session $session
     *
     * @return Message
     */
    public function setSession(\ChatBundle\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \ChatBundle\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }
}
