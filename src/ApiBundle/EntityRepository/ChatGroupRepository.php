<?php

namespace ApiBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class ChatGroupRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findChatGroups()
	{
            return $this->findAll();
	}
}