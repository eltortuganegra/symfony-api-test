<?php

namespace AppBundle\Process;

use AppBundle\Entity\Customer;
use AppBundle\Factory\CustomerFactory;

class CreateCustomerProcess
{
    private $entityManager;
    private $customer;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute($data)
    {
        $this->makeCustomer($data);
        $this->save();
    }

    private function makeCustomer($data)
    {
        $this->customer = CustomerFactory::makeCustomer($data);
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