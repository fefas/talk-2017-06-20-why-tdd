<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

require __DIR__.'/../vendor/autoload.php';

$app = new Slim\App();

$app->post('/check-username', function (Request $request, Response $response) {
    return $response->withStatus(200);
});

$app->run();
