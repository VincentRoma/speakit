<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('GeoBundle:Country')->findBy(
            array('slider' => true)
        );

        if($this->getUser()){
            $languages = $this->getUser()->getLearnLanguages();
            $countriesSuggested = $em->getRepository('GeoBundle:Country')->findByLanguage($languages->get(0));

            return $this->render('default/index.html.twig', array(
                'countries' => $countries,
                'language' => $languages->get(0),
                'countriesSuggested' => $countriesSuggested,
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            ));
        }
        return $this->render('default/index.html.twig', array(
            'countries' => $countries,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
