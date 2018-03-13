<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends  Controller
{
    /**
     * @Route("/orders")
     */
    public function indexAction()
    {
        $number = mt_rand(0, 100);

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));

//        return new Response(
//            '<html><body>order: '.$number.'</body></html>'
//        );
    }
}