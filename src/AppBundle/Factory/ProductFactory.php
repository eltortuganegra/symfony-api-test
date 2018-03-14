<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;

class ProductFactory
{

    static public function makeProduct(Order $order, $data)
    {
        $product = self::createProduct();
        $product = self::loadOrderWithData($product, $order, $data);

        return $product;
    }

    protected static function createProduct()
    {
        $product = new Product();

        return $product;
    }

    protected static function loadOrderWithData(Product $product, Order $order, $data)
    {
        $product->setOrderId($order);
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setAmount($data['amount']);
        $product->setPrice($data['price']);
        $product->setShopId($data['shop_id']);

        return $product;
    }
}