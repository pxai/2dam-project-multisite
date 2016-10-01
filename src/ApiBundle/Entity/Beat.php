<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\EntityRepository\BeatRepository")
 * @ORM\Table(name="beat")
 */
class Beat extends Entity
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="message",type="string", length=140)
     */
    private $message;

    /**
     * @ORM\Column(name="beat_date",type="datetime", length=255)
     */
    private $beatDate;

    /**
     * @ORM\Column(name="latitude",type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(name="longitude",type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(name="idfrom",type="integer")
     */
    private $idfrom;

    /**
     * @ORM\Column(name="idto",type="integer")
     */
    private $idto;

    public function __construct () {
        $this->beatDate = new \DateTime();
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
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getBeatDate()
    {
        return $this->beatDate;
    }

    /**
     * @param mixed $beatDate
     */
    public function setBeatDate($beatDate)
    {
        $this->beatDate = $beatDate;
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

    /**
     * @return mixed
     */
    public function getIdfrom()
    {
        return $this->idfrom;
    }

    /**
     * @param mixed $idfrom
     */
    public function setIdfrom($idfrom)
    {
        $this->idfrom = $idfrom;
    }

    /**
     * @return mixed
     */
    public function getIdto()
    {
        return $this->idto;
    }

    /**
     * @param mixed $idto
     */
    public function setIdto($idto)
    {
        $this->idto = $idto;
    }




}
