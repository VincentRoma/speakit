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
        $user = $this->getUser();
        // Get requested user
        $em = $this->getDoctrine()->getManager();
        $invited = $em->getRepository('EduSpeakBundle:User')->findOneById($id);
        if($invited){
            $discussion = false;
            // Check for existing discussion
            foreach($user->getDiscussions() as $d){
                foreach($d->getParticipants() as $p) {
                    if ($invited->getId() == $p->getId()) {
                        $discussion = $d;
                    }
                }
            }
            if($discussion){
                return $this->redirectToRoute('chat_display', array('id'=>$discussion->getId()));
            }else {
                // Create new discussion
                $discussion = new Discussion();

                //Add Participants
                $discussion = $discussion->addParticipant($user);
                $discussion = $discussion->addParticipant($invited);
                $invited->addDiscussion($discussion);
                $user->addDiscussion($discussion);
                $em->persist($discussion);
                $em->flush();

                return $this->redirectToRoute('chat_display', array('id'=>$discussion->getId()));
            }
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

    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('ChatBundle:Discussion')->findOneById($id);
        if($discussion){
            return $this->render('ChatBundle:Discussion:discussion.html.twig', array('discussion' => $discussion));
        }else{
            return $this->render('ChatBundle:Discussion:discussion_fail.html.twig');
        }
    }
}
