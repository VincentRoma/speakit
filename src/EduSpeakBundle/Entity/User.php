<?php

namespace EduSpeakBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use GeoBundle\Entity\City as City;
use GeoBundle\Entity\UserLanguage as UserLanguage;
use GeoBundle\Entity\Language as Language;
use ChatBundle\Entity\Discussion as Discussion;
use ChatBundle\Entity\Message as Message;
use ContentBundle\Entity\Interest as Interest;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use ContentBundle\Entity\Actuality as Actuality;
use FOS\UserBundle\Model\User as BaseUser;
use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="EduSpeakBundle\Entity\UserRepository")
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
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    protected $description;

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
     * @ORM\ManyToMany(targetEntity="GeoBundle\Entity\Language", inversedBy="languageSpokenUsers")
     * @ORM\JoinTable(name="users_spoken_languages")
     */
    protected $spokenLanguages;

    /**
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\Language", inversedBy="languageLearnUsers")
     * @ORM\JoinColumn(name="language_learn_id", referencedColumnName="id")
     */
    protected $learnLanguage;

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
     * @ORM\OneToMany(targetEntity="ChatBundle\Entity\Message", mappedBy="author")
     */
    protected $messages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    private $temp;

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
        $this->spokenLanguages = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        if (isset($this->path)) {
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        if (isset($this->temp)) {
            unlink($this->getUploadRootDir().'/'.$this->temp);
            $this->temp = null;
        }
        $this->file = null;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : '/'.$this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/user';
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
     * Get city
     *
     * @return City
     */
    public function getCountry()
    {
        return $this->city->getCountry();
    }

    /**
     * Get learn language
     *
     * @return Language
     */
    public function getLearnLanguage()
    {
        return $this->learnLanguage;
    }

    /**
     * Set learn language
     *
     * @param Language $language
     */
    public function setLearnLanguage(Language $language)
    {
        $this->learnLanguage = $language;
    }

    /**
     * Get birthday
     *
     * @return DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set birthday
     *
     * @param DateTime $birthday
     */
    public function setBirthday(DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        $birthDate = explode("/", date_format($this->birthday,"m/d/Y"));
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Has friend
     *
     * @param User $user
     *
     * @return bool
     */
    public function hasFriend(User $user)
    {
        $bool = false;
        foreach($this->getFriendships() as $friendships){
            foreach($friendships->getFriends() as $friend) {
                if ($user->getId() == $friend->getId()) {
                    $bool = true;
                }
            }
        }
        return $bool;
    }

    /**
     * get discussion
     *
     * @param User $user
     *
     * @return bool
     */
    public function getDiscussion(User $user)
    {
        foreach($this->getDiscussions() as $discussion){
            foreach($discussion->getParticipants() as $participant) {
                if ($user->getId() == $participant->getId()) {
                    return $discussion;
                }
            }
        }
        return false;
    }

    /**
     * Get visited cities
     *
     * @return Collection City
     */
    public function getVisitedCities()
    {
        $visitedCities = new ArrayCollection();
        foreach($this->getDiscussions() as $discussion){
            $city = $discussion->getCity();
            if ($city != $this->getCity()) {
                $visitedCities->add($city);
            }
        }
        return $visitedCities;
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

    /**
     * Add spoken language
     *
     * @param Language $language
     *
     * @return User
     */
    public function addSpokenLanguage(Language $language)
    {
        if (!$this->hasSpokenLanguage($language)) {
            $this->spokenLanguages->add($language);
        }
        return $this;
    }

    /**
     * Remove spoken language
     *
     * @param Language $language
     *
     * @return User
     */
    public function removeSpokenLanguage(Language $language)
    {
        if ($this->hasSpokenLanguage($language)) {
            $this->spokenLanguages->removeElement($language);
        }
        return $this;
    }

    /**
     * Get spoken languages
     *
     * @return Collection Language
     */
    public function getSpokenLanguages()
    {
        return $this->spokenLanguages;
    }

    /**
     * Has spoken language
     *
     * @param Language $language
     *
     * @return boolean
     */
    public function hasSpokenLanguage(Language $language)
    {
        return $this->spokenLanguages->contains($language);
    }

    /**
     * Add message
     *
     * @param Message $message
     *
     * @return User
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
     * @return User
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
