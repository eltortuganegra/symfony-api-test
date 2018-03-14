<?php

namespace AppBundle\Process;

use AppBundle\Entity\Customer;
use AppBundle\Factory\OrderFactory;

class CreateOrderProcess
{
    private $entityManager;
    private $customer;
    private $order;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function execute($data)
    {
        $this->makeOrder($data);
        $this->save();
    }

    protected function makeOrder($data)
    {
        $this->order = OrderFactory::makeOrder($this->customer, $data);
    }

    protected function save()
    {
        $this->entityManager->persist($this->order);
        $this->entityManager->flush();
    }
}