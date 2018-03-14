<?php

namespace AppBundle\Responses;

use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    static public function get200($data = null)
    {
        $response = new Response();
        if ($data != null) {
            $response->setContent(json_encode($data));
        }
        $response->setStatusCode(\Symfony\Component\HttpFoundation\Response::HTTP_OK);

        return $response;
    }

    static public function get409($data)
    {
        $response = new Response();
        $response->setStatusCode(\Symfony\Component\HttpFoundation\Response::HTTP_CONFLICT);
        $response->setContent(json_encode($data));

        return $response;
    }

    static public function get404($data)
    {
        $response = new Response();
        $response->setStatusCode(\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
        if ($data != null) {
            $response->setContent(json_encode($data));
        }

        return $response;
    }
}