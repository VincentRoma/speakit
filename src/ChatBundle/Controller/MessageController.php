<?php

namespace ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class MessageController extends FOSRestController
{
    public function optionsMessageAction()
    {} // "options_messages" [OPTIONS] /messages

    public function getMessagesAction()
    {} // "get_messages"     [GET] /messages

    /**
     * Create new Message.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     201 = "Returned when created"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="discussion", requirements="\d+", description="id of the discussion to add the message")
     * @Annotations\QueryParam(name="text", requirements="\d+", description="Actual text of the message")
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function newMessageAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $discussion_id = $paramFetcher->get('discussion');
        $text = $paramFetcher->get('text');
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('ChatBundle:Discussion')->find($discussion_id);
        if($discussion){
            
            $statusCode = 201;
            $view = $this->view($messages, $statusCode);
            return $this->handleView($view);
        }else{
            $statusCode = 404;
            $view = $this->view([], $statusCode);
            return $this->handleView($view);
        }
    } // "new_messages"     [GET] /messages/new

    public function postMessageAction()
    {} // "post_messages"    [POST] /messages

    public function getMessageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('ChatBundle:Discussion')->find($id);
        if($discussion){
            $messages = $discussion->getSessions();
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
