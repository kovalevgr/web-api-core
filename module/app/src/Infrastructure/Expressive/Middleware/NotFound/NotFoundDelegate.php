<?php


namespace App\Infrastructure\Expressive\Middleware\NotFound;


use Fig\Http\Message\StatusCodeInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Stream;

class NotFoundDelegate implements DelegateInterface
{

    /**
     * @var ResponseInterface
     */
    private $responsePrototype;

    /**
     * NotFoundDelegate constructor.
     * @param ResponseInterface $responsePrototype
     */
    public function __construct(ResponseInterface $responsePrototype)
    {
        $this->responsePrototype = $responsePrototype;
    }

    /**
     * Dispatch the next available middleware and return the response.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request)
    {
        $response = $this->responsePrototype
            ->withStatus(StatusCodeInterface::STATUS_NOT_FOUND)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->getErrorResponseBody());

        return $response;
    }

    private function getErrorResponseBody()
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write(json_encode([
            'status' => false,
            'message' => 'Not found'
        ]));
        $body->rewind();

        return $body;
    }
}