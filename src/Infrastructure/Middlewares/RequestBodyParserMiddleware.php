<?php

namespace TalkWhyTdd\Infrastructure\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class RequestBodyParserMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $requestRawBody = $request->getBody()->getContents();

        $parseToArray = true;
        $parsedBody = json_decode($requestRawBody, $parseToArray);

        $request = $request->withParsedBody($parsedBody);

        return $next($request, $response);
    }
}
