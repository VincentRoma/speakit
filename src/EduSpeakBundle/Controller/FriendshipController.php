<?php

namespace EduSpeakBundle\Controller;

use EduSpeakBundle\Entity\Friendship;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Pubnub\Pubnub;

class FriendshipController extends Controller
{
    public function indexAction()
    {
        return $this->render('EduSpeakBundle:Friendship:index.html.twig');
    }

    public function createAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $invited = $em->getRepository('EduSpeakBundle:User')->findOneById($id);
        if($invited){
            if($user->hasFriend($invited)){
                return $this->redirectToRoute('edu_speak_friend_list');
            }else {
                $friendship = new Friendship();
                $friendship = $friendship->addFriend($user);
                $friendship = $friendship->addFriend($invited);
                $invited->addFriendship($friendship);
                $user->addFriendship($friendship);
                $em->persist($friendship);
                $em->flush();
                $this->notify_invite($invited);
                // ne pas retourner sur la liste d'amis
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
        $citiesSuggested = new ArrayCollection();
        $em = $this->getDoctrine()->getManager();
        $countrySuggested = $em->getRepository('GeoBundle:Country')->findByLanguage($this->getUser()->getLearnLanguage());

        foreach($countrySuggested as $country){
            foreach($country->getCities() as $city){
                $citiesSuggested->add($city);
            }
        }

        foreach($friendships as $friendship){
            foreach($friendship->getFriends() as $friend) {
                if ($friend->getId() != $user->getId()) {
                    $friends->add($friend);
                }
            }
        }
        return $this->render('EduSpeakBundle:Friendship:friends.html.twig', array('friends' => $friends, 'citiesSuggested'=>$citiesSuggested));
    }

    public function displayAction($id)
    {
        // TODO show the friendship selectionned => redirect sur la convers ?
    }

    public function notify_invite($user){
        $pubnub = new Pubnub('pub-c-43fee2d2-8fc4-4b00-b424-dd315210e2c2', 'sub-c-aca4aeda-be98-11e5-8408-0619f8945a4f');
        $publish_result = $pubnub->publish('user/'.$user->getId(), 'Invitation');

    }
}
