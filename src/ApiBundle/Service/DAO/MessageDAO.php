<?php

namespace ApiBundle\Service\DAO;

/**
 * MessageDAO
 * Extends GenericDAO
 */
class MessageDAO extends GenericDAO {

    /**
     * selects only the last registers with bigger id
     * @param $id
     * @return mixed
     */
    public function selectLast($id) {
        $repository = $this->em->getRepository($this->entityType);

        $query = $repository->createQueryBuilder('m')
                    ->where('m.id > :id')
                    ->setParameter('id',$id)
                    ->getQuery();

        return $query->getResult();
    }
}

