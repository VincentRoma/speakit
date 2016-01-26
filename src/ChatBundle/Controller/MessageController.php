<?php

namespace ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use ChatBundle\Entity\Message as Message;
use EduSpeakBundle\Entity\User as User;

class MessageController extends FOSRestController
{
    public function optionsMessageAction()
    {} // "options_messages" [OPTIONS] /messages

    public function getMessagesAction()
    {} // "get_messages"     [GET] /messages

    /**
     * Create new Message.
     * @param Request               $request      the request object
     * @return array
     */
    public function newMessageAction(Request $request)
    {
        // $discussion_id = $paramFetcher->get('discussion');
        // $text = $paramFetcher->get('text');
        $token = $request->query->get('token');
        $message = $request->query->get('message');
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('ChatBundle:Discussion')->findOneByToken($token);
        if($discussion && $message){
            $msg_object = new Message();
            $msg_object->setDiscussion($discussion);
            $msg_object->setContent($message);
            $msg_object->setAuthor($this->getUser());
            $em->persist($msg_object);
            // $discussion = $discussion->addMessage($msg_object);
            // $em->persist($discussion);
            $em->flush();
            $statusCode = 201;
            $view = $this->view($msg_object, $statusCode);
            return $this->handleView($view);
        }else{
            $statusCode = 404;
            $view = $this->view('404 Not Found', $statusCode);
            return $this->handleView($view);
        }
    } // "new_messages"     [GET] /messages/new

    public function postMessageAction()
    {} // "post_messages"    [POST] /messages

    public function getMessageAction($token)
    {
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('ChatBundle:Discussion')->findOneByToken($token);
        if($discussion){
            $messages = $discussion->getMessages();
            $statusCode = 200;
            $view = $this->view($messages, $statusCode);
            return $this->handleView($view);
        }else{
            $statusCode = 404;
            $view = $this->view([], $statusCode);
            return $this->handleView($view);
        }
    } // "get_messages"     [GET] /messages/$id
}
