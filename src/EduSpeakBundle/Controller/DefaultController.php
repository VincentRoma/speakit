<?php

namespace EduSpeakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EduSpeakBundle:Default:index.html.twig');
    }
}
