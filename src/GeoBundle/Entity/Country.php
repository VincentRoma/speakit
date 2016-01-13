<?php

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
}
