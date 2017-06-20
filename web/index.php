<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use TalkWhyTdd\Infrastructure\Middlewares\RequestBodyParserMiddleware;

require __DIR__.'/../vendor/autoload.php';

$app = new Slim\App();

$app->add(RequestBodyParserMiddleware::class);

$app->post('/check-username', function (Request $request, Response $response) {
    $requestParsedBody = $request->getParsedBody();
    $username = $requestParsedBody['username'] ?? null;

    if (null === $username) {
        return $response
            ->withStatus(422)
            ->withJson(['message' => 'The field \'username\' is missing']);
    }

    return $response->withStatus(200);
});

$app->run();
