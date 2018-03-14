<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Customer;
use AppBundle\Entity\Order;

class OrderFactory
{

    static public function makeOrder(Customer $customer, $data)
    {
        $order = self::createOrder();
        $order = self::loadOrderWithData($order, $customer, $data);

        return $order;
    }

    protected static function createOrder()
    {
        $order = new Order();

        return $order;
    }

    protected static function loadOrderWithData(Order $order, Customer $customer, $data)
    {
        $deliverDate = new \DateTime($data['deliver_date']);
        $boughtAt = new \DateTime($data['bought_at']);

        $order->setBoughtBy($customer);
        $order->setAddress($data['address']);
        $order->setBoughAt($boughtAt);
        $order->setDeliverDate($deliverDate);
        $order->setDeliverHours($data['deliver_hours']);
        $order->setPrice($data['price']);

        return $order;
    }
}