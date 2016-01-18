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
            return $this->render('FOSUserBundle:Profile:show.html.twig', array(
                'user' => $user,
                'discussions' => [],
                'interests' => [],
                'friendships' => []
            ));
        }else{
            return $this->render('EduSpeakBundle:Default:404.html.twig');
        }
    }
}
