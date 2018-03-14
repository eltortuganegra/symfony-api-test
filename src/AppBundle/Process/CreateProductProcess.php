<?php

namespace AppBundle\Process;

use AppBundle\Entity\Order;
use AppBundle\Factory\ProductFactory;

class CreateProductProcess
{
    private $entityManager;
    private $order;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function execute($data)
    {
        $this->makeProduct($data);
        $this->save();
    }

    private function makeProduct($data)
    {
        $this->product = ProductFactory::makeProduct($this->order, $data);
    }

    private function save()
    {
        $this->entityManager->persist($this->product);
        $this->entityManager->flush();
    }

}