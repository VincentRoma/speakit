<?php
// src/EduSpeakBundle/Entity/User.php

namespace EduSpeakBundle\Entity;

use ChatBundle\Entity\Discussion as Discussion;
use GeoBundle\Entity\UserLanguage as UserLanguage;
use GeoBundle\Entity\Language as Language;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\City", inversedBy="users")
     * @ORM\JoinColumn(name="id_city", referencedColumnName="id")
     */
    protected $city;

    /**
     * @ORM\ManyToMany(targetEntity="ChatBundle\Entity\Discussion", inversedBy="participants")
     * @ORM\JoinTable(name="participants_discussions")
     */
    protected $discussions;

    /**
     * @ORM\OneToMany(targetEntity="GeoBundle\Entity\UserLanguage", mappedBy="user")
     */
    protected $userlanguages;

    public function __construct()
    {
        parent::__construct();
        $this->discussions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userlanguages = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Add discussion
     *
     * @param Discussion $discussion
     *
     * @return User
     */
    public function addDiscussion(Discussion $discussion)
    {
        $this->discussions->add($discussion);

        return $this;
    }

    /**
     * Remove discussion
     *
     * @param Discussion $discussion
     */
    public function removeDiscussion(Discussion $discussion)
    {
        $this->discussions->removeElement($discussion);
    }

    /**
     * Get discussions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiscussions()
    {
        return $this->discussions;
    }

    /**
     * Add userlanguage
     *
     * @param $userlanguage
     *
     * @return Language
     */
    public function addUserlanguage(Userlanguage $userlanguage)
    {
        $this->userlanguages[] = $userlanguage;

        return $this;
    }

    /**
     * Remove userlanguage
     *
     * @param $userlanguage
     */
    public function removeUserlanguage(Userlanguage $userlanguage)
    {
        $this->userlanguages->removeElement($userlanguage);
    }

    /**
     * Get userlanguages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserlanguages()
    {
        return $this->userlanguages;
    }
}
