<?php

namespace EduSpeakBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\FOSUserEvents;
use EduSpeakBundle\Entity\Category as Category;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->getUser();
        $discussions = $this->getUser()->getDiscussions();
        $interests = $this->getUser()->getInterests();
        $friendships = $this->getUser()->getFriendships();

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
        $user = $this->getUser();
        $dispatcher = $this->get('event_dispatcher');
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $this->getDoctrine()->getManager()->getRepository('ContentBundle:Interest')->findAll();
        $form = $this->createFormBuilder($user)
            ->add('username', 'text', array('required' => true))
            ->add('birthday', 'date', array('required' => true))
            ->add('cityPrecision', 'text', array('required' => true))
            ->add('description', 'textarea', array('required' => true))
            // city a supprimer quand google donne la city la plus proche
            ->add('city', 'entity', array(
                'class' => 'GeoBundle:City',
                'property' => 'name',
                'required' => true,
            ))
            ->add('interests', 'entity', array(
                'class' => 'ContentBundle:Interest',
                'choices' => $this->getDoctrine()->getManager()->getRepository('ContentBundle:Interest')->findAll(),
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
            ))
            //todo complex
            /*->add('userLanguages', 'entity', array(
                'class' => 'GeoBundle:UserLanguage',
                'choices' => $this->getDoctrine()->getManager()->getRepository('GeoBundle:Language')->findAll(),
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
            ))*/
            ->add('file', 'file', array('required' => true))
            ->add('save', 'submit', array('label' => 'Modify Profile'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
