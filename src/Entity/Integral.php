<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IntegralRepository")
 */
class Integral
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $rmb;

    /**
     * @ORM\Column(type="integer")
     */
    private $integral;

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRmb()
    {
        return $this->rmb;
    }

    /**
     * @param mixed $rmb
     */
    public function setRmb($rmb): void
    {
        $this->rmb = $rmb;
    }

    /**
     * @return mixed
     */
    public function getIntegral()
    {
        return $this->integral;
    }

    /**
     * @param mixed $integral
     */
    public function setIntegral($integral): void
    {
        $this->integral = $integral;
    }
}
