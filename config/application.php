<?php
namespace {


    use App\Infrastructure\Expressive\Middleware\Error\ErrorResponseGeneratorFactory;
    use App\Infrastructure\Expressive\Middleware\NotFound\NotFoundDelegate;
    use App\Infrastructure\Expressive\Middleware\NotFound\NotFoundDelegateFactory;
    use App\Infrastructure\Router\Service\RouterService;
    use App\Infrastructure\Router\Service\RouteServiceFactory;
    use Zend\ConfigAggregator\ConfigAggregator;
    use Zend\Expressive\Application;
    use Zend\Expressive\Container;
    use Zend\Expressive\Delegate;
    use Zend\Expressive\Helper;
    use Zend\Expressive\Middleware;
    use Zend\Expressive\Router\FastRouteRouterFactory;
    use Zend\Expressive\Router\RouterInterface;
    use Psr\Http\Message\ResponseInterface;

    return [
        'debug' => true,
        ConfigAggregator::ENABLE_CACHE => true,
        'zend-expressive' => [
            'programmatic_pipeline' => true,
        ],
        'service_manager' => [
            'aliases' => [
                'Zend\Expressive\Delegate\DefaultDelegate' => NotFoundDelegate::class,
            ],
            'invokables' => [
                Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
            ],
            'factories'  => [
                RouterInterface::class            => FastRouteRouterFactory::class,
                RouterService::class              => RouteServiceFactory::class,

                Application::class                => Container\ApplicationFactory::class,
                Delegate\NotFoundDelegate::class  => NotFoundDelegateFactory::class,
                Helper\ServerUrlMiddleware::class => Helper\ServerUrlMiddlewareFactory::class,
                Helper\UrlHelper::class           => Helper\UrlHelperFactory::class,
                Helper\UrlHelperMiddleware::class => Helper\UrlHelperMiddlewareFactory::class,

                Zend\Stratigility\Middleware\ErrorHandler::class => Container\ErrorHandlerFactory::class,
                Middleware\ErrorResponseGenerator::class         => ErrorResponseGeneratorFactory::class,
                Middleware\NotFoundHandler::class                => Container\NotFoundHandlerFactory::class,

                ResponseInterface::class                 => Container\ResponseFactoryFactory::class,

            ],
            'delegators' => [

            ]
        ],
    ];

}