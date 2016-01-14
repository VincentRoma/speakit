<?php

namespace EduSpeakBundle\Controller;

use EduSpeakBundle\Entity\Friendship;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

class FriendshipController extends Controller
{
    public function indexAction()
    {
        return $this->render('EduSpeakBundle:Friendship:index.html.twig');
    }

    public function createAction($id)
    {
        $user = $this->getUser();
        // Get requested user
        $em = $this->getDoctrine()->getManager();
        $invited = $em->getRepository('EduSpeakBundle:User')->findOneById($id);
        if($invited){
            $friendship = false;
            // Check for existing discussion
            foreach($user->getFriendships() as $d){
                foreach($d->getFriends() as $p) {
                    if ($invited->getId() == $p->getId()) {
                        $friendship = $d;
                    }
                }
            }
            if($friendship){
                return $this->redirectToRoute('edu_speak_friend_list');
            }else {
                // Create new friendship
                $friendship = new Friendship();

                //Add Friends
                $friendship = $friendship->addFriend($user);
                $friendship = $friendship->addFriend($invited);
                $invited->addFriendship($friendship);
                $user->addFriendship($friendship);
                $em->persist($friendship);
                $em->flush();

                return $this->redirectToRoute('edu_speak_friend_list');
            }
        }else{
            return $this->redirectToRoute('edu_speak_friend_list');
        }
    }

    public function showAction()
    {
        $user = $this->getUser();
        $friends = new ArrayCollection();
        $friendships = $user->getFriendships()->toArray();
        foreach($friendships as $friendship){
            foreach($friendship->getFriends() as $friend) {
                if ($friend->getId() != $user->getId()) {
                    $friends->add($friend);
                }
            }
        }
        return $this->render('EduSpeakBundle:Friendship:friends.html.twig', array('friends' => $friends));
    }

    public function displayAction($id)
    {
        // TODO show the friendship selectionned => redirect sur la convers ?
    }
}
