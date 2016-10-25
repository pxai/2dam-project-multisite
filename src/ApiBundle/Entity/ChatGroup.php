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

    /**
     * @var users
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="chatgroup_user",
     *      joinColumns={@ORM\JoinColumn(name="idchatgroup", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="iduser", referencedColumnName="id", unique=true)}
     *      )
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="group")
     */
    private $messages;

    public function __construct () {
        $this->since = new \DateTime();
        $this->users =  array();
        $this->messages =  array();
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

    /**
     * @return mixed
     */
    public function getSince()
    {
        return $this->since;
    }

    /**
     * @param mixed $since
     */
    public function setSince($since)
    {
        $this->since = $since;
    }

    /**
     * @return users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param users $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param mixed $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }


}
