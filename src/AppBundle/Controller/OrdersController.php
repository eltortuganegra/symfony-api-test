<?php

namespace AppBundle\Controller;

use AppBundle\Exceptions\EmailOfCustomerMustBeUniqueException;
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
        if (!$this->isPostRequest($request)) {
            return ResponseFactory::get404();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $requestContent = $request->getContent();
        $createOrderProcess = new FinishOrderProcess($entityManager);
        $orderData = json_decode($requestContent, true);
        try {
            $createOrderProcess->execute($orderData);

            return ResponseFactory::get200();
        } catch (EmailOfCustomerMustBeUniqueException $e) {
            $content = [
                'message' => 'El email del cliente debe ser único.'
            ];
            $response = ResponseFactory::get409($content);

            return $response;
        }
    }

    protected function isPostRequest(Request $request)
    {
        return $request->getMethod() === 'POST';
    }
}