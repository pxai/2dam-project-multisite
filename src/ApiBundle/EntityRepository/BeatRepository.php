<?php

namespace ApiBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class BeatRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findBeats()
	{
            return $this->findAll();
	}
}