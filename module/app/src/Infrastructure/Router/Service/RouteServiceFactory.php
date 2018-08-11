<?php


namespace App\Infrastructure\Router\Service;

use Psr\Container\ContainerInterface;

class RouteServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return RouterService|null
     */
    public function __invoke(ContainerInterface $container)
    {
        return RouterService::createFromRouteResult();
    }
}