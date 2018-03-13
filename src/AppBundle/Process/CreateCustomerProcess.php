<?php

namespace AppBundle\Process;

use AppBundle\Entity\Customer;
use AppBundle\Factory\CustomerFactory;
use AppBundle\Factory\CustomerFactoryImp;

class CreateCustomerProcess
{
    private $customerFactory;
    private $entityManager;
    private $customer;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($data)
    {
        $this->loadCustomerFactory();
        $this->makeCustomer($data);
        $this->save();
    }

    private function loadCustomerFactory()
    {
        $customerFactoryImp = new CustomerFactoryImp();
        $this->setCustomerFactory($customerFactoryImp);
    }

    private function setCustomerFactory(CustomerFactory $customerFactory)
    {
        $this->customerFactory = $customerFactory;
    }

    private function makeCustomer($data)
    {
        $this->customer = $this->customerFactory->makeCustomer($data);
    }

    private function save()
    {
        $this->entityManager->persist($this->customer);
        $this->entityManager->flush();
    }

    public function getCustomer():Customer
    {
        return $this->customer;
    }
}