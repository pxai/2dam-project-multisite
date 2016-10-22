<?php


namespace ApiBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use ApiBundle\Entity\Message;

class MessageRepository extends EntityRepository
{
    /**
     * customized function
     *
     */
    public function findMessages()
    {
        return $this->findAll();
    }
}
