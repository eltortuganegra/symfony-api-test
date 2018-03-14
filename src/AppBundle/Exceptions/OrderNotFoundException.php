<?php

namespace AppBundle\Exceptions;

class OrderNotFoundException extends \Exception
{
    protected $message = 'No se ha podido encontrar la compra.';
}