<?php

namespace AppBundle\Controller;


use AppBundle\Exceptions\EmailOfCustomerMustBeUnique;
use AppBundle\Process\FinishOrderProcess;
use AppBundle\Responses\ResponseFactory;
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
        try {
            $createOrderProcess->execute($orderData);
            $response = ['result' => "ok"];

            return ResponseFactory::get200();
//            return new Response(
//                json_encode($response)
//            );
        } catch (EmailOfCustomerMustBeUnique $e) {
            $content = [
                'message' => 'El email del cliente debe ser único.'
            ];
            $response = ResponseFactory::get400($content);

            return $response;
        }
    }
}