<?php

namespace AppBundle\Controller;

use JMS\Serializer\Handler\ArrayCollectionHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cities = $em->getRepository('GeoBundle:City')->findBy(
            array('slider' => true)
        );

        if($this->getUser()){
            $language = $this->getUser()->getLearnLanguage();
            $citiesSuggested = new ArrayCollection();
            $countrySuggested = $em->getRepository('GeoBundle:Country')->findByLanguage($language);

            foreach($countrySuggested as $country){
                foreach($country->getCities() as $city){
                    $citiesSuggested->add($city);
                }
            }

            return $this->render('default/index.html.twig', array(
                'cities' => $cities,
                'language' => $language,
                'citiesSuggested' => $citiesSuggested,
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            ));
        }
        return $this->render('default/index.html.twig', array(
            'cities' => $cities,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
