<?php

namespace EduSpeakBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\FOSUserEvents;
use EduSpeakBundle\Entity\Category as Category;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EduSpeakBundle\Form\Type\UserType as UserType;

class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->getUser();
        $discussions = $user->getDiscussions();
        $interests = $user->getInterests();
        $friendships = $user->getFriendships();

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'discussions' => $discussions,
            'interests' => $interests,
            'friendships' => $friendships
        ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        //Declarations
        $user = $this->getUser();
        $dispatcher = $this->get('event_dispatcher');
        $event = new GetResponseUserEvent($user, $request);
        $em = $this->getDoctrine()->getManager();

        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $interests = $em->getRepository('ContentBundle:Interest')->findAll();
        $languages = $em->getRepository('GeoBundle:Language')->findAll();
        $hasFile = false;
        if (null !== $user->getPath()) {
            $hasFile = true;
        }

        $form = $this->createForm(new UserType($hasFile, $interests, $languages) , $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();
            // mettre comme id_city la city la plus proche grace a google de celle qu'il a donné
            /*$user->setDateInscrip(new \DateTime());
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);*/

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
