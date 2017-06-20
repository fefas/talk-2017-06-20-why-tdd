<?php

namespace TalkWhyTdd\Infrastructure\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CheckUsernameController
{
    public function __invoke(Request $request, Response $response)
    {
        $requestParsedBody = $request->getParsedBody();
        $username = $requestParsedBody['username'] ?? null;

        if (null === $username) {
            return $response
                ->withStatus(422)
                ->withJson(['message' => 'The field \'username\' is missing']);
        }

        return $response->withStatus(200);
    }
}
