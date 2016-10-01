<?php


namespace ApiBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use ApiBundle\Entity\AClass;

class ClassRepository extends EntityRepository
{
    /**
     * customized function
     *
     */
    public function findClasses()
    {
        return $this->findAll();
    }
}
