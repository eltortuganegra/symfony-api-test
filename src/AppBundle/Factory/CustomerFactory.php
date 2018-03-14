<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Customer;

class CustomerFactory
{
    static public function makeCustomer($data)
    {
        $customer = new Customer();

        $customer->setNameAndSurname($data['name_and_surname']);
        $customer->setEmail($data['email']);
        $customer->setPhoneNumber($data['phone_number']);

        return $customer;
    }
}