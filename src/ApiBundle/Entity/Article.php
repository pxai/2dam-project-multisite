<?php


namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\ArticleRepository")
 * @ORM\Table(name="article")
 */
class Article extends Entity
{

    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messages",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="idseller", referencedColumnName="id")
     */
    private $user;


  
     /**
     * @ORM\Column(name="name",type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(name="description",type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(name="price",type="float", length=100)
     */
    private $price;

    /**
     * @ORM\Column(name="publish_date",type="datetime", length=255)
     */
    private $publishDate;

    /**
     * @ORM\Column(name="latitude",type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(name="longitude",type="float")
     */
    private $longitude;


    public function __construct () {
        $this->publishDate = new \DateTime();
        $this->latitude = 0;
        $this->longitude = 0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @param mixed $publishDate
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;
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