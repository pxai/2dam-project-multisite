<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\MeetupRepository")
 * @ORM\Table(name="meetup")
 */
class Meetup extends Entity
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
     * @ORM\Column(name="description",type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(name="since",type="datetime", length=255)
     */
    private $since;

    /**
     * @ORM\Column(name="meetup_date",type="datetime", length=255)
     */
    private $meetupDate;

    /**
     * @ORM\Column(name="open",type="integer")
     */
    private $open;


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
    public function getDescription() {
        return $this->description;
    }


    public function setDescription($description) {
        $this->description = $description;
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
     * @return mixed
     */
    public function getMeetupDate()
    {
        return $this->meetupDate;
    }

    /**
     * @param mixed $meetupDate
     */
    public function setMeetupDate($meetupDate)
    {
        $this->meetupDate = $meetupDate;
    }

    /**
     * @return mixed
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * @param mixed $open
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }





}
