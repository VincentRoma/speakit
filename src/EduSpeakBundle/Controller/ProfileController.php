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
        $image = $user->getWebPath();
        $interests = $user->getInterests();
        $this->accountCompletion();
        $news = $this->getCurrentActivity();
        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'interests' => $interests,
            'image' => $image,
            'news' => $news
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

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $response;
        }

        $image = $user->getWebPath();
        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
            'image' => $image
        ));
    }

    /**
    *  Verify account completion
    **/
    public function accountCompletion()
    {
        $user = $this->getUser();
        $image = $user->getWebPath();
        $interests = $user->getInterests();
        if(!$image && count($interests)>0){
            $this->addFlash(
                'complete',
                "Your profile isn't complete, you can update it "
            );
        }
    }

    public function getCurrentActivity()
    {
        $news = array();
        $user = $this->getUser();
        if($user->getLastLogin())
        {
            array_push($news, 'Last activity:'.$user->getLastLogin());
        }
    }
}
