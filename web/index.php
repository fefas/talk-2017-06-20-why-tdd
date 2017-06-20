<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

require __DIR__.'/../vendor/autoload.php';

$app = new Slim\App();

$app->post('/check-username', function (Request $request, Response $response) {
    $parsedBody = json_decode($request->getBody()->getContents(), true);
    $username = $parsedBody['username'] ?? null;

    if (null === $username) {
        return $response
            ->withStatus(422)
            ->withJson(['message' => 'The field \'username\' is missing']);
    }

    return $response->withStatus(200);
});

$app->run();
