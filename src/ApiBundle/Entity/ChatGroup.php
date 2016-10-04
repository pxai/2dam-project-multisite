<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\ItemRepository")
 * @ORM\Table(name="chatgroup")
 */
class ChatGroup extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\Column(name="name",type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(name="since",type="datetime", length=255)
     */
    private $since;




    public function __construct () {
        $this->since = new \DateTime();
    }

    /**
    *
    */
    public function getId () {
      return $this->id;
    }

    /**
    *
    */
    public function setId ($id) {
        $this->id = $id;
        return $this;
    }


    /**
    *
    */
    public function getName () {
      return $this->name;
    }

    /**
    *
    */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }


}
