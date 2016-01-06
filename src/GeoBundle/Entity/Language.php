<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 06/01/2016
 * Time: 14:22
 */

namespace GeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="language")
 */
class Language
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
     * @ORM\OneToMany(targetEntity="UserLanguage", mappedBy="language")
     */
    protected $userlanguages;

    public function __construct()
    {
        $this->userlanguages = new ArrayCollection();
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
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
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