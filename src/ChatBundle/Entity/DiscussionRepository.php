<?php

namespace ChatBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DiscussionRepository extends EntityRepository
{
    public function findByBothParticipants($user, $participant)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT * FROM ChatBundle:Discussion WHERE :user IN participants AND :participant IN participants'
            )
            ->setParameters(array('user'=>$user->getId(), 'participant'=>$participant->getId()))
            ->getResult();
    }
}