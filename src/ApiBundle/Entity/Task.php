<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\Column(name="task",type="string", length=100)
     */
    private $task;


    /**
     * @ORM\Column(name="last_update",type="datetime", length=255)
     */
    private $lastUpdate;


    public function __construct () {
        $this->lastUpdate = new \DateTime();
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
    public function getTask () {
      return $this->task;
    }

    /**
    *
    */
    public function setTask($task) {
        $this->task = $task;
        return $this;
    }

    public function setLastUpdate($lastUpdate) {
        $this->lastUpdate = $lastUpdate;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}
