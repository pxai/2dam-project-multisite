<?php

namespace ApiBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findTasks()
	{
            return $this->findAll();
	}
}