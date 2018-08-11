<?php


namespace App\Infrastructure\Router\Service;

use Zend\Expressive\Router\RouteResult;

class RouterService
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @param RouteResult $result
     * @return RouterService
     */
    public static function createFromRouteResult(RouteResult $result = null): ? self
    {
        if (!$result) {
            return new self(RouteResult::fromRouteFailure());
        }
        return new self($result);
    }

    /**
     * Sets module, controller and action resource names
     *
     * McaService constructor.
     * @param RouteResult $routeResult
     */
    private function __construct(
        RouteResult $routeResult
    )
    {
        $this->params = $routeResult->getMatchedParams();
        $this->name = $routeResult->isFailure() ? 'route_failure' : $routeResult->getMatchedRoute()->getName();
        $this->pattern = $routeResult->isFailure() ? 'route_failure'  : $routeResult->getMatchedRoute()->getPath();
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getParam(string $key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }
}