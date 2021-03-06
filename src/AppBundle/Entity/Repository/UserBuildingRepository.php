<?php

namespace AppBundle\Entity\Repository;
use Doctrine\ORM\EntityRepository;


/**
 * UserBuildingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserBuildingRepository extends EntityRepository
{
    public function findOneByUserAndBuilding($user_id, $building_id)
    {
        $result = $this->getEntityManager()
                            ->createQueryBuilder()
                            ->select('u')
                            ->from('AppBundle:UserBuilding', 'u')
                            ->where('u.user = :user_id')
                            ->andWhere('u.building = :building_id')
                            ->setParameter(':user_id', $user_id)
                            ->setParameter(':building_id', $building_id)
                            ->getQuery()
                            ->getResult();

        return $result;
    }
}
