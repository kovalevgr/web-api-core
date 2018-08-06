<?php


namespace App\Infrastructure\Expressive\Middleware\NotFound;

use Zend\Diactoros\Response;

class NotFoundDelegateFactory
{
    public function __invoke()
    {
        return new NotFoundDelegate(new Response());
    }
}