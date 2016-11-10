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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messages",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */
    private $user;

    /**
     * @var ChatGroup
     * @ORM\ManyToOne(targetEntity="ChatGroup", inversedBy="messages",fetch="EXTRA_LAZY")
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
        $this->messageDate = new \DateTime();
        $this->latitude = 0;
        $this->longitude = 0;
    }


    function getId() {
        return $this->id;
    }



    function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getMessageDate()
    {
        return $this->messageDate;
    }

    /**
     * @param mixed $messageDate
     */
    public function setMessageDate($messageDate)
    {
        $this->messageDate = $messageDate;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }




 
}