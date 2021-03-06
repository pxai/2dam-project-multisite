<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends Entity implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="idoauth",type="string", length=100)
     */
    private $idoauth;
    
     /**
     * @ORM\Column(name="username",type="string", length=50)
     */
    private $username;
  
     /**
     * @ORM\Column(name="password",type="string", length=100)
     */
    private $password;

     /**
     * @ORM\Column(name="email",type="string", length=100)
     */
    private $email;

   /**
    * @var Roles
     * @ORM\ManyToMany(targetEntity="Role",fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="user_role",
     *      joinColumns={@ORM\JoinColumn(name="iduser", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idrole", referencedColumnName="id", unique=true)}
     *      )
     * @MaxDepth(1)
     */
    private $roles;

    /**
     * @var ChatGroups
     * @ORM\ManyToMany(targetEntity="ChatGroup",fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="chatgroup_user",
     *      joinColumns={@ORM\JoinColumn(name="iduser", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idchatgroup", referencedColumnName="id", unique=true)}
     *      )
     * @MaxDepth(1)
     */
    private $chatGroups;


    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user",fetch="EXTRA_LAZY")
     * @MaxDepth(1)
     */
    private $messages;

    /**
     * ORM\OneToMany(targetEntity="Article", mappedBy="user",fetch="EXTRA_LAZY")
     * @MaxDepth(1)
     */
    private $articles;

    public function __construct () {
        $this->isActive = true;
        $this->since = time();
        $this->roles = array();
        $this->chatGroups = array();
        $this->messages = array();
        $this->articles = array();
    }

    public function randPassword( $length = 8, $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789' ) {
        return substr( str_shuffle( $chars ), 0, $length );
    }
    
    /*
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

    
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    
   public function getRoles()
    {
       // var_dump($this->roles);
        //return $this->roles;
        return array('ROLE_ADMIN','ROLE_USER');
    }

    /**
     * @return ChatGroups
     */
    public function getChatGroups()
    {
        return $this->chatGroups;
    }



    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }
    
     /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = sha1($password);
    }

       public function setEmail($email) {
        $this->email = $email;
    }

    public function setRoles ($roles) {
        $this->roles = $roles;
    }

    /**
     * @param ChatGroups $chatGroups
     */
    public function setChatGroups($chatGroups)
    {
        $this->chatGroups = $chatGroups;
    }

    /**
     * @return mixed
     */
    public function getIdoauth()
    {
        return $this->idoauth;
    }

    /**
     * @param mixed $idoauth
     */
    public function setIdoauth($idoauth)
    {
        $this->idoauth = $idoauth;
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

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }



}