<?php

namespace ApiBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class ItemRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findItems()
	{
            return $this->findAll();
	}
}