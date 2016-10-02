<?php


namespace ApiBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use ApiBundle\Entity\Idea;

class IdeaRepository extends EntityRepository
{
    /**
     * customized function
     *
     */
    public function findIdeas()
    {
        return $this->findAll();
    }
}
