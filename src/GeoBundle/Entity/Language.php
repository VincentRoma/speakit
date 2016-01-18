<?php

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Application\Sonata\MediaBundle\Entity\Media as Media;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;

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
}
