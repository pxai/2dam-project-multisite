<?php


namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\ClassRepository")
 * @ORM\Table(name="class")
 */
class AClass extends Entity
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
     * @ORM\Column(name="since",type="datetime", length=255)
     */
    private $since;

    public function __construct () {

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


 
}