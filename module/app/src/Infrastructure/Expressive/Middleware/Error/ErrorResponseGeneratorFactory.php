<?php


namespace App\Infrastructure\Expressive\Middleware\Error;


class ErrorResponseGeneratorFactory
{
    public function __invoke()
    {
        return new ErrorResponseGenerator(true);
    }
}