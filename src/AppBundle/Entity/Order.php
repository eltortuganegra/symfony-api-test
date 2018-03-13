<?php

// src/AppBundle/Entity/Order.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;


/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $orderId;

    /**
     * @ORM\ManyToOne(targetEntity="Customer")
     * @JoinColumn(name="bought_by", referencedColumnName="customer_id")
     */
    private $boughtBy;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $boughAt;

    /**
     * @ORM\Column(type="date")
     */
    private $deliverDate;

    /**
     * @ORM\Column(type="string")
     */
    private $deliverHours;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getBoughtBy()
    {
        return $this->boughtBy;
    }

    /**
     * @param mixed $boughtBy
     */
    public function setBoughtBy($boughtBy)
    {
        $this->boughtBy = $boughtBy;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getBoughAt()
    {
        return $this->boughAt;
    }

    /**
     * @param mixed $boughAt
     */
    public function setBoughAt($boughAt)
    {
        $this->boughAt = $boughAt;
    }

    /**
     * @return mixed
     */
    public function getDeliverDate()
    {
        return $this->deliverDate;
    }

    /**
     * @param mixed $deliverDate
     */
    public function setDeliverDate($deliverDate)
    {
        $this->deliverDate = $deliverDate;
    }

    /**
     * @return mixed
     */
    public function getDeliverHours()
    {
        return $this->deliverHours;
    }

    /**
     * @param mixed $deliverHours
     */
    public function setDeliverHours($deliverHours)
    {
        $this->deliverHours = $deliverHours;
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

}