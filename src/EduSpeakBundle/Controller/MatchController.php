<?php

namespace EduSpeakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

class MatchController extends Controller
{
    public function indexAction()
    {
        return $this->render('EduSpeakBundle:Match:index.html.twig');
    }

    public function searchAction($id)
    {
        $idUser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $matchedUsers = $em->getRepository('EduSpeakBundle:User')->findUsersCityExceptMe($idUser, $id);
        $city = $em->getRepository('GeoBundle:City')->find($id);

        if($matchedUsers){
            $spokenLanguages = new ArrayCollection();
            $learnLanguages = new ArrayCollection();
            $ageMin = 99;
            $ageMax = 0;
            foreach($matchedUsers as $user){
                $age = $user->getAge();
                if($age > $ageMax){
                    $ageMax = $age;
                }
                if($age < $ageMin){
                    $ageMin = $age;
                }

                $learnLanguage = $user->getLearnLanguage();
                if(!$learnLanguages->contains($learnLanguage)){
                    $learnLanguages->add($learnLanguage);
                }

                foreach($user->getSpokenLanguages() as $spokenLanguage){
                    if(!$spokenLanguages->contains($spokenLanguage)){
                        $spokenLanguages->add($spokenLanguage);
                    }
                }
            }

            return $this->render('EduSpeakBundle:Match:match.html.twig', array(
                'matchedUsers' => $matchedUsers,
                'city' => $city,
                'ageMax' => $ageMax,
                'ageMin' => $ageMin,
                'learnLanguages' => $learnLanguages,
                'spokenLanguages' => $spokenLanguages
            ));
        }
        return $this->render('EduSpeakBundle:Match:match.html.twig', array(
            'city' => $city
        ));
    }
}
