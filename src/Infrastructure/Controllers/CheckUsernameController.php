<?php

namespace TalkWhyTdd\Infrastructure\Controllers;

use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response;
use TalkWhyTdd\User\Model\Username;

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

        try {
            new Username($username);
        } catch (InvalidArgumentException $e) {
            return $response
                ->withStatus(422)
                ->withJson(['message' => 'The \'username\' is not properly formatted']);
        }

        return $response->withStatus(200);
    }
}
