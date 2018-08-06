<?php

namespace  {

    use Zend\Expressive\Helper\ServerUrlMiddleware;
    use Zend\Expressive\Helper\UrlHelperMiddleware;
    use Zend\Expressive\Middleware\NotFoundHandler;
    use Zend\Expressive\Router\Middleware\DispatchMiddleware;
    use Zend\Stratigility\Middleware\ErrorHandler;
    use Zend\Expressive\Router\Middleware\RouteMiddleware;

    /** @var Zend\Expressive\Application $app */
    $app->pipe(ErrorHandler::class);

    $app->pipe(ServerUrlMiddleware::class);

//    $app->pipe(RouteMiddleware::class);

    $app->pipe(UrlHelperMiddleware::class);

    $app->pipe(DispatchMiddleware::class);

    $app->pipe(NotFoundHandler::class);

}