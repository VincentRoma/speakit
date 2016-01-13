<?php

namespace EduSpeakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

class MatchController extends Controller
{
    public function indexAction()
    {
        return $this->render('EduSpeakBundle:Match:index.html.twig');
    }

    public function searchAction()
    {
        // TODO match with all users
        // retourn la liste des users matchés

        $user = $this->getUser();
        if($user){
            $em = $this->getDoctrine()->getManager();
            $matched = $em->getRepository('EduSpeakBundle:User')->findAll();
            $matchedUsers = new ArrayCollection();

            foreach($matched as $matchedUser){
                if ($matchedUser->getId() != $user->getId()) {
                    $matchedUsers->add($matchedUser);
                }
            }

            if($matchedUsers){
                return $this->render('EduSpeakBundle:Match:match.html.twig', array('matchedUsers' => $matchedUsers));
            }else{
                return $this->render('EduSpeakBundle:Match:match_fail.html.twig');
            }
        }
        return $this->render('EduSpeakBundle:Match:match_fail.html.twig');
    }
}
