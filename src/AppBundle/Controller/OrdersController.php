<?php

namespace AppBundle\Controller;


use AppBundle\Process\FinishOrderProcess;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends  Controller
{

    /**
     * @Route("/orders")
     */
    public function indexAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $requestContent = $request->getContent();
        $createOrderProcess = new FinishOrderProcess($entityManager);

        $orderData = json_decode($requestContent, true);
        $createOrderProcess->execute($orderData);

        $response = ['result' => "ok"];

        return new Response(
            json_encode($response)
        );
    }
}