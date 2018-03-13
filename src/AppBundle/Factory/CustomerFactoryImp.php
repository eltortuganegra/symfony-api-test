<?php

namespace AppBundle\Factory;

use AppBundle\Factory\CustomerFactory;
use AppBundle\Entity\Customer;

class CustomerFactoryImp implements CustomerFactory
{
    static public function makeCustomer($customerData)
    {
        $customer = new Customer();

        $customer->setNameAndSurname($customerData['name_and_surname']);
        $customer->setEmail($customerData['email']);
        $customer->setPhoneNumber($customerData['phone_number']);

        return $customer;
    }
}