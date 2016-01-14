<?php

namespace EduSpeakBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EduSpeakBundle\Entity\EduAbstract as EduAbstract;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="expertise")
 * @ORM\HasLifecycleCallbacks
 */
class Expertise extends EduAbstract
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\Country", inversedBy="experts")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    protected $country;

    /**
     * @ORM\ManyToOne(targetEntity="GeoBundle\Entity\City", inversedBy="experts")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="expertise")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $expert;

    /**
     * @ORM\Column(type="integer")
     */
    protected $score;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->$country = new ArrayCollection();
        $this->$city = new ArrayCollection();
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
     * Set score
     *
     * @param integer $score
     *
     * @return Expertise
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set country
     *
     * @param \GeoBundle\Entity\Country $country
     *
     * @return Expertise
     */
    public function setCountry(\GeoBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \GeoBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param \GeoBundle\Entity\City $city
     *
     * @return Expertise
     */
    public function setCity(\GeoBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \GeoBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set expert
     *
     * @param \EduSpeakBundle\Entity\User $expert
     *
     * @return Expertise
     */
    public function setExpert(\EduSpeakBundle\Entity\User $expert = null)
    {
        $this->expert = $expert;

        return $this;
    }

    /**
     * Get expert
     *
     * @return \EduSpeakBundle\Entity\User
     */
    public function getExpert()
    {
        return $this->expert;
    }
}
