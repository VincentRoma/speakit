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
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EduSpeakBundle:User')->findOneById($id);
        if($user){
            $image = $user->getWebPath();
            $interests = $user->getInterests();
            return $this->render('FOSUserBundle:Profile:show.html.twig', array(
                'user' => $user,
                'interests' => $interests,
                'image' => $image
            ));
        }else{
            return $this->render('EduSpeakBundle:Default:404.html.twig');
        }
    }
}
