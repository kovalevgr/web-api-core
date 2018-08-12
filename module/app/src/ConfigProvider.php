<?php


namespace App;


use App\Controller\PingAction\PingAction;
use App\Infrastructure\Router\Middleware\InitializeFromRequest;
use App\Infrastructure\Router\Middleware\InitializeFromRequestFactory;
use Zend\Expressive\Router\Middleware\RouteMiddlewareFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

use Zend\Expressive\Router\Middleware\RouteMiddleware;

class ConfigProvider
{

    public function getServiceManagerConfig()
    {
        return [
            'factories' => [
                PingAction::class   => InvokableFactory::class,

                InitializeFromRequest::class => InitializeFromRequestFactory::class,
                RouteMiddleware::class => RouteMiddlewareFactory::class,
            ]
        ];
    }

    public function getApplicationManagerConfig()
    {
        return [
            'factories' => [

            ],
            'delegators' => [

            ],
            'initializers' => [

            ]
        ];
    }

    public function getRepoPluginManagerConfig()
    {
        return [
            'factories' => [

            ],
            'initializers' => [

            ]
        ];
    }

    public function getEntityRegistry()
    {
        return [

        ];
    }
}