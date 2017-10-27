<?php

namespace AppBundle\Entity\Repository;
use Doctrine\ORM\EntityRepository;


/**
 * MainRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MainRepository extends EntityRepository
{
    public function getUserBuildingLogs($building_id, $user_id)
    {
        $result = $this->getEntityManager()
                            ->createQueryBuilder()
                            ->select('m')
                            ->from('AppBundle:Main', 'm')
                            ->where('m.building = :building_id')
                            ->andWhere('m.user = :user_id')
                            ->setParameter(':building_id', $building_id)
                            ->setParameter(':user_id', $user_id)
                            ->getQuery()
                            ->getResult();

        return $result;
    }
}
