<?php


namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\IdeaRepository")
 * @ORM\Table(name="idea")
 */
class Idea extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="name",type="string", length=50)
     */
    private $name;
  
     /**
     * @ORM\Column(name="description",type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(name="idea_date",type="datetime", length=255)
     */
    private $ideaDate;

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
        $this->latitude = 0;
        $this->longitude = 0;
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

    /**
     * @return mixed
     */
    public function getIdeaDate()
    {
        return $this->ideaDate;
    }

    /**
     * @param mixed $ideaDate
     */
    public function setIdeaDate($ideaDate)
    {
        $this->ideaDate = $ideaDate;
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