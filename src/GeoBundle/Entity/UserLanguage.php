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
 * @ORM\Table(name="userlanguage")
 */
class UserLanguage
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="EduSpeakBundle\Entity\User", inversedBy="userlanguages")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    protected $id_user;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="userlanguages")
     * @ORM\JoinColumn(name="id_language", referencedColumnName="id")
     */
    protected $id_language;

    /**
     * @ORM\Column(type="integer")
     */
    protected $score;

    /**
     * @return $id_user
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return $id_language
     */
    public function getIdLanguage()
    {
        return $this->id_language;
    }

    /**
     * @param $id_language
     */
    public function setIdLanguage($id_language)
    {
        $this->id_language = $id_language;
    }

    /**
     * @return $score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
}