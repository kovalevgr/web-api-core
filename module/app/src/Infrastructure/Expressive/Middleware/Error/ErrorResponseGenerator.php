<?php


namespace App\Infrastructure\Expressive\Middleware\Error;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ErrorResponseGenerator
{
    private $debugMode;

    /**
     * ErrorResponseGenerator constructor.
     * @param bool $isDebugMode
     */
    public function __construct(bool $isDebugMode)
    {
        $this->debugMode = $isDebugMode;
    }

    /**
     * @param $e
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke($e, ServerRequestInterface $request, ResponseInterface $response)
    {
        $jsonResponse = [
            'status' => false,
            'message' => 'An unexpected error occurred',
        ];

        if ($this->debugMode) {
            $jsonResponse['exception'] = $this->exceptionToArray($e);
            exit(var_dump($jsonResponse['exception']));
        }

        $response->withHeader('Content-Type', 'application/json')
            ->getBody()->write(json_encode($jsonResponse));

        return $response;
    }

    /**
     * @param \Throwable $e
     * @return array
     */
    private function exceptionToArray(\Throwable $e) : array
    {
        $result = [];

        do {
            $message = [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ];

            $result[] = $message;
        } while ($e = $e->getPrevious());

        return $result;
    }
}