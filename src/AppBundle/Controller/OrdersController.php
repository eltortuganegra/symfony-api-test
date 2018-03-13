<?php

namespace AppBundle\Controller;


use AppBundle\Process\CreateOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends  Controller
{


    /**
     * @Route("/phpinfo")
     */
    public function phpinfoAction()
    {
        return new Response(
            '<html><body> ' . phpinfo() . '</body></html>'
        );
    }

    /**
     * @Route("/orders")
     */
    public function indexAction(Request $request)
    {

//        $orderNewData = $request->request->all();
        $entityManager = $this->getDoctrine()->getManager();
        $requestContent = $request->getContent();
        $orderData = json_decode($requestContent, true);

        $createOrderProcess = new CreateOrder($entityManager, $orderData);
        $createOrderProcess->execute();

//        $dataOrder = $request->request->all();
//        var_dump($dataOrder);
//
//        $content = $request->getContent();
//        var_dump($content);
//        $contentData = json_decode($content);
//        var_dump($contentData);
//
//
//        $entityManager = $this->getDoctrine()->getManager();
//
//
//        $customer = New Customer();
//        $customer->setNameAndSurname('tony stark');
//        $customer->setEmail('tony2@stark.com' . rand(1, 10000));
//        $customer->setPhoneNumber('666666666');
//
//        $entityManager->persist($customer);
//
//        $entityManager->flush();
//
//
//        $boughtAt = new \DateTime('2018-01-01 12:12:12');
//        $deliverDate = new \DateTime('2018-01-02 12:12:12');
//
//        $order = new Order();
//        $order->setBoughtBy($customer);
//        $order->setAddress('asdf');
//        $order->setBoughAt($boughtAt);
//        $order->setDeliverDate($deliverDate);
//        $order->setDeliverHours('13-15');
//        $order->setPrice(10.5);
//
//        $entityManager->persist($order);
//        $entityManager->flush();
//
//
        $response = ['result' => "ok"];

        return new Response(
            json_encode($response)
        );
    }
}