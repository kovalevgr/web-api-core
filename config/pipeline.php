<?php

namespace  {

    use App\Infrastructure\Router\Middleware\InitializeFromRequest;
    use Zend\Expressive\Middleware\NotFoundHandler;
    use Zend\Stratigility\Middleware\ErrorHandler;
    use Zend\Expressive\Router\Middleware\RouteMiddleware;
    use Zend\Expressive\Router\Middleware\DispatchMiddleware;

    /**
     * Setup middleware pipeline:
     */

    /** @var Zend\Expressive\Application $app */
    $app->pipe(ErrorHandler::class);
    $app->pipe(RouteMiddleware::class);
    $app->pipe(InitializeFromRequest::class);
    $app->pipe(DispatchMiddleware::class);
    $app->pipe(NotFoundHandler::class);

}