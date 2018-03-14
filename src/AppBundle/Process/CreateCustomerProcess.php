<?php

namespace AppBundle\Process;

use AppBundle\Entity\Customer;
use AppBundle\Factory\CustomerFactory;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use AppBundle\Exceptions\EmailOfCustomerMustBeUnique;

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
        try {
            $this->entityManager->persist($this->customer);
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new EmailOfCustomerMustBeUnique();
        }
    }

    public function getCustomer():Customer
    {
        return $this->customer;
    }
}