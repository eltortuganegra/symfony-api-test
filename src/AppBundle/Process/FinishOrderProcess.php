<?php

namespace AppBundle\Process;

use AppBundle\Entity\Customer;
use AppBundle\Process\CreateCustomerProcess;

class FinishOrderProcess
{
    private $entityManager;
    private $orderData;
    private $customer;
    private $createOrderProcess;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute($orderData)
    {
        $this->setOrderData($orderData);
        $this->createCustomer();
        $this->createOrder();
    }

    function setOrderData($orderData)
    {
        $this->orderData = $orderData;
    }

    private function createCustomer()
    {
        $createCustomerProcess = new CreateCustomerProcess($this->entityManager);        
        $customerData = $this->orderData['customer'];
        $createCustomerProcess->execute($customerData);
        $customer = $createCustomerProcess->getCustomer();
        $this->setCustomer($customer);
    }

    private function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    private function createOrder()
    {
        $this->loadCreateOrderProcess();
        $this->createOrderProcess->setCustomer($this->customer);
        $data = $this->orderData['order'];
        $this->createOrderProcess->execute($data);

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
    }

    private function loadCreateOrderProcess()
    {
        $createOrderProcessImp = new CreateOrderProcess($this->entityManager);
        $this->setCreateOrderProcess($createOrderProcessImp);
    }

    public function setCreateOrderProcess(CreateOrderProcess $createOrderProcess)
    {
        $this->createOrderProcess = $createOrderProcess;
    }



}