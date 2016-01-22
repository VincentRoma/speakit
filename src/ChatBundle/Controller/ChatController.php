<?php

namespace ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class ChatController extends FOSRestController
{
    public function optionsChatAction()
    {} // "options_chats" [OPTIONS] /chats

    public function getChatsAction()
    {} // "get_chats"     [GET] /chats

    public function newChatAction()
    {} // "new_chats"     [GET] /chats/new

    public function postChatAction()
    {} // "post_chats"    [POST] /chats

    public function patchChatAction()
    {} // "patch_chats"   [PATCH] /chats

    public function getChatAction($id)
    {} // "get_chat"      [GET] /chats/{id}
}
