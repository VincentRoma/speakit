<?php

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EduSpeakBundle\Entity\User as User;

/**
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class City
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
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="EduSpeakBundle\Entity\User", mappedBy="city")
     */
    protected $residents;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->residents = new ArrayCollection();
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
     * Set country
     *
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
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
}

