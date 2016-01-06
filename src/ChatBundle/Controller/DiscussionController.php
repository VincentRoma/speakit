<?php

namespace ChatBundle\Controller;

use ChatBundle\Entity\Discussion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DiscussionController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChatBundle:Discussion:index.html.twig');
    }

    public function createAction($id)
    {
        // Get requested user
        $em = $this->getDoctrine()->getManager();
        $invited = $em->getRepository('EduSpeakBundle:User')->findOneById($id);
        if($invited){
            // Create new discussion
            $discussion = new Discussion();
            $user = $this->getUser();

            //Add Participants
            $discussion = $discussion->addParticipant($user);
            $discussion = $discussion->addParticipant($invited);
            $invited->addDiscussion($discussion);
            $user->addDiscussion($discussion);
            $em->persist($discussion);
            $em->flush();

            return $this->render('ChatBundle:Discussion:discussion.html.twig', array('discussion' => $discussion));
        }else{
            return $this->render('ChatBundle:Discussion:discussion_fail.html.twig');
        }
    }

    public function showAction()
    {
        //$em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository('EduSpeakBundle:User')->find($usr->getId());
        $user = $this->getUser();
        $discussions = $user->getDiscussions()->toArray();
        return $this->render('ChatBundle:Discussion:discussions.html.twig', array('discussions' => $discussions));
    }
}
