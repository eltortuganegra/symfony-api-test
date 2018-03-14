<?php

namespace AppBundle\Controller;

use AppBundle\Exceptions\OrderNotFoundException;
use AppBundle\Process\GetProductsByOrderProcess;
use AppBundle\Responses\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * @Route("/products/order/{orderId}/shop/{shopId}")
     */
    public function getProductsForOrderAction($orderId, $shopId)
    {
        try {
            $getProductsByOrderProcess = new GetProductsByOrderProcess($this->getDoctrine());
            $getProductsByOrderProcess->execute($orderId, $shopId);
            $products = $getProductsByOrderProcess->getProductsInArray();

            return ResponseFactory::get200([
                'products' => $products
            ]);
        } catch (OrderNotFoundException $e) {
            return ResponseFactory::get404([
                'message' => $e->getMessage()
            ]);
        }
    }
}