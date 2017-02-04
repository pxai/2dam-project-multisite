<?php

namespace ApiBundle\Service\DAO;

/**
 * Pello Altad
 * ArticleDAO
 * Extends GenericDAO
 */
class ArticleDAO extends GenericDAO {

    /**
 * selects only the last ten registers with bigger id
 * @param $id
 * @return mixed
 */
    public function selectLast($groupid,$total=20) {
        $repository = $this->em->getRepository($this->entityType);

        $query = $repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->setParameter('id',$groupid)
            ->orderBy('m.publishDate', 'ASC')
            ->getQuery();

        return $query->setMaxResults($total)->getResult();
    }

    /**
     * selects only the last ten registers with bigger id
     * @param $id
     * @return mixed
     */
    public function selectLastFrom($id,$total=20) {
        $repository = $this->em->getRepository($this->entityType);

        $query = $repository->createQueryBuilder('m')
            ->where('m.id > :id')
            ->setParameter('id',$id)
            ->orderBy('m.publishDate', 'ASC')
            ->getQuery();

        return $query->setMaxResults($total)->getResult();
    }

    /**
     * selects only the last registers with bigger id
     * @param $id
     * @return mixed
     */
    public function selectUser($id) {
        $repository = $this->em->getRepository($this->entityType);

        $query = $repository->createQueryBuilder('m')
                    ->where('m.id > :id')
                    ->setParameter('id',$id)
                    ->getQuery();

        return $query->getResult();
    }
}

