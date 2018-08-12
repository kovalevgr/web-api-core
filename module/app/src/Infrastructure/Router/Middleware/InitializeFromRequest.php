<?php


namespace App\Infrastructure\Router\Middleware;

use App\Infrastructure\Router\Service\RouterService;
use Interop\Container\ContainerInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Helper\Exception\MissingHelperException;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\RouteResult;

class InitializeFromRequest implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * InitializeFromRequest constructor.
     * @param $container
     */
    public function __construct(
        ContainerInterface $container
    )
    {
        $this->container = $container;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->setUri($request);

        $this->setRouterService($request);

        $this->setRouteResult($request);

        return $delegate->process($request);
    }

    /**
     * @param ServerRequestInterface $request
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function setUri(ServerRequestInterface $request)
    {
        if (!$this->container->has(ServerUrlHelper::class)) {
            throw new MissingHelperException(sprintf(
                '%s requires a %s service at instantiation; none found',
                ServerUrlMiddleware::class,
                ServerUrlHelper::class
            ));
        }

        $this->container->get(ServerUrlHelper::class)->setUri($request->getUri());
    }

    /**
     * @param ServerRequestInterface $request
     */
    public function setRouterService(ServerRequestInterface $request)
    {
        // requesting route result in order to create mca object
        $routeResult = $request->getAttribute(RouteResult::class);

        // providing router service for the application
        $this->container->setAllowOverride(true);
        $this->container->setService(
            RouterService::class,
            RouterService::createFromRouteResult($routeResult)
        );
        $this->container->setAllowOverride(false);
    }

    /**
     * @param ServerRequestInterface $request
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function setRouteResult(ServerRequestInterface $request)
    {
        if (!$this->container->has(UrlHelper::class)) {
            throw new MissingHelperException(sprintf(
                '%s requires a %s service at instantiation; none found',
                UrlHelperMiddleware::class,
                UrlHelper::class
            ));
        }

        $result = $request->getAttribute(RouteResult::class, false);

        if ($result instanceof RouteResult) {
            $this->container->get(UrlHelper::class)->setRouteResult($result);
        }
    }
}