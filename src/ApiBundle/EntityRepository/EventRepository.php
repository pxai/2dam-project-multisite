<?php

namespace ApiBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findEvents()
	{
            return $this->findAll();
	}
}