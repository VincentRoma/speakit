<?php

namespace ChatBundle\Controller;

use ChatBundle\Entity\Discussion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DiscussionController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChatBundle:Discussion:index.html.twig');
    }

    public function createAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $invited = $em->getRepository('EduSpeakBundle:User')->findOneById($id);
        if($invited){
            $discussion = $user->getDiscussion($invited);
            if($discussion){
                return $this->redirectToRoute('chat_display', array('id'=>$discussion->getId()));
            }else {
                $discussion = new Discussion();

                // Verify Token Unicity
                $token = $this->generateToken();
                while(!$this->verifyToken($token)){
                    $token = $this->generateToken();
                }

                //Add Participants
                $discussion = $discussion->addParticipant($user);
                $discussion = $discussion->addParticipant($invited);
                $discussion->setCity($invited->getCity());
                $discussion->setToken($token);
                $invited->addDiscussion($discussion);
                $user->addDiscussion($discussion);
                $em->persist($discussion);
                $em->flush();

                // Send Email
                $message = \Swift_Message::newInstance()
                    ->setSubject('[Speakit]'.$user->getUsername().' wants to chat with you!')
                    ->setFrom('team@speakit.fr')
                    ->setTo($invited->getEmail())
                    ->setBody(
                        $this->renderView(
                            'EduSpeakBundle:Emails:chat_invite.html.twig',
                            array('name' => $invited->getUsername())
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);
                $this->notify_invite($invited);
                return $this->redirectToRoute('chat_display', array('id'=>$discussion->getId()));
            }
        }else{
            return $this->render('ChatBundle:Discussion:discussion_fail.html.twig');
        }
    }

    public function showAction()
    {
        $user = $this->getUser();
        $discussions = $user->getDiscussions()->toArray();
        return $this->render('ChatBundle:Discussion:discussion.html.twig', array('discussions' => $discussions));
    }

    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('ChatBundle:Discussion')->findOneById($id);
        $user = $this->getUser();
        $receiver = null;
        $discussions = $user->getDiscussions()->toArray();
        if($discussion){
            foreach ($discussion->getParticipants() as $participant) {
                if($participant->getId() !== $user->getId()){
                    $receiver = $participant;
                }
            }
            $news = $this->get_news($discussion->getCity());

            return $this->render('ChatBundle:Discussion:discussion.html.twig', array(
                'discussion' => $discussion,
                'discussions' => $discussions,
                'receiver' => $receiver,
                'news' => $news
            ));
        }else{
            return $this->render('ChatBundle:Discussion:discussion_fail.html.twig');
        }
    }

    private function generateToken()
    {
        $token1 = rand(1000,9999);
        $token2 = rand(1000,9999);
        $token3 = rand(1000,9999);
        $token = md5($token1.'-'.$token2.'-'.$token3);
        return $token;
    }

    private function verifyToken($token)
    {
        $em = $this->getDoctrine()->getManager();
        if(!$em->getRepository('ChatBundle:Discussion')->findByToken($token)){
            return true;
        }
        return false;
    }

    public function get_news($city){
        $url = "https://ajax.googleapis.com/ajax/services/search/news?v=1.0&q=".$city->getName()."&hl=".$city->getZone();

        // sendRequest
        // note how referer is set manually
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, "beta.speakit.fr");
        $body = curl_exec($ch);
        curl_close($ch);

        // now, process the JSON string
        //["GsearchResultClass"]=> string(11) "GnewsSearch" ["clusterUrl"]=> string(80) "http://news.google.com/news/story?ncl=dai0V4L4QeRy4wMQLml1SerFDLW9M&hl=en&ned=us" ["content"]=
        $json = json_decode($body);

        return $json->responseData->results;
    }

    public function notify_invite($user){
        $pubnub = new Pubnub('pub-c-43fee2d2-8fc4-4b00-b424-dd315210e2c2', 'sub-c-aca4aeda-be98-11e5-8408-0619f8945a4f');
        $publish_result = $pubnub->publish('user/'.$user->getId(), 'Discussion');
    }
}
