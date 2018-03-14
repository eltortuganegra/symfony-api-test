<?php

namespace AppBundle\Process;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;
use AppBundle\Exceptions\OrderNotFoundException;

class GetProductsByOrderProcess
{
    private $doctrine;
    private $order;
    private $products;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function execute($orderId, $shopId)
    {
        $this->findOrder($orderId);
        $this->findProducts($shopId);
    }

    protected function findOrder($orderId)
    {
        $repositoryOrder = $this->doctrine->getRepository(Order::class);
        $this->order = $repositoryOrder->find($orderId);

        if (empty($this->order)) {
            throw new OrderNotFoundException();
        }
    }

    protected function findProducts($shopId)
    {
        $repositoryProduct = $this->doctrine->getRepository(Product::class);
        $this->products = $repositoryProduct->findBy([
            'orderId' => $this->order,
            'shopId' => $shopId
        ]);
    }

    public function getProductsInArray()
    {
        $productsData = [];
        foreach ($this->products as $product) {
            $productsData[] = [
                'order_id' => $product->getOrderId()->getOrderId(),
                'shop_id' => $product->getShopId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'amount' => $product->getAmount(),
                'price' => $product->getPrice(),
            ];
        }

        return $productsData;
    }

}