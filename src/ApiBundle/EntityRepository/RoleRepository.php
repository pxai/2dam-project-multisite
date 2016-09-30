<?php


namespace ApiBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository 
{
	/**
	* customized function
	*
	*/
	public function findRoles()
	{
            return $this->findAll();
	}
}
