<?php

namespace EduSpeakBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class UserController extends FOSRestController
{
    /**
    * Get single User,
    *
    * @param Request $request the request object
    * @param int     $id      the user id
    *
    * @return array
    *
    * @throws NotFoundHttpException when user not exist
    */
    public function getUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('EduSpeakBundle:User')->find($id);
        $statusCode = 200;

        $view = $this->view($users, $statusCode);
        return $this->handleView($view);
    }
}
