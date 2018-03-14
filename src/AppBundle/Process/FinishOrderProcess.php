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
    private $order;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute($orderData)
    {
        $this->setOrderData($orderData);
        $this->createCustomer();
        $this->createOrder();
        $this->createProducts($orderData);
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
        $this->order = $this->createOrderProcess->getOrder();
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

    protected function createProducts($orderData)
    {
        $createProductByOrderProcess = new CreateProductProcess($this->entityManager);
        $createProductByOrderProcess->setOrder($this->order);

        $items = $orderData['order']['items'];
        foreach ($items as $item) {
            $this->createProduct($createProductByOrderProcess, $item);
        }
    }

    protected function createProduct($createProductByOrderProcess, $item)
    {
        $createProductByOrderProcess->execute($item);
    }
}