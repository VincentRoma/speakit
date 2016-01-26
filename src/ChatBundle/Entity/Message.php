<?php

namespace ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use GeoBundle\Entity\Language as Language;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use EduSpeakBundle\Entity\User as User;

/**
 * @ORM\Entity
 * @ORM\Table(name="message")
 * @ORM\HasLifecycleCallbacks
 * @ExclusionPolicy("all")
 */
class Message extends EduAbstract
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @Expose
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\Language", inversedBy="messages")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * @Expose
     */
    protected $language;

    /**
     * @ORM\ManyToOne(targetEntity="Discussion", inversedBy="messages")
     * @ORM\JoinColumn(name="discussion_id", referencedColumnName="id")
     */
    protected $discussion;

    /**
     * @ORM\ManyToOne(targetEntity="EduSpeakBundle\Entity\User", inversedBy="messages")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     * @Expose
     */
    protected $author;

    /**
     * Constructor
     */
    public function __construct()
    {
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

    /**
     * Set author
     *
     * @param User $author
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
