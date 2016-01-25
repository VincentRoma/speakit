<?php

namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use GeoBundle\Entity\Language as Language;
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
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\Language", inversedBy="messages")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    protected $language;

    /**
     * @ORM\ManyToOne(targetEntity="Discussion", inversedBy="messages")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    protected $discussion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->language = new ArrayCollection();
        $this->discussion = new ArrayCollection();
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
     */
    public function setContent($content)
    {
        $this->content = $content;
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
     * @param Language $language
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set discussion
     *
     * @param Discussion $discussion
     */
    public function setDiscussion(Discussion $discussion = null)
    {
        $this->discussion = $discussion;
    }

    /**
     * Get discussion
     *
     * @return Discussion
     */
    public function getDiscussion()
    {
        return $this->discussion;
    }
}
