<?php

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EduSpeakBundle\Entity\Expertise as Expertise;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;

/**
 * @ORM\Entity
 * @ORM\Table(name="country")
 * @ORM\HasLifecycleCallbacks
 */
class Country extends EduAbstract
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
     * @ORM\OneToMany(targetEntity="City", mappedBy="country")
     */
    protected $cities;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="countries")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    protected $language;

    /**
     * @ORM\OneToMany(targetEntity="EduSpeakBundle\Entity\Expertise", mappedBy="country")
     */
    protected $expertises;

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
        $this->cities = new ArrayCollection();
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
     * Get language
     *
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
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
     * Add city
     *
     * @param City $city
     *
     * @return Country
     */
    public function addCity(City $city)
    {
        if (!$this->hasCity($city)) {
            $this->cities->add($city);
        }
        return $this;
    }

    /**
     * Remove city
     *
     * @param City $city
     *
     * @return Country
     */
    public function removeCity(City $city)
    {
        if ($this->hasCity($city)) {
            $this->cities->removeElement($city);
        }
        return $this;
    }

    /**
     * Get cities
     *
     * @return Collection City
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Has city
     *
     * @param City $city
     *
     * @return boolean
     */
    public function hasCity(City $city)
    {
        return $this->cities->contains($city);
    }

    /**
     * Add expertise
     *
     * @param Expertise $expertise
     *
     * @return Country
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
     * @return Country
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
