<?php

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Application\Sonata\MediaBundle\Entity\Media as Media;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;
use EduSpeakBundle\Entity\User as User;
use ChatBundle\Entity\Message as Message;

/**
 * @ORM\Entity
 * @ORM\Table(name="language")
 * @ORM\HasLifecycleCallbacks
 */
class Language extends EduAbstract
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $zone;

    /**
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $flag;

    /**
     * @ORM\OneToMany(targetEntity="UserLanguage", mappedBy="language")
     */
    protected $userLanguages;

    /**
     * @ORM\OneToMany(targetEntity="Country", mappedBy="language")
     */
    protected $countries;

    /**
     * @ORM\ManyToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="spokenLanguages")
     */
    protected $languageSpokenUsers;

    /**
     * @ORM\OneToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="learnLanguage")
     */
    protected $languageLearnUsers;

    /**
     * @ORM\OneToMany(targetEntity="ChatBundle\Entity\Message", mappedBy="language")
     */
    protected $messages;

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userLanguages = new ArrayCollection();
        $this->countries = new ArrayCollection();
        $this->languageSpokenUsers = new ArrayCollection();
        $this->languageLearnUsers = new ArrayCollection();
        $this->messages = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get zone
     *
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set zone
     *
     * @param string $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }

    /**
     * Get flag
     *
     * @return Media
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set flag
     *
     * @param Media $flag
     */
    public function setFlag(Media $flag)
    {
        $this->flag = $flag;
    }

    /**
     * Add userLanguage
     *
     * @param UserLanguage $userLanguage
     *
     * @return Language
     */
    public function addUserLanguage(UserLanguage $userLanguage)
    {
        if (!$this->hasUserLanguage($userLanguage)) {
            $this->userLanguages->add($userLanguage);
        }
        return $this;
    }

    /**
     * Remove userLanguage
     *
     * @param UserLanguage $userLanguage
     *
     * @return Language
     */
    public function removeUserLanguage(UserLanguage $userLanguage)
    {
        if ($this->hasUserLanguage($userLanguage)) {
            $this->userLanguages->removeElement($userLanguage);
        }
        return $this;
    }

    /**
     * Get userLanguages
     *
     * @return Collection UserLanguage
     */
    public function getUserLanguages()
    {
        return $this->userLanguages;
    }

    /**
     * Has userLanguage
     *
     * @param UserLanguage $userLanguage
     *
     * @return boolean
     */
    public function hasUserLanguage(UserLanguage $userLanguage)
    {
        return $this->userLanguages->contains($userLanguage);
    }

    /**
     * Add country
     *
     * @param Country $country
     *
     * @return Language
     */
    public function addCountry(Country $country)
    {
        if (!$this->hasCountry($country)) {
            $this->countries->add($country);
        }
        return $this;
    }

    /**
     * Remove country
     *
     * @param Country $country
     *
     * @return Language
     */
    public function removeCountry(Country $country)
    {
        if ($this->hasCountry($country)) {
            $this->countries->removeElement($country);
        }
        return $this;
    }

    /**
     * Get countries
     *
     * @return Collection Country
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * Has country
     *
     * @param Country $country
     *
     * @return boolean
     */
    public function hasCountry(Country $country)
    {
        return $this->countries->contains($country);
    }

    /**
     * Add language spoken user
     *
     * @param User $user
     *
     * @return Language
     */
    public function addLanguageSpokenUser(User $user)
    {
        if (!$this->hasLanguageSpokenUser($user)) {
            $this->languageSpokenUsers->add($user);
        }
        return $this;
    }

    /**
     * Remove language spoken user
     *
     * @param User $user
     *
     * @return Language
     */
    public function removeLanguageSpokenUser(User $user)
    {
        if ($this->hasLanguageSpokenUser($user)) {
            $this->languageSpokenUsers->removeElement($user);
        }
        return $this;
    }

    /**
     * Get language spoken users
     *
     * @return Collection User
     */
    public function getLanguageSpokenUsers()
    {
        return $this->languageSpokenUsers;
    }

    /**
     * Has language spoken user
     *
     * @param User $user
     *
     * @return boolean
     */
    public function hasLanguageSpokenUser(User $user)
    {
        return $this->languageSpokenUsers->contains($user);
    }

    /**
     * Add language learn user
     *
     * @param User $user
     *
     * @return Language
     */
    public function addLanguageLearnUser(User $user)
    {
        if (!$this->hasLanguageLearnUser($user)) {
            $this->languageLearnUsers->add($user);
        }
        return $this;
    }

    /**
     * Remove language learn user
     *
     * @param User $user
     *
     * @return Language
     */
    public function removeLanguageLearnUser(User $user)
    {
        if ($this->hasLanguageLearnUser($user)) {
            $this->languageLearnUsers->removeElement($user);
        }
        return $this;
    }

    /**
     * Get language learn users
     *
     * @return Collection User
     */
    public function getLanguageLearnUsers()
    {
        return $this->languageLearnUsers;
    }

    /**
     * Has language learn user
     *
     * @param User $user
     *
     * @return boolean
     */
    public function hasLanguageLearnUser(User $user)
    {
        return $this->languageLearnUsers->contains($user);
    }

    /**
     * Add message
     *
     * @param Message $message
     *
     * @return Language
     */
    public function addMessage(Message $message)
    {
        if (!$this->hasMessage($message)) {
            $this->messages->add($message);
        }
        return $this;
    }

    /**
     * Remove message
     *
     * @param Message $message
     *
     * @return Language
     */
    public function removeMessage(Message $message)
    {
        if ($this->hasMessage($message)) {
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
    public function hasMessage(Message $message)
    {
        return $this->messages->contains($message);
    }
}