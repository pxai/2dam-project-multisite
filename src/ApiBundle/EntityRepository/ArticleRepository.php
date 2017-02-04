<?php


namespace ApiBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use ApiBundle\Entity\Message;

class ArticleRepository extends EntityRepository
{
    /**
     * customized function
     *
     */
    public function findArticles()
    {
        return $this->findAll();
    }
}
