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

    public function findUsersCityExceptMe($id, $idCity)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM EduSpeakBundle:User u, GeoBundle:City c WHERE u.city=:idCity AND u.id<>:id'
            )
            ->setParameters(array(
                'id'=>$id,
                'idCity'=>$idCity
            ))
            ->getResult();
    }
}
