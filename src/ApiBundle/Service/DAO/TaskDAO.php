<?php

namespace ApiBundle\Service\DAO;

/**
 * TaskDAO
 * Extends GenericDAO
 */
class TaskDAO extends GenericDAO {
    function selectLast($id,$total=10) {
        $repository = $this->em->getRepository($this->entityType);

        $query = $repository->createQueryBuilder('m')
        ->where('m.id > :id')
        ->setParameter('id',$id)
        ->orderBy('m.lastUpdate', 'ASC')
        ->getQuery();

        return $query->setMaxResults($total)->getResult();
    }
}

