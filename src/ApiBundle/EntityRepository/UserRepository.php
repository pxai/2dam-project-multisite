<?php


namespace ApiBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use ApiBundle\Entity\User;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * customized findApplicant
     */
    public function findUser($email)
    {

        $user = $this->findOneBy(array("email" => $email));
        return $user;
    }

    /**
     * check login for user findApplicant
     */
    public function checkLogin($new_user)
    {

        $user = $this->findOneBy(array("login"=> $new_user->getLogin(), "password" => $new_user->getPassword()));
        return $user;
    }


}
