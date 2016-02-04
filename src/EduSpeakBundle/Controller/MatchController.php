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
            $news = get_news($city);
            return $this->render('EduSpeakBundle:Match:match.html.twig', array(
                'matchedUsers' => $matchedUsers,
                'city' => $city,
                'ageMax' => $ageMax,
                'ageMin' => $ageMin,
                'learnLanguages' => $learnLanguages,
                'spokenLanguages' => $spokenLanguages,
                'news' => $news
            ));
        }
        return $this->render('EduSpeakBundle:Match:match.html.twig', array(
            'city' => $city
        ));
    }

    public function get_news($city){
        $url = "https://ajax.googleapis.com/ajax/services/search/news?v=1.0&q=".$city->getName()."&hl=".$city->getZone();

        // sendRequest
        // note how referer is set manually
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, /* Enter the URL of your site here */);
        $body = curl_exec($ch);
        curl_close($ch);

        // now, process the JSON string
        $json = json_decode($body);
        // now have some fun with the results...
        return $json;
    }
}
