<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\EventRepository")
 * @ORM\Table(name="event")
 */
class Event extends Entity
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
     * @ORM\Column(name="event_date",type="datetime", length=255)
     */
    private $eventDate;

    /**
     * @ORM\Column(name="latitude",type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(name="longitude",type="float")
     */
    private $longitude;


    public function __construct () {
        $this->eventDate = new \DateTime();
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
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * @param mixed $eventDate
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
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
