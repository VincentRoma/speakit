<?php

namespace EduSpeakBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Doctrine\Common\Collections\ArrayCollection;

class ServiceController extends BaseController
{
    /**
     * get the user logged
     */
    public function getUserLogged()
    {
        if(!$this->getUser()) {
            $this->redirect("edu_speak_homepage");
        }
        return $this->getUser();
    }

    /**
     * get all users without the user logged
     */
    public function getUsers()
    {
        $userLogged = $this->getUserLogged();
        $users = $this->getDoctrine()->getManager()->getRepository('EduSpeakBundle:User')->findAll();
        $usersWithoutUserLogged = new ArrayCollection();

        foreach($users as $user){
            if ($user->getId() != $userLogged->getId()) {
                $usersWithoutUserLogged->add($user);
            }
        }
        return $usersWithoutUserLogged;
    }
}