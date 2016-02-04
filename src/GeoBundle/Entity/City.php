<?php

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EduSpeakBundle\Entity\User as User;
use Application\Sonata\MediaBundle\Entity\Media as Media;
use EduSpeakBundle\Entity\Expertise as Expertise;
use ChatBundle\Entity\Discussion as Discussion;
use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;

/**
 * @ORM\Entity
 * @ORM\Table(name="city")
 * @ORM\HasLifecycleCallbacks
 */
class City extends EduAbstract
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Algolia\Id
     * @Algolia\Attribute
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="city")
     */
    protected $residents;

    /**
     * @ORM\OneToMany(targetEntity="EduSpeakBundle\Entity\Expertise", mappedBy="city")
     */
    protected $expertises;

    /**
     * @ORM\OneToMany(targetEntity="ChatBundle\Entity\Discussion", mappedBy="city")
     */
    protected $discussions;

    /**
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean", name="slider")
     */
    protected $slider;

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
        $this->residents = new ArrayCollection();
        $this->discussions = new ArrayCollection();
        $this->expertises = new ArrayCollection();
        $this->slider = false;
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
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get zone
     *
     * @return string
     */
    public function getZone()
    {
        return $this->country->getLanguage()->getZone();
    }

    /**
     * Set country
     *
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @Algolia\Attribute
     */
    public function getCountryCity()
    {
        return $this->getCountry()->getName() . ", " . $this->name;
    }

    /**
     * Get picture
     *
     * @return Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picture
     *
     * @param Media $picture
     */
    public function setPicture(Media $picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get slider
     *
     * @return boolean
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * Set slider
     *
     * @param boolean $slider
     */
    public function setSlider($slider)
    {
        $this->slider = $slider;
    }

    /**
     * Add resident
     *
     * @param User $resident
     *
     * @return City
     */
    public function addResident(User $resident)
    {
        if (!$this->hasResident($resident)) {
            $this->residents->add($resident);
        }
        return $this;
    }

    /**
     * Remove resident
     *
     * @param User $resident
     *
     * @return City
     */
    public function removeResident(User $resident)
    {
        if ($this->hasResident($resident)) {
            $this->residents->removeElement($resident);
        }
        return $this;
    }

    /**
     * Get residents
     *
     * @return Collection User
     */
    public function getResidents()
    {
        return $this->residents;
    }

    /**
     * Has resident
     *
     * @param User $resident
     *
     * @return boolean
     */
    public function hasResident(User $resident)
    {
        return $this->residents->contains($resident);
    }

    /**
     * Add discussion
     *
     * @param Discussion $discussion
     *
     * @return City
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
     * @return City
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
     * @return City
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
     * @return City
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
