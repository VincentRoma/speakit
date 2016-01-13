<?php

namespace EduSpeakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatchController extends Controller
{
    public function indexAction()
    {
        return $this->render('EduSpeakBundle:Match:index.html.twig');
    }

    public function searchAction()
    {
        // TODO match with all users

        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $matchedUsers = $em->getRepository('EduSpeakBundle:User')->findUsersExceptMe($id);

        if($matchedUsers){
            return $this->render('EduSpeakBundle:Match:match.html.twig', array('matchedUsers' => $matchedUsers));
        }else{
            return $this->render('EduSpeakBundle:Match:match_fail.html.twig');
        }
    }
}
