<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


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
     * @ORM\Column(name="login",type="string", length=50)
     */
    private $login;
  
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
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_role",
     *      joinColumns={@ORM\JoinColumn(name="iduser", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idrole", referencedColumnName="id", unique=true)}
     *      )
     */
    private $roles;

    /**
     * @var ChatGroups
     * @ORM\ManyToMany(targetEntity="ChatGroup")
     * @ORM\JoinTable(name="chatgroup_user",
     *      joinColumns={@ORM\JoinColumn(name="iduser", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idchatgroup", referencedColumnName="id", unique=true)}
     *      )
     */
    private $chatGroups;


    /**
     * @OneToMany(targetEntity="Message", mappedBy="user")
     */
    private $messages;

    public function __construct () {
        $this->since = time();
        $this->roles = array();
        $this->chatGroups = array();
        $this->messages = array();
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


    public function getLogin() {
        return $this->login;
    }
    
    public function getUsername() {
        return $this->login;
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
        return $this->roles;
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
            $this->login,
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
            $this->login,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
    
    public function setLogin($login) {
        $this->login = $login;
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
}