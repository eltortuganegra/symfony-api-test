<?php

// src/AppBundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;


/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $productId;

    /**
     * @ORM\ManyToOne(targetEntity="Order")
     * @JoinColumn(name="order", referencedColumnName="order_id")
     */
    private $order;

    /**
     * @ORM\Column(type="integer")
     */
    private $shopId;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;


}