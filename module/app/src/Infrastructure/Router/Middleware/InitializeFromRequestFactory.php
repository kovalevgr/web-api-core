<?php


namespace App\Infrastructure\Router\Middleware;

use Interop\Container\ContainerInterface;

class InitializeFromRequestFactory
{
    /**
     * @param ContainerInterface $container
     * @return InitializeFromRequest
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new InitializeFromRequest($container);
    }
}