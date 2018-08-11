<?php


namespace App;


use App\Controller\PingAction\PingAction;
use App\Infrastructure\Router\Middleware\InitializeFromRequest;
use App\Infrastructure\Router\Middleware\InitializeFromRequestFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{

    public function getServiceManagerConfig()
    {
        return [
            'factories' => [
                PingAction::class   => InvokableFactory::class,

                InitializeFromRequest::class => InitializeFromRequestFactory::class,
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