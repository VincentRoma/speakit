<?php

namespace EduSpeakBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findUserByFacebookId($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT * FROM EduSpeakBundle:User WHERE facebook_id=:id'
            )
            ->setParameters(array('id'=>$id))
            ->getResult();
    }
}
