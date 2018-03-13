<?php

namespace AppBundle\Process;

use AppBundle\Entity\Customer;
use AppBundle\Process\CreateCustomerProcess;

class FinishOrderProcess
{
    private $entityManager;
    private $orderData;
    private $customer;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute($orderData)
    {
        $this->setOrderData($orderData);
        $this->createCustomer();
//        $this->createOrder();
    }

    function setOrderData($orderData)
    {
        $this->orderData = $orderData;
    }

    protected function createCustomer()
    {
        $createCustomerProcess = new CreateCustomerProcess($this->entityManager);
        $customerData = $this->orderData['customer'];
        $createCustomerProcess->execute($customerData);
        $customer = $createCustomerProcess->getCustomer();
        $this->loadCustomer($customer);
    }

    protected function loadCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

}