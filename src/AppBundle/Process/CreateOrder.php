<?php

namespace AppBundle\Process;

use AppBundle\Entity\Customer;
use AppBundle\Process\CreateCustomerProcess;

class CreateOrder
{
    private $entityManager;
    private $orderData;
    private $customer;

    public function __construct($entityManager, $orderData)
    {
        $this->entityManager = $entityManager;
        $this->orderData = $orderData;
    }

    public function execute()
    {
        $this->createCustomer();
//        $this->createOrder();
    }

    protected function createCustomer()
    {
        $createCustomerProcess = new CreateCustomerProcess($this->entityManager);
        $customerData = $this->orderData['customer'];
        $createCustomerProcess->create($customerData);
        $customer = $createCustomerProcess->getCustomer();
        $this->loadCustomer($customer);
    }

    protected function loadCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

//    protected function createOrder()
//    {
//
//        $boughtAt = new \DateTime('2018-01-01 12:12:12');
//        $deliverDate = new \DateTime('2018-01-02 12:12:12');
//
//        $order = new Order();
//        $order->setBoughtBy($this->customer);
//        $order->setAddress('asdf');
//        $order->setBoughAt($boughtAt);
//        $order->setDeliverDate($deliverDate);
//        $order->setDeliverHours('13-15');
//        $order->setPrice(10.5);
//
//        $this->entityManager->persist($order);
//        $this->entityManager->flush();
//    }
}