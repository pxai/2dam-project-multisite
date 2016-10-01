<?php

namespace ApiBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class MeetupRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findMeetups()
	{
            return $this->findAll();
	}
}