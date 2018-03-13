<?php

// src/AppBundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer
{
    /**
     * @return mixed
     */
    public function getNameAndSurname()
    {
        return $this->nameAndSurname;
    }

    /**
     * @param mixed $nameAndSurname
     */
    public function setNameAndSurname($nameAndSurname)
    {
        $this->nameAndSurname = $nameAndSurname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nameAndSurname;

    /**
     * @ORM\Column(type="string", length=190, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phoneNumber;


}