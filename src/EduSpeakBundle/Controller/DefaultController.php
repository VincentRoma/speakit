<?php

namespace EduSpeakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EduSpeakBundle:Default:index.html.twig');
    }

    public function profilAction($id)
    {
        $thisUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EduSpeakBundle:User')->findOneById($id);
        if($user){
            $image = $user->getWebPath();
            $interests = $user->getInterests();
            $isFriend = $thisUser->hasFriend($user);
            return $this->render('FOSUserBundle:Profile:show.html.twig', array(
                'user' => $user,
                'interests' => $interests,
                'image' => $image,
                'isFriend' => $isFriend
            ));
        }else{
            return $this->render('EduSpeakBundle:Default:404.html.twig');
        }
    }

    public function premiumAction()
    {
        return $this->render('EduSpeakBundle:Default:premium.html.twig');
    }
}
