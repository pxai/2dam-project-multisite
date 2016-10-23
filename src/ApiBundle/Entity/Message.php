<?php


namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\MessageRepository")
 * @ORM\Table(name="message")
 */
class Message extends Entity
{

    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messages")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */
    private $usesr;

    /**
     * @ORM\ManyToOne(targetEntity="ChatGroup", inversedBy="messages")
     * @ORM\JoinColumn(name="idgroup", referencedColumnName="id")
     */
    private $group;
  
     /**
     * @ORM\Column(name="content",type="string", length=100)
     */
    private $content;

    /**
     * @ORM\Column(name="message_date",type="datetime", length=255)
     */
    private $messageDate;

    /**
     * @ORM\Column(name="latitude",type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(name="longitude",type="float")
     */
    private $longitude;


    public function __construct () {
        $this->ideaDate = new \DateTime();
    }


    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }




 
}