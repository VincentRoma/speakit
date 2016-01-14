<?php

namespace EduSpeakBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use GeoBundle\Entity\City as City;
use GeoBundle\Entity\UserLanguage as UserLanguage;
use ChatBundle\Entity\Discussion as Discussion;
use ContentBundle\Entity\Interest as Interest;
use ContentBundle\Entity\Actuality as Actuality;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="EduSpeakBundle\Entity\UserRepository")
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
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\City", inversedBy="residents")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @ORM\ManyToMany(targetEntity="ChatBundle\Entity\Discussion", inversedBy="participants")
     * @ORM\JoinTable(name="users_discussions")
     */
    protected $discussions;

    /**
     * @ORM\ManyToMany(targetEntity="Friendship", inversedBy="friends")
     * @ORM\JoinTable(name="users_friends")
     */
    protected $friendships;

    /**
     * @ORM\ManyToMany(targetEntity="ContentBundle\Entity\Interest", inversedBy="interested_users")
     * @ORM\JoinTable(name="users_interests")
     */
    protected $interests;

    /**
     * @ORM\ManyToMany(targetEntity="ContentBundle\Entity\Actuality", inversedBy="actuality_users")
     * @ORM\JoinTable(name="users_actualities")
     */
    protected $actualities;

    /**
     * @ORM\OneToMany(targetEntity="GeoBundle\Entity\UserLanguage", mappedBy="user")
     */
    protected $userLanguages;

    /**
     * @ORM\OneToMany(targetEntity="Expertise", mappedBy="user")
     */
    protected $expertises;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /**
     * @ORM\Column(type="string", name="facebook_picture", length=255, unique=false, nullable=true)
     */
    protected $facebook_picture;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->discussions = new ArrayCollection();
        $this->friendships = new ArrayCollection();
        $this->actualities = new ArrayCollection();
        $this->interests = new ArrayCollection();
        $this->userLanguages = new ArrayCollection();
        $this->expertises = new ArrayCollection();
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
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param City $city
     */
    public function setCity(City $city)
    {
        $this->city = $city;
    }

    /**
     * Set facebookId
     *
     * @param integer $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;
        return $this;
    }

    /**
     * Get facebookId
     *
     * @return integer
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebookPicture
     *
     * @param string $facebookPicture
     *
     * @return User
     */
    public function setFacebookPicture($facebookPicture)
    {
        $this->facebook_picture = $facebookPicture;

        return $this;
    }

    /**
     * Get facebookPicture
     *
     * @return string
     */
    public function getFacebookPicture()
    {
        return $this->facebook_picture;
    }

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Add userLanguage
     *
     * @param UserLanguage $userLanguage
     *
     * @return User
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
     * @return User
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
     * Add interest
     *
     * @param Interest $interest
     *
     * @return User
     */
    public function addInterest(Interest $interest)
    {
        if (!$this->hasInterest($interest)) {
            $this->interests->add($interest);
        }
        return $this;
    }

    /**
     * Remove interest
     *
     * @param Interest $interest
     *
     * @return User
     */
    public function removeInterest(Interest $interest)
    {
        if ($this->hasInterest($interest)) {
            $this->interests->removeElement($interest);
        }
        return $this;
    }

    /**
     * Get interests
     *
     * @return Collection Interest
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Has interest
     *
     * @param Interest $interest
     *
     * @return boolean
     */
    public function hasInterest(Interest $interest)
    {
        return $this->interests->contains($interest);
    }

    /**
     * Add actuality
     *
     * @param Actuality $actuality
     *
     * @return User
     */
    public function addActuality(Actuality $actuality)
    {
        if (!$this->hasActuality($actuality)) {
            $this->actualities->add($actuality);
        }
        return $this;
    }

    /**
     * Remove actuality
     *
     * @param Actuality $actuality
     *
     * @return User
     */
    public function removeActuality(Actuality $actuality)
    {
        if ($this->hasActuality($actuality)) {
            $this->actualities->removeElement($actuality);
        }
        return $this;
    }

    /**
     * Get actualities
     *
     * @return Collection Actuality
     */
    public function getActualities()
    {
        return $this->actualities;
    }

    /**
     * Has actuality
     *
     * @param Actuality $actuality
     *
     * @return boolean
     */
    public function hasActuality(Actuality $actuality)
    {
        return $this->actualities->contains($actuality);
    }

    /**
     * Add friendship
     *
     * @param Friendship $friendship
     *
     * @return User
     */
    public function addFriendship(Friendship $friendship)
    {
        if (!$this->hasFriendship($friendship)) {
            $this->friendships->add($friendship);
        }
        return $this;
    }

    /**
     * Remove friendship
     *
     * @param Friendship $friendship
     *
     * @return User
     */
    public function removeFriendship(Friendship $friendship)
    {
        if ($this->hasFriendship($friendship)) {
            $this->friendships->removeElement($friendship);
        }
        return $this;
    }

    /**
     * Get friendships
     *
     * @return Collection Friendship
     */
    public function getFriendships()
    {
        return $this->friendships;
    }

    /**
     * Has friendship
     *
     * @param Friendship $friendship
     *
     * @return boolean
     */
    public function hasFriendship(Friendship $friendship)
    {
        return $this->friendships->contains($friendship);
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
        if (!$this->hasDiscussion($discussion)) {
            $this->discussions->add($discussion);
        }
        return $this;
    }

    /**
     * Remove discussion
     *
     * @param Discussion $discussion
     *
     * @return User
     */
    public function removeDiscussion(Discussion $discussion)
    {
        if ($this->hasDiscussion($discussion)) {
            $this->discussions->removeElement($discussion);
        }
        return $this;
    }

    /**
     * Get discussions
     *
     * @return Collection Discussion
     */
    public function getDiscussions()
    {
        return $this->discussions;
    }

    /**
     * Has discussion
     *
     * @param Discussion $discussion
     *
     * @return boolean
     */
    public function hasDiscussion(Discussion $discussion)
    {
        return $this->discussions->contains($discussion);
    }

    /**
     * Add expertise
     *
     * @param Expertise $expertise
     *
     * @return User
     */
    public function addExpertise(Expertise $expertise)
    {
        if (!$this->hasExpertise($expertise)) {
            $this->expertises->add($expertise);
        }
        return $this;
    }

    /**
     * Remove expertise
     *
     * @param Expertise $expertise
     *
     * @return User
     */
    public function removeExpertise(Expertise $expertise)
    {
        if ($this->hasExpertise($expertise)) {
            $this->expertises->removeElement($expertise);
        }
        return $this;
    }

    /**
     * Get expertises
     *
     * @return Collection Expertise
     */
    public function getExpertises()
    {
        return $this->expertises;
    }

    /**
     * Has expertise
     *
     * @param Expertise $expertise
     *
     * @return boolean
     */
    public function hasExpertise(Expertise $expertise)
    {
        return $this->expertises->contains($expertise);
    }
}
