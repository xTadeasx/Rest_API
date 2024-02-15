<?php

namespace App\Middleware;

use Contributte\Middlewares\IMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CORSMiddleware implements IMiddleware {

    private function decorate(ResponseInterface $response): ResponseInterface
    {

        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Methods', '*')
            ->withHeader('Access-Control-Allow-Headers', '*');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {

        if ($request->getMethod() === 'OPTIONS') {
            return $this->decorate($response);
        }

        /** @var ResponseInterface $response */
        $response = $next($request, $response);

        return $this->decorate($response);
    }
}
